<?php
$api['salvar_funcionario'] = function(){
	$dao = new FuncionarioDAO(get_connection());
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