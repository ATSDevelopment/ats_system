<?php
$api['deletar_participante'] = function(){
	$pDao = new ProjetoDAO(get_connection());

	$pDao->deletar_participante($_POST['cod_projeto'], $_POST['cod_funcionario']);

	$part = $pDao->listar_participantes($_POST['cod_projeto']);

	$html = "";

	foreach ($part as $p) {

		$codigo = $p['codigo'];
		$nome = $p['nome_completo'];
		$nome_de_usuario = $p['nome_de_usuario'];
		$e_mail = $p['e_mail'];
		$telefone = $p['telefone'];

		$html = $html."
		<tr>
			<td>
				<button onclick=deletar_participante($codigo)>DELETE</button>
			</td>
			<td>$nome</td>
			<td>$nome_de_usuario</td>
			<td>$e_mail</td>
			<td>$telefone</td>
		</tr>
		";
	}

	$result = array(
		'status' => 'success',
		'json' => $part,
		'html' => $html
		);

	echo json_encode($result);
};

$api['projeto_add_participante'] = function(){
	$con = get_connection();

	$fDao = new FuncionarioDAO($con);
	$f = $fDao->obter_por_nome_de_usuario($_POST['nome_de_usuario']);

	$pDao = new ProjetoDAO($con);
	$pDao->adicionar_participante($_POST['cod_projeto'], $f['codigo']);

	$part = $pDao->listar_participantes($_POST['cod_projeto']);

	$html = "";

	foreach ($part as $p) {

		$codigo = $p['codigo'];
		$nome = $p['nome_completo'];
		$nome_de_usuario = $p['nome_de_usuario'];
		$e_mail = $p['e_mail'];
		$telefone = $p['telefone'];

		$html = $html."
		<tr>
			<td>
				<button onclick=deletar_participante($codigo)>DELETE</button>
			</td>
			<td>$nome</td>
			<td>$nome_de_usuario</td>
			<td>$e_mail</td>
			<td>$telefone</td>
		</tr>
		";
	}

	$result = array(
		'status' => 'success',
		'json' => $part,
		'html' => $html
		);

	echo json_encode($result);
};

$api['salvar_projeto'] = function(){
	$_POST['concluido'] = $_POST['concluido'] == "true";

	$pDao = new ProjetoDAO(get_connection());
	$pDao->salvar_projeto($_POST);

	$result = array();
	if($_POST['codigo'] != 0){
		$result['status'] = 'success';
		$result['json'] = $_POST;
	}else{
		$result['status'] = 'error';
		$result['message'] = "Erro ao salvar projeto";
	}

	echo json_encode($result);
}
?>