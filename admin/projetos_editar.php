<?php
require "header.php";

$p = null;

if(array_key_exists("cod_projeto", $_GET)){
	require "dao/projeto_dao.class.php";

	$dao = new projeto_dao();
	$p = $dao->obter_por_codigo($_GET['cod_projeto']);
}

?>
<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: "textarea"
	});
</script>
<link rel="stylesheet" type="text/css" href="css/projetos_editar.css">
<fieldset>
	<legend>Cadastro de Projetos</legend>
	<div id="p_editor" class="panel panel-default">
		<div class="panel-body">
			<form name="form_projeto" method="post" action="dao/projeto_dao.php?op=salvar_projeto&cod_projeto=<?=$p['codigo']?>">
				<div class="row input_row">
					<div class="col-lg-2">
						<label>Nome do Projeto:</label>
					</div>
					<div class="col-lg-10">
						<input name="nome" type="text" class="form-control" />
					</div>
				</div>

				<div class="input_row">
					<label>Descrição: </label>
					<textarea name="descricao" rows="10"></textarea>
				</div>

				<div class="row input_row">
					<div class="col-lg-1">
						<label>Status:</label>
					</div>
					<div class="col-lg-11">
						<input name="status" type="text" class="form-control" />
					</div>
				</div>

				<div id="controls">
					<a href="projetos_listar.php" class="btn btn-primary">Voltar</a>

					<div id="con_ger" class="btn-group" role="group" aria-label="...">
						<a href="#" class="btn btn-primary disabled">Gerenciar Tarefas</a>
						<a href="#" class="btn_unlock btn btn-primary disabled">Gerenciar Participantes</a>
					</div>
					<div id="con_sd" class="btn-group" role="group" aria-label="...">
						<a href="#" class="btn_unlock btn btn-primary disabled">Deletar</a>
						<a href="#" class="btn_unlock btn btn-primary disabled">Finalizar</a>
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</fieldset>

<?php
if($p != null){
	?>
	<script type="text/javascript">
		document.form_projeto.nome.value="<?=$p['nome']?>";
		document.form_projeto.descricao.value="<?=$p['descricao']?>";
		document.form_projeto.status.value="<?=$p['status']?>";

		$(".btn_unlock").attr("class", "btn_sd btn btn-primary");
	</script>
	<?php
}
require "footer.php";
?>