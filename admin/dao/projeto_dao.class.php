<?php
class projeto_dao {
	function sr_gerente($cod_projeto, $cod_funcionario, $gerente){
		require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos_funcionarios SET gerente=? WHERE cod_projeto=? AND cod_funcionario=?");
	
		$prepared->bind_param("iii", $gerente, $cod_projeto, $cod_funcionario);
		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}
	function add_participantes($cod_projeto, $array_users){
		$str = "'$array_users[0]'";

		$size = sizeof($array_users);
		for($i=1; $i<$size; $i++){
			$str = $str.",'".$array_users[$i]."'";
		}

		require "db_connect.php";

		$prepared = $mysqli->prepare("SELECT 
			f.codigo 
			FROM 
			funcionarios f 
			JOIN usuarios u 
			ON u.codigo=f.cod_usuario 
			WHERE 
			f.deletado_em IS NULL
			AND 
			u.nome_de_usuario IN ($str)"); 
		$prepared->execute();
		$prepared->bind_result($codigo);

		$str = "";
		if($prepared->fetch()){
			$str = "($cod_projeto, $codigo, false)";
			while ($prepared->fetch()) {
				$str = $str.", ($cod_projeto, $codigo, false)";
			}
		}
		$prepared->close();

		$prepared = $mysqli->prepare("INSERT INTO projetos_funcionarios VALUES $str");
		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}

	function listar_participantes($cod_projeto){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			f.codigo, 
			f.nome_completo, 
			f.e_mail, 
			f.telefone,
			pf.gerente
			FROM
			funcionarios f 
			JOIN projetos_funcionarios pf 
			ON pf.cod_funcionario = f.codigo
			WHERE 
			pf.cod_projeto=?");

		$prepared->bind_param("i", $cod_projeto);
		$prepared->execute();
		$prepared->bind_result($codigo, $nome_completo, $e_mail, $telefone, $gerente);

		$result = array();
		while($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;
			$f['e_mail'] = $e_mail;
			$f['telefone'] = $telefone;
			$f['gerente'] = $gerente;

			$result[] = $f;
		}

		$prepared->close();
		$mysqli->close();

		return $result;
	}

	function fr_projeto($cod_projeto, $finalizado){
		require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos SET concluido=? WHERE codigo=?");

		$prepared->bind_param("ii", $finalizado, $cod_projeto);
		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}

	function deletar_projeto($cod_projeto){
		require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos SET deletado_em=NOW() WHERE codigo=?");
		$prepared->bind_param("i", $cod_projeto);
		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}
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
		$prepared->bind_result($cod_projeto);
		$prepared->fetch();
		$prepared->close();

		$mysqli->close();

		return $cod_projeto;
	}
	function atualizar($p){
		require "db_connect.php";

		$prepared = $mysqli->prepare("UPDATE projetos SET nome=?, descricao=?, status=?, concluido=FALSE WHERE codigo=?");
		$prepared->bind_param("sssi", $p['nome'], $p['descricao'], $p['status'], $p['codigo']);

		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}
	function obter_por_codigo($codigo){
		require "db_connect.php";

		$query = "SELECT p.nome, p.descricao, p.status, p.concluido, count(pf.cod_funcionario) FROM projetos p LEFT JOIN projetos_funcionarios pf ON p.codigo=pf.cod_projeto WHERE p.codigo=? GROUP BY p.codigo";
		$prepared = $mysqli->prepare($query);
		$prepared->bind_param("i", $codigo);
		$prepared->execute();
		$prepared->bind_result($nome, $descricao, $status, $concluido, $n_participantes);

		$p = null;
		if($prepared->fetch()){
			$p = array();
			$p['codigo'] = $codigo;
			$p['nome'] = $nome;
			$p['descricao'] = $descricao;
			$p['status'] = $status;
			$p['concluido'] = $concluido;
			$p['n_participantes'] = $n_participantes;
		}

		$prepared->close();
		$mysqli->close();

		return $p;
	}

	function listar_projetos ($where) {
		require "db_connect.php";

		$query = "SELECT codigo, nome, status, concluido FROM projetos WHERE deletado_em IS NULL";
		if($where != null){
			$query = $query." AND (nome LIKE '%$where%'";
				$query = $query." OR status LIKE '%$where%'";
				$query = $query." OR descricao LIKE '%$where%')";
}

$prepared = $mysqli->prepare($query);

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