<?php 
require "dao/cliente_dao.class.php";

$fdao = new cliente_dao();

$projetos = $fdao->listar_projetos($_SESSION["cod_cli"]);

?>

<div class="list-group">

	<?php 
	if ($projetos!=null) {
		

		foreach ($projetos as $p) {
			if (($p["versao"]!=null)&&($p['participantes']==1)) {

				?>

				<div class="list-group-item">
					<h4 class="list-group-item-heading"><?= $p["nome"]?></h4>
					<div class="list-group-item-text">
						<div class="row">
							<div class="col-md-11">
								<p>Descrição: <?= $p["descricao"]?><br>Versão: <?= $p["versao"]?></p>
							</div>
							<div class="col-md-1">
								<a href="admin/projetos/downloads/files/<?= $p['diretorio']?>" download>
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
		}
	}else{
		?>
		<div class="list-group-item">
			<div  class="list-group-item-heading">
				<h4 >Sem Downloads Cadastrados</h4>
			</div>
		</div>
		<?php } ?>
	</div>