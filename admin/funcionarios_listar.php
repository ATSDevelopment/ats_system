<?php
require "dao/funcionario_dao.class.php";

$fdao = new funcionario_dao();

$funcionarios = $fdao->listar_funcionarios();

require "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/funcionarios_listar.css">

<fieldset id="funcionarios_list_content">

<legend>Gerenciamento de Funcionários</legend>

	<div id="fl-search" class="panel panel-default">
		<div class="panel-body row">
			<div class="col-lg-2">
				<a href="funcionarios_editar.php" class="btn btn-sm btn-primary">Cadastrar Funcionário</a>
			</div>
			<div class="col-lg-10">
				<div class="input-group input-group-sm">
					<span class="input-group-addon" id="sizing-addon3">Procurar </span>
					<input type="text" class="form-control" placeholder="Digite sua busca aqui" aria-describedby="sizing-addon3">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div id="list-funcionarios" class="panel panel-default">

		<table class="table">
			<tr>
				<th>#</th>
				<th>Codigo</th>
				<th>Nome</th>
				<th>E-Mail</th>
				<th>Telefone</th>
				<th>Usuário</th>
				<th>Bloqueado</th>
			</tr>
			<?php
			foreach ($funcionarios as $f) {
				?>
				<tr>
					<td>
						<a href="funcionarios_editar.php?cod_funcionario=<?=$f['codigo']?>">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</a>
					</td>
					<td>
						<?=$f['codigo']?>
					</td>
					<td>
						<?=$f['nome_completo']?>
					</td>
					<td>
						<?=$f['e_mail']?>
					</td>
					<td>
						<?=$f['telefone']?>
					</td>
					<td>
						<?=$f['nome_de_usuario']?>
					</td>
					<td>
						<?=$f['bloqueado']?>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
</fieldset>

<?php
require "footer.php";
?>