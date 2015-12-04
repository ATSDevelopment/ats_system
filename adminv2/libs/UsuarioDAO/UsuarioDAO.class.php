<?php
class UsuarioDAO {
	private $mysqli;
	function __construct($mysqli){
		$this->mysqli = $mysqli;
	}

	function obter_por_codigo($codigo){
		$prepared = $this->mysqli->prepare("SELECT nome_de_usuario, senha, bloqueado FROM usuarios WHERE codigo=?");
		$prepared->bind_param("i", $codigo);
		$prepared->execute();
		$prepared->bind_result($nome_de_usuario, $senha, $bloqueado);

		$result = null;
		if($prepared->fetch()){
			$result = array(
				'codigo' => $codigo,
				'nome_de_usuario' => $nome_de_usuario,
				'senha' => $senha,
				'bloqueado' => $bloqueado ? true:false
				);
		}

		$prepared->close();

		return $result;
	}

	function salvar_usuario(&$u){
		$q;

		if($u['codigo'] == 0){
			$q = "INSERT INTO usuarios SET nome_de_usuario=?, senha=?, bloqueado=?";
		}else{
			$q = "UPDATE usuarios SET nome_de_usuario=?, senha=?, bloqueado=? WHERE codigo=?";
		}

		$prepared = $this->mysqli->prepare($q);

		$bloqueado = $u['bloqueado'] ? 1:0;
		if($u['codigo'] == 0){
			$prepared->bind_param("ssi", $u['nome_de_usuario'], $u['senha'], $bloqueado);
		}else{
			$prepared->bind_param("ssii", $u['nome_de_usuario'], $u['senha'], $bloqueado, $u['codigo']);
		}

		$prepared->execute();

		if($u['codigo'] == 0){
			$u['codigo'] = $prepared->insert_id;
		}

		$prepared->close();
	}
}
?>