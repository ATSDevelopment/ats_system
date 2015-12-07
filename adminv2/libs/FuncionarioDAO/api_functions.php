<?php
$api['salvar_funcionario'] = function(){
	$dao = new FuncionarioDAO(get_connection());
	
	$f['permissoes']['gf'] = $f['permissoes']['gf'] == "true";
	$f['permissoes']['gp'] = $f['permissoes']['gp'] == "true";
	$f['permissoes']['gd'] = $f['permissoes']['gd'] == "true";
	$f['permissoes']['gc'] = $f['permissoes']['gc'] == "true";
	$f['permissoes']['gn'] = $f['permissoes']['gn'] == "true";

	$dao->salvar_funcionario($_POST);

	$response = array();
	if($_POST['codigo'] != 0){
		$response['status'] = "success";
		$response['json'] = $_POST;

		echo json_encode($response);
	}else{
		$response['status'] = 'error';
	}
};

$api['deletar_funcionario'] = function(){
	$dao = new FuncionarioDAO(get_connection());
	$resp = $dao->deletar_funcionario($_POST);

	$response = array('status' => 'success');
	if($resp == 'error'){
		$response = array('status' => "error", 'message' => "Erro ao deletar funcionario!");
	}
	echo json_encode($response);
}
?>