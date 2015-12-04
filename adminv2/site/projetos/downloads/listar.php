<?php
define("ROOT", "../../..");
define("NAV", "side_btn_p");

require ROOT."/libs/lib_list.php";

$cod_projeto = $_GET['cod_projeto'];

$dDao = new DownloadDAO(get_connection());
$downloads = $dDao->listar_downloads($_GET['cod_projeto']);

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<div class="sub_body">
	<fieldset>
		<legend>Downloads</legend>
		<div class="panel panel-default panel-body">
			<div class="row">
				<div class="col-lg-3">
					<div class="btn-group">
						<a href="../editar.php?cod_projeto=<?=$cod_projeto?>" class="btn btn-primary">Voltar</a>
						<a href="editar.php?cod_projeto=<?=$_GET['cod_projeto']?>" class="btn btn-primary">Adicionar Download</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Projeto</th>
					<th>Versão</th>
					<th>Privado</th>
				</tr>
				<?php
				foreach ($downloads as $down) {
					?>
					<tr>
						<td>
							<a href="dao.php?f=deletar_download&cod_projeto=<?=$cod_projeto?>&cod_download=<?=$down['codigo']?>">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
							<a href="questionarios/questionario.php?cod_projeto=<?=$cod_projeto?>&cod_download=<?=$down['codigo']?>">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
						</td>
						<td><?=$down['projeto']['nome']?></td>
						<td><?=$down['versao']?></td>
						<td><?=$down['privado']?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</fieldset>
</div>

