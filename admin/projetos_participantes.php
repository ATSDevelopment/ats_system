<?php
$p;
if(array_key_exists("cod_projeto", $_GET)){
	require "dao/projeto_dao.class.php";

	$cod = $_GET['cod_projeto'];

	$dao = new projeto_dao();
	$p = $dao->obter_por_codigo($cod);
}else{
	//header("Location: projetos_listar.php");
}

require "header.php";
require "sidebar.php";
?>

<div id="projetos_participantes_body">
	<fieldset>
		<legend>Gerenciar Participantes</legend>
		<div class="row panel panel-default panel-body">
			<div class="col-lg-2">
				<a href="" class="btn btn-primary">Adicionar Participante</a>
			</div>
			<div class="col-lg-10 input-group">
				
			</div>
		</div>
	</fieldset>
</div>