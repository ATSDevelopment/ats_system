<?php
require "cliente_dao.class.php";

if(array_key_exists("op", $_GET)){
	switch($_GET['op']){
		case "salvar_cliente":
		salvar_cliente();
		break;
		case "salvar_foto":
		salvar_foto();
		break;
		case 'logar_cliente':
		logar();
		break;
	}
}

function salvar_foto(){

	include "upload.class.php"; 

	echo "entrou no metodo";

	if ((isset($_POST["submit"])) && (! empty($_FILES['foto']))){

		echo "entrou";

		$upload = new Upload($_FILES['foto'], 1000, 800, "../img/perfil/");
		$upload->salvar(); 
	} 
	Header("Location: ../area_do_cliente.php?nav=perfil");

}

function salvar_cliente(){
	

	$f = array();
	$f['codigo'] = $_GET['cod_cliente'];
	$f['nome_completo'] = $_POST['nome_cliente'];
	$f['cpf_cnpj'] = $_POST['cpf_cnpj'];
	$f['senha'] = $_POST['senha'];

	if (isset($_POST['usuario'])) {
		$f['nome_de_usuario'] = $_POST['usuario'];
	}

	$fdao = new cliente_dao();
	$resposta = $fdao->salvar_cliente($f);

	if ($resposta['existe'] != true) {		
		if ($resposta['salvar'] != true) {
			Header("Location: ../area_do_cliente.php?nav=projetos");
		}else{
			Header("Location: ../login.php");
		}
	}else{
		Header("Location: ../cadastro.php?exist=true");
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
?>