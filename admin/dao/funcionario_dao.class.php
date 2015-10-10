<?php
class funcionario_dao {
	function obter_por_codigo($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT nome_completo, e_mail, telefone, nome_de_usuario, senha, observacoes FROM funcionarios WHERE codigo=?");

		$prepared->bind_param(1, $codigo);

		$prepared->execute();

		$prepared->bind_result($nome_completo, $e_mail, $telefone, $nome_de_usuario, $senha, $observacoes);

		$f = null;

		if($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;
			$f['e_mail'] = $e_mail;
			$f['telefone'] = $telefone;
			$f['nome_de_usuario'] = $nome_de_usuario;
			$f['senha'] = $senha;
			$f['observacoes'] = $observacoes;
		}

		$prepared->close();

		$mysqli->close();

		return $f;
	}

	function listar_nomes () {
		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT codigo, nome_completo FROM funcionarios WHERE deletado_em IS NULL");

		$prepared->execute();

		$prepared->bind_result($codigo, $nome_completo);

		$result = array();

		while($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;

			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}
}
?>