<?php
define("ROOT", "../../../..");

require ROOT."/libs/lib_list.php";

$msg = array(
	'cod_projeto' => $_GET['cod_projeto'],
	'cod_usuario' => $_GET['cod_usuario'],
	'conteudo' => str_replace("\n", "", str_replace("\t", "", $_POST['conteudo']))
	);

$dao = new MensagemDAO(get_connection());
$dao->salvar_mensagem($msg);

header("Location: chat.php?cod_projeto=".$_GET['cod_projeto']);
?>