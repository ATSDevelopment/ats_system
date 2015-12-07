<?php
class MensagemDAO {
	function salvar_mensagem($msg){
		require "db_connect.php";

		$cod_projeto = $msg['cod_projeto'];
		$cod_usuario = $msg['cod_usuario'];
		$conteudo = $msg['conteudo'];

		$prepared = $mysqli->prepare("INSERT INTO mensagens SET cod_projeto=?, cod_usuario=?, data=NOW(), conteudo=?");
		$prepared->bind_param("iis", $cod_projeto, $cod_usuario, $conteudo);
		$prepared->execute();
		$prepared->close();
	}

	function listar_mensagens($cod_projeto){
		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT cod_usuario, data, conteudo FROM mensagens WHERE cod_projeto=$cod_projeto");
		$prepared->execute();
		$prepared->bind_result($cod_usuario, $data, $conteudo);

		$results = array();
		while($prepared->fetch()){
			$results[] = array(
				'usuario' => $cod_usuario,
				'data' => $data,
				'conteudo' => $conteudo
				);
		}

		$prepared->close();

		$dao = new cliente_dao();

		foreach ($results as &$r) {

			$r['nome_usuario'] = $dao->obter_usuario_por_codigo($r['usuario']);
			
		}
		echo json_encode($results);

		return $results;
	}
}
?>
