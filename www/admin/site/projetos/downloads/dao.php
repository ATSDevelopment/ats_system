<?php
define("ROOT", "../../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'salvar_download' => function(){
		var_dump($_FILES);

		move_uploaded_file($_FILES['project_file']['tmp_name'], "files/".$_FILES['project_file']['name']) or die("ERRO AO SALVAR ARQUIVO!");
		
		$down = array(
			'cod_projeto' => $_GET['cod_projeto'],
			'versao' => $_POST['versao'],
			'diretorio' => $_FILES['project_file']['name'],
			'privado' => $_POST['privado'] == 'true'
			);

		$dao = new DownloadDAO(get_connection());
		$dao->salvar_download($down);

		header("Location: listar.php?cod_projeto=".$_GET['cod_projeto']);
	},

	'deletar_download' => function(){
		$dao = new DownloadDAO(get_connection());
		$dao->deletar_download($_GET['cod_download']);

		header("Location: listar.php?cod_projeto=".$_GET['cod_projeto']);
	}	
	);

$f[$_GET['f']]();
?>