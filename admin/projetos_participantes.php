<?php
require "dao/projeto_dao.class.php";

$pdao = new projeto_dao();

$cod_projeto = $_GET['cod_projeto'];

$p = $pdao->obter_por_codigo($cod_projeto);
$part = $pdao->listar_participantes($cod_projeto);

$nav = "side_btn_p";
require "header.php";
require "sidebar.php";
?>

<link rel="stylesheet" type="text/css" href="css/projetos_participantes.css">

<div class="sub_body">
	<fieldset>
		<legend><?=$p['nome']?> :: Gerenciar Participantes</legend>

		<div class="panel panel-default panel-body">
			<div class="row">
				<div class="col-lg-1">
					<a class="btn btn-primary btn-sm" href="projetos_editar.php?cod_projeto=<?=$cod_projeto?>">Voltar</a>
				</div>
				<div class="col-lg-11">
					<form class="input-group input-group-sm" method="post" action="dao/projeto_dao.php?op=add_part&cod_projeto=<?=$cod_projeto?>">
						<input name="parts" type="text" class="form-control" placeholder="Adicionar Participantes (Ex.: nome.usuario.1 nome.usuario.2, ...)">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Adicionar</button>
						</span>
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th></th>
					<th>Nome Completo</th>
					<th>E-Mail</th>
					<th>Telefone</th>
				</tr>
				<?php
				foreach ($part as $p1) {
					$href = "dao/projeto_dao.php?cod_projeto=$cod_projeto&cod_funcionario=".$p1['codigo']."&op=".($p1['gerente'] ? "rem_gerente":"def_gerente");
					$icon = $p1['gerente'] ? "glyphicon-eye-open":"glyphicon-eye-close";

					?>
					<tr>
						<td class="control_col">
							<a href="#">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
							<a href="<?=$href?>">
								<span class="glyphicon <?=$icon?>"></span>
							</a>
						</td>
						<td><?=$p1['nome_completo']?></td>
						<td><?=$p1['e_mail']?></td>
						<td><?=$p1['telefone']?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</fieldset>
</div>

<?php
require "footer.php";
?>