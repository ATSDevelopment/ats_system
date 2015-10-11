<?php
class funcionario_dao {
	function salvar_funcionario($f){
		echo "1";
		if($f['codigo'] == 0){
			$this->salvar($f);
		}else{
			$this->atualizar($f);
		}
	}
	function salvar($f){
		require "db_connect.php";

		/*$prepared = $mysqli->prepare("START TRANSACTION");
		$prepared->execute();
		$prepared->close();*/

		$prepared = $mysqli->prepare("INSERT INTO usuarios SET nome_de_usuario=?, senha=?, bloqueado=?");
		$prepared->bind_param("ssi", $f['nome_de_usuario'], $f['senha'], $f['bloqueado']);
		$prepared->execute();
		$prepared->close();

		$prepared = $mysqli->prepare("SELECT last_insert_id() FROM usuarios");
		$prepared->execute();
		$prepared->bind_result($cod_usuario);
		$prepared->fetch();
		$prepared->close();

		$prepared=$mysqli->prepare("INSERT INTO funcionarios SET nome_completo=?, e_mail=?, telefone=?, observacoes=?, cod_usuario=?");
		$prepared->bind_param("ssssi", $f['nome_completo'], $f['e_mail'], $f['telefone'], $f['observacoes'], $cod_usuario);
		$prepared->execute();
		$prepared->close();

		$prepared = $mysqli->prepare("SELECT last_insert_id() FROM funcionarios");
		$prepared->execute();
		$prepared->bind_result($cod_funcionario);
		$prepared->fetch();
		$prepared->close();

		$p = $f['permissoes'];
		$prepared = $mysqli->prepare("INSERT INTO permissoes VALUES(?, ?, ?, ?, ?, ?);");
		$prepared->bind_param("iiiiii", $cod_funcionario, $p['gf'], $p['gp'], $p['gd'], $p['gc'], $p['gn']);
		$prepared->execute();
		$prepared->close();

		/*$prepared = $mysqli->prepare("COMMIT");
		$prepared->execute;
		$prepared->close();*/

		$mysqli->close();
	}
	function atualizar($f){
		require "db_connect.php";

		$query = "
		UPDATE 
			funcionarios f 
			join usuarios u 
				on u.codigo = f.cod_usuario 
			join permissoes p 
				on p.cod_funcionario = f.codigo 
		SET 
			f.nome_completo=?, 
			f.e_mail=?, 
			f.telefone=?, 
			f.observacoes=?, 
			u.nome_de_usuario=?,
			u.senha=?,
			u.bloqueado=?,
			p.gerenciar_funcionarios=?,
			p.gerenciar_projetos=?,
			p.gerenciar_downloads=?,
			p.gerenciar_clientes=?,
			p.gerenciar_noticias=?
		WHERE
			f.codigo = ?
		";
		$prepared = $mysqli->prepare($query);
		$prepared->bind_param("ssssssiiiiiii", 
			$f['nome_completo'],
			$f['e_mail'],
			$f['telefone'],
			$f['observacoes'],
			$f['nome_de_usuario'],
			$f['senha'],
			$f['bloqueado'],
			$f['permissoes']['gf'],
			$f['permissoes']['gp'],
			$f['permissoes']['gd'],
			$f['permissoes']['gc'],
			$f['permissoes']['gn'],
			$f['codigo']
		);

		$prepared->execute();
		$prepared->close();

		$mysqli->close();
	}

	function obter_por_codigo($codigo){
		require "db_connect.php";

		$prepared = $mysqli->prepare("
			SELECT 
			f.nome_completo, 
			f.e_mail, 
			f.telefone, 
			f.observacoes, 
			u.nome_de_usuario, 
			u.senha, 
			u.bloqueado, 
			p.gerenciar_funcionarios, 
			p.gerenciar_projetos, 
			p.gerenciar_downloads, 
			p.gerenciar_clientes, 
			p.gerenciar_noticias 
			FROM 
			funcionarios f 
			join usuarios u 
			on u.codigo = f.cod_usuario 
			join permissoes p 
			on p.cod_funcionario=f.codigo 
			WHERE 
			f.codigo = $codigo 
			");

		$prepared->execute();

		$prepared->bind_result($nome_completo, $e_mail, $telefone, $observacoes, $nome_de_usuario,
			$senha, $bloqueado, $ger_func, $ger_proj, $ger_down, $ger_cli, $ger_not);

		$f = null;

		if($prepared->fetch()){
			$f = array();
			$f['codigo'] = $codigo;
			$f['nome_completo'] = $nome_completo;
			$f['e_mail'] = $e_mail;
			$f['telefone'] = $telefone;
			$f['observacoes'] = $observacoes;
			$f['nome_de_usuario'] = $nome_de_usuario;
			$f['senha'] = $senha;
			$f['bloqueado'] = $bloqueado;

			$p = array();
			$p['gf'] = $ger_func;
			$p['gp'] = $ger_proj;
			$p['gd'] = $ger_down;
			$p['gc'] = $ger_cli;
			$p['gn'] = $ger_not;

			$f['permissoes'] = $p;
		}

		$prepared->close();

		$mysqli->close();

		return $f;
	}

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
	}
}
?>