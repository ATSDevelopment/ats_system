<?php
require "cliente_dao.class.php";

if(array_key_exists("op", $_GET)){
	switch($_GET['op']){
		case "salvar_cliente":
		salvar_cliente();
		break;
		case "deletar_cliente":
		break;
		case 'logar_cliente':
		logar();
		break;
	}
}

function salvar_cliente(){
	

	$f = array();
	$f['codigo'] = $_GET['cod_cliente'];
	$f['nome_completo'] = $_POST['nome_cliente'];
	$f['cpf_cnpj'] = $_POST['cpf_cnpj'];
	$f['nome_de_usuario'] = $_POST['usuario'];
	$f['senha'] = $_POST['senha'];

	$fdao = new cliente_dao();
	$resposta = $fdao->salvar_cliente($f);

	if ($resposta['existe'] = true) {
		Header("Location: ../cadastro.php?exist=true");
	}else{
		if ($resposta['salvar'] != true) {
			Header("Location: ../area_do_cliente.php?nav=projetos");
		}else{
			Header("Location: ../login.php");
		}
	}
	
}
function logar(){
	$f = array();

	$f['usuario'] = $_POST['usuario'];
	$f['senha'] = $_POST['senha'];

	$fdao =new cliente_dao();
	$resp = $fdao -> logar($f);

	if($resp!=null){
		Header("Location: ../area_do_cliente.php?nav=projetos");
	}else{

		Header("Location: ../login.php?exist=false");
	}
}
function deletar_funcionario(){

}
?>