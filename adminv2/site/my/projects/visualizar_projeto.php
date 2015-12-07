<?php
define("ROOT", "../../..");
define("NAV", "side_btn_mp");

require ROOT."/libs/lib_list.php";
require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";

$cod_projeto = $_GET['cod_projeto'];

$pDao = new ProjetoDAO(get_connection());
//echo LOGGED_USER;
$projeto = $pDao->obter_projeto_por_codigo($cod_projeto);
$parts = $pDao->listar_participantes($cod_projeto);
$tarefas = $pDao->listar_tarefas($cod_projeto);

?>

<div class="sub_body">
	<fieldset>
		<legend>Dados do projeto</legend>

		<div id="alert_info" role="alert" style="display: none"></div>

		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-1">
						<a href="listar_projetos.php?cod_projeto=<?=$projeto['codigo']?>" class="btn btn-primary">Voltar</a>
					</div>

					<div class="col-lg-6">
						<div class="input-group">
							<span class="input-group-addon">Nome do Projeto:</span>
							<input type="text" class="form-control" value="<?=$projeto['nome']?>">
						</div> 
					</div>

					<div class="col-lg-5">
						<div class="input-group">
							<span class="input-group-addon">Cliente:</span>
							<input type="text" class="form-control" value="<?=$projeto['cliente']['nome_completo']?>">
						</div> 
					</div>

				</div> <br />

				<label>Descrição: </label> <br />
				<div class="panel panel-default">
					<div class="panel-body">
						<?=$projeto['descricao']?>
					</div>
				</div> <br />
			</div>
		</fieldset>

		<fieldset>
			<legend>Funcionários participantes</legend>
			<div class="panel panel-default panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Nome de Usuario</th>
							<th>E-Mail</th>
							<th>Telefone</th>
						</tr>
					</thead>
					<tbody id="part_table">
						<?php
						foreach ($parts as $part) {
							?>
							<tr>
								<td><?=$part['nome_completo']?></td>
								<td><?=$part['nome_de_usuario']?></td>
								<td><?=$part['e_mail']?></td>
								<td><?=$part['telefone']?></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</fieldset>

		<fieldset>
			<legend>Tarefas</legend>

			<div class="panel panel-default panel-body">
				<table class="table">
					<tr>
						<th>nome</th>
						<th>responsável</th>
						<th>concluída</th>
						<th></th>
					</tr>
					<?php
					if($tarefas != null){
						foreach ($tarefas as $tar) {
							?>
							<tr>
								<td><?=$tar['nome']?></td>
								<td><?=$tar['funcionario']['nome_completo']?></td>
								<td><?=$tar['concluida'] ? "sim":"não"?></td>
								<?php
								if($tar['funcionario']['codigo'] == LOGGED_USER && !$tar['concluida']){
									?>
									<td>
										<a href="dao.php?f=concluir_tarefa&cod_projeto=<?=$projeto['codigo']?>&cod_tarefa=<?=$tar['codigo']?>">Concluir</a>
									</td>
									<?php
								}
								?>
							</tr>
							<?php
						}
					}
					?>
				</table>
			</div>
		</fieldset>
	</div>
</div>