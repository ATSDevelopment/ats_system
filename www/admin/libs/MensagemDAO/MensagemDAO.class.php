<?php
class MensagemDAO {
	private $mysqli;
	function __construct($mysqli) {
		$this->mysqli = $mysqli;
	}

	function salvar_mensagem($msg){
		$cod_projeto = $msg['cod_projeto'];
		$cod_usuario = $msg['cod_usuario'];
		$conteudo = $msg['conteudo'];

		$prepared = $this->mysqli->prepare("INSERT INTO mensagens SET cod_projeto=?, cod_usuario=?, data=NOW(), conteudo=?");
		$prepared->bind_param("iis", $cod_projeto, $cod_usuario, $conteudo);
		$prepared->execute();
		$prepared->close();
	}

	function listar_mensagens($cod_projeto){
		$prepared = $this->mysqli->prepare("SELECT cod_usuario, data, conteudo FROM mensagens WHERE cod_projeto=$cod_projeto");
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

		$dao = new UsuarioDAO($this->mysqli);
		foreach ($results as &$r) {
			$r['usuario'] = $dao->obter_por_codigo($r['usuario']);
		}

		return $results;
	}
}
?>