<?php
require "dao/funcionario_dao.class.php";

$fdao = new funcionario_dao();

$search = null;
$funcionarios = null;

if(array_key_exists('search', $_GET)){
	$search = $_GET['search'];
}

$funcionarios = $fdao->listar_funcionarios($search);

$nav = "side_btn_f";
require "header.php";
require "sidebar.php";
?>

<div class="sub_body">
	<fieldset>

		<legend>Funcionários</legend>

		<div id="fl-search" class="panel panel-default">
			<div class="panel-body row">
				<div class="col-lg-2">
					<a href="funcionarios_editar.php" class="btn btn-sm btn-primary">Cadastrar Funcionário</a>
				</div>
				<div class="col-lg-10">
					<form class="input-group input-group-sm">
						<input name="search" type="text" class="form-control" placeholder="Digite sua busca aqui..." value="<?=$search?>">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Procurar</button>
						</span>
					</form>
				</div>
			</div>
		</div>

		<div class="panel panel-default">

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
<?php require "footer.php";?>