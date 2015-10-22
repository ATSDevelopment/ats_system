<?php
require "projeto_dao.class.php";

if(array_key_exists("op", $_GET)){
	switch ($_GET['op']) {
		case "salvar_projeto":
			salvar_projeto();
			break;
		
		case "eletar_projeto":
			deletar_projeto();
			break;
	}
}

function salvar_projeto(){
	$p = array();

	$p['codigo'] = $_GET['cod_projeto'];
	$p['nome'] = $_POST['nome'];
	$p['descricao'] = str_replace("\n", "", str_replace("\r", "", $_POST['descricao']));
	$p['status'] = $_POST['status'];

	$dao = new projeto_dao();
	$cod = $dao->salvar_projeto($p);

	header("Location: ../projetos_editar.php?cod_projeto=$cod");
}

function deletar_projeto(){
}
?>