<?php 
require "dao/cliente_dao.class.php";

$fdao = new cliente_dao();

$projetos = $fdao->listar_projetos($_SESSION["cod_cli"]);

?>
<link rel="stylesheet" type="text/css" href="css/chat.css">
<div class="list-group">

	<?php 
	$cod = 0;
	if ($projetos!=null) {

		foreach ($projetos as $p) {
			?>


			<div class="list-group-item">

				<div  class="list-group-item-heading" data-toggle="collapse" data-target="#collapse<?=$cod?>">
					<h4 id="title<?=$cod?>">
						<?= $p["nome"]?>
						<span class="glyphicon glyphicon-menu-right"></span>
					</h4>
				</div>

				<div id="collapse<?=$cod?>" class="collapse">
					<hr>
					<div class="list-group-item-text">
						<p>
							Descricao: <?= $p["descricao"]?>
							<br>
							Status: <?= $p["status"]?>
						</p>
						<hr>

						<?php  
						if ($p["versao"]!=null) {

							?>
							<div class="row">
								<div class="col-md-offset-9 col-md-1">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseChat<?=$cod?>">
										<h2>
											<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
										</h2>
									</a>
								</div>
								<div class="col-md-1">
									<a href="<?= $p['diretorio']?>" download>
										<h2>
											<span class="glyphicon glyphicon-download" aria-hidden="true"></span>
										</h2>
									</a>
								</div>
								<div class="col-md-1">
									<a data-toggle="modal" data-target="#modalForm<?=$cod?>">
										<h2>
											<span class="glyphicon glyphicon-list-alt" aria-hidden="true" ></span>
										</h2>
									</a>
								</div>
							</div>
							<?php 
							include "chat.php";

							$quant = 1;
							$quest = $fdao->listar_questoes($p["cod_download"]);
							?>
							<!--Modal-->
							<div class="modal fade bs-example-modal-lg" id="modalForm<?=$cod?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<form method="post" action="dao/cliente_dao.php?op=salvar_respostas">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
												<h4 class="modal-title">Formulário</h4>
											</div>
											<div class="modal-body">

												<?php 
												if ($quest==null) {
													?>
													<h4>Não exite formulário</h4>
													<?php
												}else{
													foreach ($quest as $q) {
														?>
														<div class="row">
															<div class="col-md-offset-1">
																<p>
																	<?= $q['titulo']?>
																	<br>
																</p>
																<?php 
																if ($q['resposta']==0) {
																	?>
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios1" value="<?= $q['codigo']?>-1">
																			Sim
																		</label>
																	</div>
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios2" value="<?= $q['codigo']?>-0" checked>
																			Não
																		</label>
																	</div>
																	<?php 
																}elseif ($q['resposta']==1) {																
																	?>	
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios1" value="<?= $q['codigo']?>-1" checked>
																			Sim
																		</label>
																	</div>
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios2" value="<?= $q['codigo']?>-0">
																			Não
																		</label>
																	</div>
																	<?php 
																}else{
																	?>
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios1" value="<?= $q['codigo']?>-1">
																			Sim
																		</label>
																	</div>
																	<div class="radio">
																		<label>
																			<input type="radio" name="<?= $q['codigo']?>" id="optionsRadios2" value="<?= $q['codigo']?>-0">
																			Não
																		</label>
																	</div>	
																	<?php 
																}
																?>												
																<br><br>
															</div>
														</div>

														<?php 
														$quant ++;
													}
												}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" name="quant" class="btn btn-primary" value="<?=$quant?>">Enviar</button>
											</div>
										</form>
									</div>
								</div>
							</div>


							<?php 
						} else{
							?>
							<div class="row">
								<div class="col-md-offset-11 col-md-1">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseChat<?=$cod?>">
										<h2>
											<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
										</h2>
									</a>
								</div>
							</div>

							<?php 
							include "chat.php";
						} ?>
					</div>
				</div>
			</div>

			<script>
			$(document).ready(function(){
				$("#collapse<?=$cod?>").on("hide.bs.collapse", function(){
					$("#title<?=$cod?>").html('<?= $p["nome"]?>
						<span class="glyphicon glyphicon-menu-right"></span>');
				});
				$("#collapse<?=$cod?>").on("show.bs.collapse", function(){
					$("#title<?=$cod?>").html('<?= $p["nome"]?>
						<span class="glyphicon glyphicon-menu-down"></span>');
				});
			});
			</script>

			<?php 
			$cod ++;
		}
	}else{
		?>
		<div class="list-group-item">
			<div  class="list-group-item-heading">
				<h4 >
					Sem Projetos Cadastrados

				</h4>
			</div>
		</div>
		<?php 
	}
	?>
</div>
