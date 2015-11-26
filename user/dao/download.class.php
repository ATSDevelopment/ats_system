<?php
class download_dao {
	
	function listar_downloads(){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			p.nome,
			p.descricao,
			d.versao,
			d.diretorio
			FROM
			projetos p
			JOIN
			downloads d 
			ON p.codigo = d.cod_projeto
			AND d.participantes = 0
			");

		$prepared->execute();

		$prepared->bind_result($nome, $descricao, $versao, $diretorio);

		$result =array();

		while($prepared->fetch()){

			$f = array();
			$f['nome'] = $nome;
			$f['descricao'] = $descricao;
			$f['versao'] = $versao;
			$f['diretorio'] = $diretorio;

			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}
}
?>