<?php
define("ROOT", "../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'deletar_cliente' => function(){
		$dao = new ClienteDAO(get_connection());

		$dao->deletar_cliente($_GET['cod_cliente']);

		Header("Location: listar.php?alert=success");
	}
	);

$f[$_GET['f']]();
?>