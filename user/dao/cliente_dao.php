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
		case 'salvar_respostas':
		salvar_respostas();
		break;
		case 'salvar_msg':
		salvarMsg();
		break;
	}
}

function salvar_respostas(){
	
	$f = array();

	if ($_POST['quant']>1) {

		for ($i=1; $i <$_POST['quant'] ; $i++) { 
			echo $_POST[$i].'<br>';

			list ($cod, $resp) = split ('[-]', $_POST[$i]);

			$var['cod'] = $cod;
			$var['resp'] =$resp;
			$f[] = $var;
		}

		$fdao = new cliente_dao();
		$resposta = $fdao->salvar_respostas($f);

	}
	Header("Location: ../area_do_cliente.php?nav=projetos");
	
}

function salvar_foto(){

	include "upload.class.php"; 

	echo "entrou no metodo";

	if ((isset($_POST["submit"])) && (! empty($_FILES['foto']))){

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
function salvarMsg(){
	require"msgDAO.php";

		$msg = array(
			'cod_projeto' => $_GET['cod_projeto'],
			'cod_usuario' => $_GET['cod_usuario'],
			'conteudo' => str_replace("\n", "", str_replace("\t", "", $_POST['conteudo']))
			);

		$dao = new MensagemDAO();
		$dao->salvar_mensagem($msg);
		Header("Location: ../area_do_cliente.php?nav=projetos");
	}

?>