<?php
define("ROOT", "../../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'salvar_perfil' => function(){
		$codigo = $_GET['cod_funcionario'];

		$dao = new FuncionarioDAO(get_connection());
		$func = $dao->obter_por_codigo($codigo);

		$func['nome_completo'] = $_POST['nome_completo'];
		$func['e_mail'] = $_POST['e_mail'];
		$func['telefone'] = $_POST['telefone'];
		$func['usuario']['senha'] = $_POST['senha'];

		$dao->salvar_funcionario($func);

		header("Location: perfil.php");
	});

$f[$_GET['f']]();
?>