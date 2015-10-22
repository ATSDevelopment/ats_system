<?php
class projeto_dao {
	function salvar_projeto($p){
		if($p['codigo'] == 0){
			return $this->salvar($p);
		}else{
			$this->atualizar($p);
			
			return $p['codigo'];
		}
		
	}
	function salvar($p){
		require "db_connect.php";

		$prepared = $mysqli->prepare("INSERT INTO projetos SET nome=?, descricao=?, status=?, concluido=FALSE");
		$prepared->bind_param("sss", $p['nome'], $p['descricao'], $p['status']);

		$prepared->execute();
		$prepared->close();

		$prepared = $mysqli->prepare("SELECT last_insert_id() FROM projetos");
		$prepared->execute();
		$prepared->bind_param($codigo);
		$prepared->fetch();
		$prepared->close();
		$mysqli->close();

		return $codigo;
	}
	function atualizar($p){
		require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos SET nome=?, descricao=?, status=?, concluido=FALSE WHERE codigo=?");
		$prepared->bind_param("sssi", $p['nome'], $p['descricao'], $p['status'], $p['codigo']);

		$prepared->execute();
		$prepared->close();

		$mysqli->close();
		/*require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos SET nome=?, descricao=?, status=?, concluido=FALSE WHERE codigo=$p['codigo']");
		$prepared->bind_param("sss", $p['nome'], $p['descricao'], $p['status']);

		$prepared->execute();
		$prepared->close();

		$mysqli->close();	*/
	}
	function obter_por_codigo($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT nome, descricao, status, concluido FROM projetos WHERE codigo=$codigo");
		$prepared->execute();
		$prepared->bind_result($nome, $descricao, $status, $concluido);

		$p = null;
		if($prepared->fetch()){
			$p = array();
			$p['codigo'] = $codigo;
			$p['nome'] = $nome;
			$p['descricao'] = $descricao;
			$p['status'] = $status;
			$p['concluido'] = $concluido;
		}

		$prepared->close();
		$mysqli->close();

		return $p;
	}

	function listar_projetos () {
		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT codigo, nome, status, concluido FROM projetos WHERE deletado_em IS NULL");

		$prepared->execute();

		$prepared->bind_result($codigo, $nome, $status, $concluido);

		$result = array();

		while($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome'] = $nome;
			$f['status'] = $status;
			$f['concluido'] = $concluido;
			
			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}
}
?>