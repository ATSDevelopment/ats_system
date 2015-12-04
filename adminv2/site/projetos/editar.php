<?php
define("ROOT", "../..");
define("NAV", "side_btn_p");

require ROOT."/libs/lib_list.php";

$projeto = null;
$participantes = null;
$tarefas = null;
if(array_key_exists('cod_projeto', $_GET)){
	$pDao = new ProjetoDAO(get_connection());
	$projeto = $pDao->obter_projeto_por_codigo($_GET['cod_projeto']);
	$participantes = $pDao->listar_participantes($_GET['cod_projeto']);
	$tarefas = $pDao->listar_tarefas($_GET['cod_projeto']);
}

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<link rel="stylesheet" type="text/css" href="css/editar.css">
<script type="text/javascript" src="js/editar.js"></script>
<div class="sub_body">
	<fieldset>
		<legend>Dados do projeto</legend>

		<div id="alert_info" role="alert" style="display: none"></div>

		<form class="panel panel-default panel-body">
			<div class="row">
				<div class="col-lg-5">
					<div class="input-group">
						<span class="input-group-addon" id="addon_tf_projeto">Nome do Projeto:</span>
						<input id="tf_nome_completo" type="text" class="form-control" aria-describedby="addon_tf_projeto">
					</div> 
				</div>

				<div class="col-lg-3">
					<div class="input-group">
						<span class="input-group-addon" id="addon_cb_cliente">Cliente:</span>
						<select id="cb_cliente" class="form-control" aria-describedby="addon_cb_cliente">
							<?php

							$cDao = new ClienteDAO(get_connection());
							$clientes = $cDao->listar_clientes(null);

							foreach ($clientes as $c) {
								?>
								<option value="<?=$c['codigo']?>"><?=$c['nome_completo']?></option>
								<?
							}
							?>
						</select>
					</div> 
				</div>

				<div id="controls_padding" class="col-lg-4">
					<div class="btn-group">
						<a href="listar.php" class="btn btn-primary">Voltar</a>
						<a href="downloads/listar.php?cod_projeto=<?=$projeto['codigo']?>" class="btn btn-primary">Downloads</a>
						<button id="btn_deletar" type="button" class="btn btn-primary">Deletar</button>
						<button id="btn_salvar" type="button" class="btn btn-primary">Salvar</button>
					</div>
				</div>
			</div> <br />

			<label>Descrição: </label> <br />
			<textarea id="area_descricao" name="area_descricao" class="form-control"></textarea> <br />

			<div class="row">
				<div style="width: 500px;">
					<div class="col-lg-1"><input type="checkbox" id="cbx_concluido"></div>
					<div class="col-lg-11"><label>Concluído</label></div>
				</div>
			</div>
			
		</form>
	</fieldset>

	<fieldset>
		<legend>Funcionários participantes</legend>

		<div id="alert_participantes" role="alert" style="display: none"></div>

		<div class="panel panel-default panel-body">
			<div class="input-group">
				<span class="input-group-addon" id="addon_tf_cp">Nome de Usuario:</span>
				<input id="tf_cadastrar_participante" type="text" class="form-control" aria-describedby="addon_tf_cp">
				<div class="input-group-btn">
					<button id="btn_cadastrar_part" type="button" class="btn btn-default">Cadastrar</button>
				</div>
			</div> 
		</div>

		<div class="panel panel-default panel-body">
			<table class="table">
				<thead>
					<tr>
						<th></th>
						<th>Nome</th>
						<th>Nome de Usuario</th>
						<th>E-Mail</th>
						<th>Telefone</th>
					</tr>
				</thead>
				<tbody id="part_table">
					<?php
					if($participantes != null){
						foreach ($participantes as $part) {
							?>
							<tr>
								<td>
									<button onclick="deletar_participante(<?=$part['codigo']?>)">DELETE</button>
								</td>
								<td><?=$part['nome_completo']?></td>
								<td><?=$part['nome_de_usuario']?></td>
								<td><?=$part['e_mail']?></td>
								<td><?=$part['telefone']?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</fieldset>

	<fieldset>
		<legend>Tarefas</legend>

		<button id="btn_add_tarefa" class="btn btn-primary">Adicionar Tarefa</button> <br /> <br />

		<div class="panel panel-default panel-body">
			<table class="table">
				<tr>
					<th></th>
					<th>nome</th>
					<th>responsável</th>
					<th>concluída</th>
				</tr>
				<?php
				if($tarefas != null){
					foreach ($tarefas as $tar) {
						?>
						<tr>
							<td>
								<a href="editar_tarefa.php?cod_projeto=<?=$projeto['codigo']?>&cod_tarefa=<?=$tar['codigo']?>">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
							</td>
							<td><?=$tar['nome']?></td>
							<td><?=$tar['funcionario']['nome_completo']?></td>
							<td><?=$tar['concluida'] ? "sim":"não"?></td>
						</tr>
						<?php
					}
				}
				?>
			</table>
		</div>
	</fieldset>
</div>

<script src=<?=ROOT.'/vendor/tinymce/js/tinymce/tinymce.min.js'?>></script>
<script src=<?=ROOT.'/site/js/tinymce_init.js'?>></script>

<?php
if($projeto != null){
	?>
	<script type="text/javascript">
		projeto = JSON.parse('<?=json_encode($projeto)?>');

		update_form_projeto();
	</script>
	<?php
}
?>