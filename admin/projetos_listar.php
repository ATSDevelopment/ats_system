<?php
require "dao/projeto_dao.class.php";

$pdao = new projeto_dao();

$projetos = $pdao->listar_projetos();

require "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/funcionarios_listar.css">

<div class="row">
	<div class="col-lg-2">
		<?php require "admin_nav.php"; ?>
	</div>
	<div class="col-lg-10">
		<fieldset id="funcionarios_list_content">

			<legend>Projetos</legend>

			<div id="fl-search" class="panel panel-default">
				<div class="panel-body row">
					<div class="col-lg-2">
						<a href="projetos_editar.php" class="btn btn-sm btn-primary">Cadastrar Projeto</a>
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
								<?=$p['concluido']?>
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

<?php
require "footer.php";
?>