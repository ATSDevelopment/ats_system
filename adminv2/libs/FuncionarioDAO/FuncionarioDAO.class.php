<?php
class FuncionarioDAO {
	private $mysqli;
	function __construct($mysqli){
		$this->mysqli = $mysqli;
	}

	function listar_funcionarios($search){
		$q = "SELECT f.codigo, f.nome_completo, f.e_mail, f.telefone, f.observacoes, f.ativo, f.cod_usuario , p.gerenciar_funcionarios, p.gerenciar_projetos, p.gerenciar_downloads, p.gerenciar_clientes, p.gerenciar_noticias FROM funcionarios f JOIN permissoes p ON p.cod_funcionario = f.codigo JOIN usuarios u ON u.codigo=f.cod_usuario WHERE deletado_em IS NULL";
		if($search != null){
			$q = $q." AND (f.nome_completo LIKE '%$search%'";
			$q = $q." OR f.e_mail LIKE '%$search%'";
			$q = $q." OR f.telefone LIKE '%$search%'";
			$q = $q." OR u.nome_de_usuario LIKE '%$search%')";
		}

		$prepared = $this->mysqli->prepare($q);
		$prepared->execute();
		$prepared->bind_result($codigo, $nome_completo, $e_mail, $telefone, $observacoes, $ativo, $cod_usuario, $gf, $gp, $gd, $gc, $gn);

		$uDao = new UsuarioDAO($this->mysqli);
		$result = array();
		while($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'nome_completo' => $nome_completo,
				'e_mail' => $e_mail,
				'telefone' => $telefone,
				'observacoes' => $observacoes,
				'ativo' => $ativo ? true:false,
				'usuario' => $cod_usuario,
				'permissoes' => array(
					'gf' => $gf ? true:false,
					'gp' => $gp ? true:false,
					'gd' => $gd ? true:false,
					'gc' => $gc ? true:false,
					'gn' => $gn ? true:false
					)
				);
		}

		$prepared->close();

		foreach ($result as $f) {
			$f['usuario'] = $uDao->obter_por_codigo($f['usuario']);
		}

		return $result;
	}

	function deletar_funcionario($f){
		$prepared = $this->mysqli->prepare("UPDATE funcionarios f JOIN usuarios u ON u.codigo=f.cod_usuario SET f.deletado_em=now(), u.bloqueado=true WHERE f.codigo=?");
		$prepared->bind_param("i", $f['codigo']);
		$prepared->execute();
		$prepared->close();

		return "success";
	}

	function obter_por_nome_de_usuario($nome_de_usuario){
		$prepared = $this->mysqli->prepare("SELECT f.codigo FROM funcionarios f JOIN usuarios u ON u.codigo=f.cod_usuario WHERE u.nome_de_usuario=?");
		$prepared->bind_param("s", $nome_de_usuario);
		$prepared->execute();
		$prepared->bind_result($cod_funcionario);
		$prepared->fetch();
		$prepared->close();

		$f = null;
		if($cod_funcionario != null){
			$f = $this->obter_por_codigo($cod_funcionario);
		}

		return $f;
	}

	function obter_por_codigo($codigo){
		$prepared = $this->mysqli->prepare("SELECT f.nome_completo, f.e_mail, f.telefone, f.observacoes, f.ativo, f.cod_usuario , p.gerenciar_funcionarios, p.gerenciar_projetos, p.gerenciar_downloads, p.gerenciar_clientes, p.gerenciar_noticias FROM funcionarios f JOIN permissoes p ON p.cod_funcionario = f.codigo WHERE deletado_em IS NULL AND codigo=?");
		$prepared->bind_param("i", $codigo);
		$prepared->execute();
		$prepared->bind_result($nome_completo, $e_mail, $telefone, $observacoes, $ativo, $cod_usuario, $gf, $gp, $gd, $gc, $gn);

		$result = null;
		if($prepared->fetch()){
			$result = array(
				'codigo' => $codigo,
				'nome_completo' => $nome_completo,
				'e_mail' => $e_mail,
				'telefone' => $telefone,
				'observacoes' => $observacoes,
				'ativo' => $ativo ? true:false,
				'usuario' => $cod_usuario,
				'permissoes' => array(
					'gf' => $gf ? true:false,
					'gp' => $gp ? true:false,
					'gd' => $gd ? true:false,
					'gc' => $gc ? true:false,
					'gn' => $gn ? true:false
					)
				);


		}

		$prepared->close();

		if($result != null){
			$uDao = new UsuarioDAO($this->mysqli);
			$result['usuario'] = $uDao->obter_por_codigo($result['usuario']);
		}

		return $result;
	}

	function salvar_funcionario(&$f){
		$uDao = new UsuarioDAO($this->mysqli);
		$uDao->salvar_usuario($f['usuario']);

		$q;

		if($f['codigo'] == 0){
			$q = "INSERT INTO funcionarios SET nome_completo=?, e_mail=?, telefone=?, observacoes=?, ativo=?, cod_usuario=?";
		}else{
			$q = "UPDATE funcionarios SET nome_completo=?, e_mail=?, telefone=?, observacoes=?, ativo=?, cod_usuario=? WHERE codigo=?";
		}

		$prepared = $this->mysqli->prepare($q);

		$codigo = $f['codigo'];
		$nome_completo = $f['nome_completo'];
		$e_mail = $f['e_mail'];
		$telefone = $f['telefone'];
		$observacoes = $f['observacoes'];
		$ativo = $f['ativo'] ? 1:0;
		$cod_usuario = $f['usuario']['codigo'];

		if($codigo == 0){
			$prepared->bind_param("ssssii", $nome_completo, $e_mail, $telefone, $observacoes, $ativo, $cod_usuario);
		}else{
			$prepared->bind_param("ssssiii", $f['nome_completo'], $f['e_mail'], $f['telefone'], $f['observacoes'], $ativo, $f['usuario']['codigo'], $f['codigo']);
		}

		$prepared->execute();

		if($codigo == 0){
			$f['codigo'] = $prepared->insert_id;
		}

		$prepared->close();

		//Salvando as permissões do usuário
		$q = null;
		if($codigo == 0){
			$q = "INSERT INTO permissoes SET cod_funcionario=?, gerenciar_funcionarios=?, gerenciar_projetos=?, gerenciar_downloads=?, gerenciar_clientes=?, gerenciar_noticias=?";
		}else{
			$q = "UPDATE permissoes SET gerenciar_funcionarios=?, gerenciar_projetos=?, gerenciar_downloads=?, gerenciar_clientes=?, gerenciar_noticias=? WHERE cod_funcionario=?";
		}

		$prepared = $this->mysqli->prepare($q);

		$gf = $f['permissoes']['gf'] ? 1:0;
		$gp = $f['permissoes']['gp'] ? 1:0;
		$gd = $f['permissoes']['gd'] ? 1:0;
		$gc = $f['permissoes']['gc'] ? 1:0;
		$gn = $f['permissoes']['gn'] ? 1:0;

		if($codigo == 0){
			$prepared->bind_param("iiiiii", $f['codigo'], $gf, $gp, $gd, $gc, $gn);
		}else{
			$prepared->bind_param("iiiiii", $gf, $gp, $gd, $gc, $gn, $f['codigo']);
		}

		$prepared->execute();

		$prepared->close();
	}
}
?>