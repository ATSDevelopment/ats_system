<?php 
require "header.php";
require "dao/download.class.php";

$fdao = new download_dao();

$projetos = $fdao->listar_downloads();

?>
<style type="text/css">
body{
	background-color: #d9d9d9;
}
</style>
<div class="container" style='min-height: 460px;'>
	<div class="row">
		<div class="box">
			<div class="col-lg-10 col-md-offset-1">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3>Downloads</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">

							<?php 
							$cod = 0;
							foreach ($projetos as $p) {

								?>

								<div class="list-group-item">
									<h4 class="list-group-item-heading"><?= $p["nome"]?></h4>
									<div class="list-group-item-text">
										<div class="row">
											<div class="col-md-11">
												<p>Descrição: <?= $p["descricao"]?><br>Versão: <?= $p["versao"]?></p>
											</div>
											<div class="col-md-1">
												<a href="<?= $p['diretorio']?>" download>
													<h2>
														<span class="glyphicon glyphicon-download" aria-hidden="true"></span>
													</h2>
												</a>
											</div>
										</div>
									</div>
								</div>

								<?php 

							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
require "footer.php";
?>