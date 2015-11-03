<?php
require "dao/projeto_dao.class.php";

$pdao = new projeto_dao();

$search = null;
if(array_key_exists('search', $_GET)){
	$search = $_GET['search'];
}

$projetos = $pdao->listar_projetos($search);

$nav = "side_btn_p";
require "header.php";
require "sidebar.php";
?>

<div class="sub_body">
	<fieldset>

		<legend>Projetos</legend>

		<div id="fl-search" class="panel panel-default">
			<div class="panel-body row">
				<div class="col-lg-2">
					<a href="projetos_editar.php" class="btn btn-sm btn-primary">Cadastrar Projeto</a>
				</div>
				<div class="col-lg-10">
					<form class="input-group input-group-sm">
						<input name="search" type="text" class="form-control" placeholder="Digite sua busca aqui...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Buscar</button>
						</span>
					</form>
				</div>
			</div>
		</div>

		<div id="list-funcionarios" class="panel panel-default">

			<table class="table">
				<tr>
					<th>#</th>
					<th>Codigo</th>
					<th>Nome</th>
					<th>Status</th>
					<th>Concluído</th>
				</tr>
				<?php
				foreach ($projetos as $p) {
					?>
					<tr>
						<td>
							<a href="projetos_editar.php?cod_projeto=<?=$p['codigo']?>">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
						</td>
						<td>
							<?=$p['codigo']?>
						</td>
						<td>
							<?=$p['nome']?>
						</td>
						<td>
							<?=$p['status']?>
						</td>
						<td>
							<?=$p['concluido'] ? "sim":"não"?>
						</td>
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