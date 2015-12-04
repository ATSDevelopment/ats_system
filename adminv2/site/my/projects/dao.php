<?php
define("ROOT", "../../..");

require ROOT."/libs/lib_list.php";

$f = array(
	'concluir_tarefa' => function(){
		$dao = new ProjetoDAO(get_connection());
		$tarefa = $dao->obter_tarefa_por_codigo($_GET['cod_tarefa']);
		$tarefa['concluida'] = true;
		$tarefa['cod_projeto'] = $tarefa['projeto']['codigo'];
		$tarefa['cod_funcionario'] = $tarefa['funcionario']['codigo'];
		$dao->salvar_tarefa($tarefa);

		Header("Location: visualizar_projeto.php?cod_projeto=".$_GET['cod_projeto']);
	});

$f[$_GET['f']]();
?>