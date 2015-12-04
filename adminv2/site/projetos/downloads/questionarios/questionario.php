<?php
define("ROOT", "../../../..");
define("NAV", "side_btn_p");

require ROOT."/libs/lib_list.php";

$cod_projeto = $_GET['cod_projeto'];
$cod_download = $_GET['cod_download'];

$dDao = new DownloadDAO(get_connection());
$questoes = $dDao->listar_perguntas($cod_download);

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<div class="sub_body">
	<fieldset>
		<legend>Feedback</legend>
		<div class="panel panel-default panel-body">
			<form class="input-group" method="post" action="dao.php?f=salvar_pergunta&cod_projeto=<?=$cod_projeto?>&cod_download=<?=$cod_download?>">
				<span class="input-group-addon">Adicionar pergunta:</span>
				<input name="titulo" type="text" class="form-control">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">Adicionar</button>
				</span>
			</form> 
		</div>

		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Pergunta</th>
					<th>Resposta</th>
				</tr>
				<?php
				foreach ($questoes as $q) {
					?>
					<tr>
						<td>
							<a href="dao.php?f=deletar_pergunta&cod_projeto=<?=$cod_projeto?>&cod_download=<?=$cod_download?>&cod_pergunta=<?=$q['codigo']?>">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
						</td>
						<td><?=$q['titulo']?></td>
						<td><?=$q['resposta']?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</fieldset>
</div>