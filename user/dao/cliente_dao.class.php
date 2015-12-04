<?php
class cliente_dao {
	function salvar_cliente($f){
		if($f['codigo'] == 0){
			$resp = $this->salvar($f);
		}else{
			$resp = $this->atualizar($f);
		}
		return $resp;
	}


	function salvar_respostas($f){
		require "db_connect.php";

		foreach ($f as $form) {
			$query = "
			UPDATE 
			questoes 
			SET 
			resposta=?
			WHERE
			codigo = ?
			";
			$prepared = $mysqli->prepare($query);
			$prepared->bind_param("ii",$form['resp'],$form['cod']);

			$prepared->execute();
			$prepared->close();
		}
		$mysqli->close();

	}


	function salvar($f){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			u.codigo
			FROM 
			usuarios u
			WHERE 
			u.nome_de_usuario = ?");

		$prepared-> bind_param("s", $f['nome_de_usuario']);
		$prepared->execute();
		$prepared->bind_result($codigo);

		
		$resposta = array();

		if($prepared->fetch()){

			$resposta['existe'] = true;
			$prepared->close();

		}else{

			$resposta['existe'] = null;
			$prepared->close();

			$prepared = $mysqli->prepare("INSERT INTO usuarios SET nome_de_usuario=?, senha=?, bloqueado=false");
			$prepared->bind_param("ss", $f['nome_de_usuario'], $f['senha']);
			$prepared->execute();
			$prepared->close();

			$prepared = $mysqli->prepare("SELECT last_insert_id() FROM usuarios");
			$prepared->execute();
			$prepared->bind_result($cod_usuario);
			$prepared->fetch();
			$prepared->close();

			$prepared=$mysqli->prepare("INSERT INTO clientes SET nome_completo=?, cpf_cnpj=?, cod_usuario=?");
			$prepared->bind_param("ssi", $f['nome_completo'], $f['cpf_cnpj'], $cod_usuario);
			$prepared->execute();
			$prepared->close();

		}

		$mysqli->close();

		$resposta['salvar'] = true;

		return $resposta;
	}
	function logar($f){


		require "db_connect.php";

		session_start();

		$prepared = $mysqli->prepare("
			SELECT 
			u.codigo,
			u.nome_de_usuario, 
			c.codigo,
			c.nome_completo
			FROM 
			usuarios u
			join clientes c
			on u.codigo = c.cod_usuario
			WHERE 
			u.nome_de_usuario = ?
			AND 	
			u.senha =?");

		$prepared-> bind_param("ss", $f['usuario'], $f['senha']);

		$prepared->execute();

		$prepared->bind_result($codigo, $usuario, $codigo_cli, $nome_cliente);

		$f = null;

		if($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['usuario'] = $usuario;

			$_SESSION["id_usuario"]= $codigo;
			$_SESSION["nome_usuario"] = $usuario;
			$_SESSION["cod_cli"] = $codigo_cli;
			$_SESSION["nome_cli"] = $nome_cliente;


		}

		$prepared->close();

		$mysqli->close();

		return $f;



	}
	function atualizar($f){
		require "db_connect.php";

		$query = "
		UPDATE 
		clientes c 
		join usuarios u 
		on u.codigo = c.cod_usuario 
		SET 
		c.nome_completo=?, 
		c.cpf_cnpj=?,  
		u.senha=?
		WHERE
		c.codigo = ?
		";
		$prepared = $mysqli->prepare($query);
		$prepared->bind_param("sssi", 
			$f['nome_completo'],
			$f['cpf_cnpj'],
			$f['senha'],
			$f['codigo']
			);

		$prepared->execute();
		$prepared->close();

		session_start();

		$_SESSION["nome_cli"] = $f['nome_completo'];

		$mysqli->close();

		$resposta['existe'] = null;
		$resposta['salvar'] = false;
		return $resposta;
	}

	function obter_por_codigo($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			c.nome_completo, 
			c.cpf_cnpj, 
			u.nome_de_usuario, 
			u.senha 
			FROM 
			clientes c 
			join usuarios u 
			on u.codigo = c.cod_usuario 
			WHERE 
			c.codigo = $codigo 
			");

		$prepared->execute();

		$prepared->bind_result($nome_completo, $cpf_cnpj, $nome_de_usuario, $senha);

		$f = null;

		if($prepared->fetch()){

			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;
			$f['cpf_cnpj'] = $cpf_cnpj;
			$f['nome_de_usuario'] = $nome_de_usuario;
			$f['senha'] = $senha;

		}

		$prepared->close();

		$mysqli->close();

		return $f;
	}
	function listar_projetos($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			p.nome,
			p.status,
			p.descricao,
			p.concluido,
			d.codigo,
			d.versao,
			d.diretorio,
			d.participantes
			FROM
			projetos p
			LEFT JOIN
			downloads d 
			ON p.codigo = d.cod_projeto
			WHERE
			p.cod_cliente = $codigo
			");

		$prepared->execute();

		$prepared->bind_result($nome, $status, $descricao, $concluido, $cod_download, $versao, $diretorio, $participantes);

		$result =array();

		while($prepared->fetch()){

			$f = array();
			$f['nome'] = $nome;
			$f['status'] = $status;
			$f['descricao'] = $descricao;
			$f['concluido'] = $concluido;
			$f['cod_download'] = $cod_download;
			$f['versao'] = $versao;
			$f['diretorio'] = $diretorio;
			$f['participantes'] = $participantes;

			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}
	function listar_questoes($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			codigo,
			titulo,
			resposta
			FROM questoes
			WHERE cod_download = $codigo
			");

		$prepared->execute();

		$prepared->bind_result($codigo, $titulo,$resposta);

		$result =array();

		while($prepared->fetch()){

			$f = array();
			$f['codigo'] = $codigo;
			$f['titulo'] = $titulo;
			$f['resposta'] =$resposta;

			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}


/*
	function listar_funcionarios () {
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT
			f.codigo,
			f.nome_completo,
			f.e_mail,
			f.telefone,
			u.nome_de_usuario,
			u.bloqueado
			FROM
			funcionarios f
			join usuarios u
			on f.cod_usuario = u.codigo
			WHERE 
			f.deletado_em IS NULL
			");

		$prepared->execute();

		$prepared->bind_result($codigo, $nome_completo, $e_mail, $telefone, $nome_de_usuario, $bloqueado);

		$result = array();

		while($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;
			$f['e_mail'] = $e_mail;
			$f['telefone'] = $telefone;
			$f['nome_de_usuario'] = $nome_de_usuario;
			$f['bloqueado'] = $bloqueado;

			$result[] = $f;
		}

		$prepared->close();

		$mysqli->close();

		return $result;
	}*/
}
?>