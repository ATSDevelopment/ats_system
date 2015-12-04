<?php
define("ROOT", "../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'salvar_tarefa' => function(){
		$t = array(
			'codigo' => $_GET['cod_tarefa'],
			'cod_projeto' => $_GET['cod_projeto'],
			'nome' => $_POST['nome'],
			'cod_funcionario' => $_POST['cod_funcionario'],
			'descricao' => $_POST['descricao'],
			'concluida' => false
			);

		$dao = new ProjetoDAO(get_connection());
		$dao->salvar_tarefa($t);

		header("Location: editar_tarefa.php?cod_projeto=".$_GET['cod_projeto']."&cod_tarefa=".$t['codigo']."&alert=success");
	},
	'deletar_tarefa' => function(){
		$dao = new ProjetoDAO(get_connection());
		$dao->deletar_tarefa($_GET['cod_tarefa']);

		header("Location: editar.php?cod_projeto=".$_GET['cod_projeto']);
	});

$f[$_GET['f']]();
?>