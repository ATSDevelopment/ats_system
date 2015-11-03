<?php
require "projeto_dao.class.php";

if(array_key_exists("op", $_GET)){
	switch ($_GET['op']) {
		case "salvar_projeto":
		salvar_projeto();
		break;
		
		case "deletar_projeto":
		deletar_projeto();
		break;

		case "finalizar_projeto":
		fr_projeto(true);
		break;

		case "reabrir_projeto":
		fr_projeto(false);
		break;

		case "add_part":
		add_participantes();
		break;

		case "def_gerente":
		sr_gerente(true);
		break;

		case "rem_gerente":
		sr_gerente(false);
		break;
	}
}

function sr_gerente($sr){
	$cod_projeto = $_GET['cod_projeto'];
	$cod_funcionario = $_GET['cod_funcionario'];

	$pdao = new projeto_dao();
	$pdao->sr_gerente($cod_projeto, $cod_funcionario, $sr ? 1:0);

	header("Location: ../projetos_participantes.php?cod_projeto=$cod_projeto");
}

function add_participantes(){
	$array_users = split(" ", $_POST['parts']);

	$cod_projeto = $_GET['cod_projeto'];

	$pdao = new projeto_dao();
	$pdao->add_participantes($cod_projeto, $array_users);

	header("Location: ../projetos_participantes.php?cod_projeto=$cod_projeto");
}

function fr_projeto($finalizado){
	$cod = $_GET['cod_projeto'];

	$pdao = new projeto_dao();
	$pdao->fr_projeto($cod, $finalizado ? 1:0);

	$alert_title = "Sucesso!";
	$alert_message = "Projeto ".($finalizado ? "finalizado":"reaberto")." com sucesso!";
	$alert_redirect = "projetos_editar.php?cod_projeto=$cod";

	Header("Location: ../alert.php?title=$alert_title&message=$alert_message&default_redirect=$alert_redirect");
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
	$cod = $_GET['cod_projeto'];

	$pdao = new projeto_dao();
	$pdao->deletar_projeto($cod);

	$alert_title = "Sucesso!";
	$alert_message = "Projeto deletado com sucesso!";
	$alert_redirect = "projetos_listar.php";

	Header("Location: ../alert.php?title=$alert_title&message=$alert_message&default_redirect=$alert_redirect");
}
?>