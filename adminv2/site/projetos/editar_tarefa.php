<?php
define("ROOT", "../..");
define("NAV", "side_btn_p");

require ROOT."/libs/lib_list.php";

$cod_projeto = $_GET['cod_projeto'];

$cod_tarefa=0;
if(array_key_exists("cod_tarefa", $_GET)){
	$cod_tarefa = $_GET['cod_tarefa'];
}

$dao = new ProjetoDAO(get_connection());
$participantes = $dao->listar_participantes($cod_projeto);

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<script src=<?=ROOT."/vendor/tinymce/js/tinymce/tinymce.min.js"?>></script>
<script type="text/javascript" src=<?=ROOT."/site/js/tinymce_init.js"?>></script>
<script type="text/javascript" src="js/editar_tarefa.js"></script>

<div class="sub_body">
	<fieldset>
		<legend>Editar Tarefa</legend>
		<?php
		if(array_key_exists("alert", $_GET)){
			if($_GET['alert'] == 'success'){
				?>
				<div class="alert alert-success">Tarefa salva com sucesso!</div>
				<?php
			}else if($_GET['alert'] == 'error'){
				?>
				<div class="alert alert-failed">Erro ao salvar tarefa</div>
				<?php
			}
		}
		?>
		<form name="form" class="panel panel-default panel-body" method="post" action="dao.php?f=salvar_tarefa&cod_projeto=<?=$cod_projeto?>&cod_tarefa=<?$cod_tarefa?>">
			<div class="row">
				<div class="col-lg-2">
					<label>Título</label>
				</div>
				<div class="col-lg-10">
					<input name="nome" class="form-control">
				</div>
			</div>

			<br />

			<div class="row">
				<div class="col-lg-2">
					<label>Funcionário</label>
				</div>
				<div class="col-lg-10">
					<select id="cod_funcionario" name="cod_funcionario" class="form-control">
						<?php
						foreach ($participantes as $p) {
							?>
							<option value="<?=$p['codigo']?>"><?=$p['nome_completo']?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>

			<br />

			<label>Descrição</label>

			<br />
			<textarea name="descricao"></textarea>
			<br />
			
			<div class="btn-group" role="group">
				<a href="editar.php?cod_projeto=<?=$cod_projeto?>" type="button" class="btn btn-default">Voltar</a>
				<a href="dao.php?f=deletar_tarefa&cod_projeto=<?=$cod_projeto?>&cod_tarefa=<?=$cod_tarefa?>" type="button" class="btn btn-default">Deletar</a>
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
		</form>
	</fieldset>
</div>
<?php

if($cod_projeto != 0){
	$dao = new ProjetoDAO(get_connection());
	$p = $dao->obter_tarefa_por_codigo($cod_tarefa);
	$json = json_encode($p);
	?>

	<script type="text/javascript">
		json = JSON.parse('<?=$json?>');
		preencher(json);
	</script>

	<?php
}
require "../footer.php";
?>