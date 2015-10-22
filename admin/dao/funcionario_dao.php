<?php
require "funcionario_dao.class.php";

if(array_key_exists("op", $_GET)){
	switch($_GET['op']){
		case "salvar_funcionario":
		salvar_funcionario();
		break;
		case "deletar_funcionario":
		break;
	}
}

function salvar_funcionario(){
	$f = array();
	$f['codigo'] = $_GET['cod_funcionario'];
	$f['nome_completo'] = $_POST['nome_completo'];
	$f['e_mail'] = $_POST['e_mail'];
	$f['telefone'] = $_POST['telefone'];
	$f['ativo'] = array_key_exists("ativo", $_POST);
	$f['observacoes'] = str_replace("\r", "", str_replace("\n", '', $_POST['observacoes']));
	$f['nome_de_usuario'] = $_POST['usuario'];
	$f['senha'] = $_POST['senha'];
	$f['bloqueado'] = array_key_exists("bloqueado", $_POST);

	$p = array();

	$p['gf'] = array_key_exists("ger_func", $_POST);
	$p['gp'] = array_key_exists("ger_proj", $_POST);
	$p['gd'] = array_key_exists("ger_down", $_POST);
	$p['gc'] = array_key_exists("ger_cli", $_POST);
	$p['gn'] = array_key_exists("ger_not", $_POST);

	$f['permissoes'] = $p;

	$fdao = new funcionario_dao();
	$cod = $fdao->salvar_funcionario($f);

	Header("Location: ../funcionarios_editar.php?cod_funcionario=$cod");
}

function deletar_funcionario(){
	$cod = $_GET['cod_funcionario'];

	$fdao = new funcionario_dao();
	$fdao->deletar_funcionario($cod);

	Header("Location: ../funcionarios_listar.php");
}
?>