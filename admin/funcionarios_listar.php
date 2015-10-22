<?php
require "dao/funcionario_dao.class.php";

$fdao = new funcionario_dao();

$funcionarios = $fdao->listar_funcionarios();

require "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/funcionarios_listar.css">

<div class="row">
	<div class="col-lg-2">
		<?php require "admin_nav.php"; ?>
	</div>

	<div class="col-lg-10">
		<fieldset id="funcionarios_list_content">

			<legend>Funcionários</legend>

			<div id="fl-search" class="panel panel-default">
				<div class="panel-body row">
					<!--<div class="col-lg-0">
						<a href="funcionarios_editar.php" class="btn btn-sm btn-primary">Cadastrar Funcionário</a>
					</div>-->
					<div class="col-lg-12">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="Digite sua busca aqui..." aria-describedby="sizing-addon3">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">Procurar</button>
								<button class="btn btn-primary">Cadastrar Funcionário</button>
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
						<th>Ativo</th>
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
								<?=$f['ativo'] ? 'sim':'não'?>
							</td>
							<td>
								<?=$f['bloqueado'] ? 'sim':'não'?>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</fieldset>
	</div>
</div>
<?php require "footer.php";?>