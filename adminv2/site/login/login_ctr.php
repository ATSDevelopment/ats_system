<?php
define("ROOT", "../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'login' => function(){
		$nome_de_usuario = $_POST['nome_de_usuario'];
		$senha = $_POST['senha'];

		$dao = new FuncionarioDAO(get_connection());

		$codigo = $dao->auth($nome_de_usuario, $senha);

		if($codigo != null){
			session_start();

			$_SESSION['USER_ID'] = $codigo;

			session_commit();

			header("Location: ".ROOT."/site/funcionarios/listar.php");
		}else{

			header("Location: ".ROOT."/site/login/login.php?error=true");
		}
	},
	'logout' => function(){
		session_start();

		$_SESSION['USER_ID'] = 0;

		session_commit();

		header("Location: ".ROOT."/site/login/login.php");
	}
	);

$f[$_GET['f']]();
?>