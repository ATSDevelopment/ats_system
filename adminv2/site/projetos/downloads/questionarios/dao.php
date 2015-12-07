<?php
define("ROOT", "../../../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'salvar_pergunta' => function(){
		$cod_projeto = $_GET['cod_projeto'];
		$cod_download = $_GET['cod_download'];
		$questao = $_POST['titulo'];

		$dao = new DownloadDAO(get_connection());
		$dao->salvar_pergunta($cod_download, $questao);

		header("Location: questionario.php?cod_projeto=$cod_projeto&cod_download=$cod_download");
	},
	'deletar_pergunta' => function(){
		$cod_projeto = $_GET['cod_projeto'];
		$cod_download = $_GET['cod_download'];
		$cod_pergunta = $_GET['cod_pergunta'];

		$dao = new DownloadDAO(get_connection());
		$dao->deletar_pergunta($cod_pergunta);

		header("Location: questionario.php?cod_projeto=$cod_projeto&cod_download=$cod_download");
	});

$f[$_GET['f']]();