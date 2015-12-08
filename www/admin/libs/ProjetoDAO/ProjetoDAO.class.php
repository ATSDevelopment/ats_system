<?php
class ProjetoDAO{
	private $mysqli;
	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}

	function listar_projetos_por_funcionaro($cod_funcionario){
		$q = "SELECT p.codigo, p.nome, p.descricao, p.concluido, p.cod_cliente FROM projetos p JOIN projetos_funcionarios pf ON pf.cod_projeto=p.codigo JOIN funcionarios f ON f.codigo=pf.cod_funcionario WHERE p.deletado_em IS NULL AND f.codigo=$cod_funcionario";

		$prepared = $this->mysqli->prepare($q);
		$prepared->execute();
		$prepared->bind_result($codigo, $nome, $descricao, $concluido, $cod_cliente);

		$result = array();
		while($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'nome' => $nome,
				'descricao' => $descricao,
				'concluido' => $concluido == 1 ? true:false,
				'cliente' => $cod_cliente
				);
		}

		$prepared->close();

		$cDao = new ClienteDAO($this->mysqli);

		foreach ($result as &$proj) {	
			$c = $cDao->obter_por_codigo($proj['cliente']);

			$proj['cliente'] = $c;			
		}

		return $result;
	}

	function listar_tarefas($cod_projeto){
		$prepared = $this->mysqli->prepare("SELECT codigo, nome, descricao, concluida, cod_funcionario FROM tarefas WHERE deletado_em IS NULL AND cod_projeto=$cod_projeto");
		$prepared->execute();
		$prepared->bind_result($codigo, $nome, $descricao, $concluida, $cod_funcionario);

		$result = array();
		if($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'projeto' => $cod_projeto,
				'nome' => $nome,
				'descricao' => $descricao,
				'concluida' => $concluida == 1,
				'funcionario' => $cod_funcionario
				);
		}

		$prepared->close();

		$fDao = new FuncionarioDAO($this->mysqli);

		foreach ($result as &$t) {
			$t['projeto'] = $this->obter_projeto_por_codigo($t['projeto']);
			$t['funcionario'] = $fDao->obter_por_codigo($t['funcionario']);	
		}

		return $result;
	}

	function deletar_tarefa($codigo){
		$prepared = $this->mysqli->prepare("UPDATE tarefas SET deletado_em=NOW() WHERE codigo=$codigo");
		$prepared->execute();
		$prepared->close();
	}

	function obter_tarefa_por_codigo($codigo){
		$q = "SELECT cod_projeto, nome, descricao, concluida, cod_funcionario FROM tarefas WHERE deletado_em IS NULL AND codigo=$codigo";
		$prepared = $this->mysqli->prepare($q);
		$prepared->execute();
		$prepared->bind_result($cod_projeto, $nome, $descricao, $concluida, $cod_funcionario);

		$t = null;
		if($prepared->fetch()){
			$t = array(
				'codigo' => $codigo,
				'projeto' => $cod_projeto,
				'nome' => $nome,
				'descricao' => $descricao,
				'concluida' => $concluida == 1,
				'funcionario' => $cod_funcionario
				);
		}

		$prepared->close();

		if($t != null){
			$fDao = new FuncionarioDAO($this->mysqli);		
			$t['projeto'] = $this->obter_projeto_por_codigo($t['projeto']);
			$t['funcionario'] = $fDao->obter_por_codigo($t['funcionario']);
		}


		return $t;
	}

	function salvar_tarefa(&$t){
		$q;
		if($t['codigo'] == 0){
			$q = "INSERT INTO tarefas SET cod_projeto=?, nome=?, descricao=?, concluida=?, cod_funcionario=?";
		}else{
			$q = "UPDATE tarefas SET cod_projeto=?, nome=?, descricao=?, concluida=?, cod_funcionario=? WHERE codigo=?";
		}

		$prepared = $this->mysqli->prepare($q);

		$codigo = $t['codigo'];
		$cod_projeto = $t['cod_projeto'];
		$nome = $t['nome'];
		$descricao = str_replace("\n", "", str_replace("\t", "", $t['descricao']));
		$concluida = $t['concluida'] ? 1:0;
		$cod_funcionario = $t['cod_funcionario'];

		if($t['codigo'] == 0){
			$prepared->bind_param("issii", $cod_projeto, $nome, $descricao, $concluida, $cod_funcionario);
		}else{
			$prepared->bind_param("issiii", $cod_projeto, $nome, $descricao, $concluida, $cod_funcionario, $codigo);
		}

		$prepared->execute();

		if($t['codigo'] == 0){
			$t['codigo'] = $prepared->insert_id;
		}

		$prepared->close();
	}

	function deletar_participante($cod_projeto, $cod_funcionario){		
		$prepared = $this->mysqli->prepare("DELETE FROM projetos_funcionarios WHERE cod_projeto=$cod_projeto AND cod_funcionario=$cod_funcionario");
		$prepared->execute();
		$prepared->close();
	}

	function listar_participantes($cod_projeto){
		$prepared = $this->mysqli->prepare("SELECT f.codigo, f.nome_completo, u.nome_de_usuario, f.e_mail, f.telefone, f.ativo FROM funcionarios f JOIN usuarios u ON u.codigo=f.cod_usuario JOIN projetos_funcionarios pf ON pf.cod_funcionario=f.codigo WHERE pf.cod_projeto=?");
		$prepared->bind_param("i", $cod_projeto);
		$prepared->execute();
		$prepared->bind_result($codigo, $nome_completo, $nome_de_usuario, $e_mail,$telefone, $ativo);

		$result = array();
		while($prepared->fetch()) {
			$result[] = array(
				'codigo' => $codigo,
				'nome_completo' => $nome_completo,
				'nome_de_usuario' => $nome_de_usuario,
				'e_mail' => $e_mail,
				'telefone' => $telefone,
				'ativo' => $ativo
				);
		}

		$prepared->close();

		return $result;
	}

	function adicionar_participante($cod_projeto, $cod_funcionario){
		$prepared = $this->mysqli->prepare("INSERT INTO projetos_funcionarios SET cod_projeto=?, cod_funcionario=?, gerente=FALSE");
		$prepared->bind_param("ii", $cod_projeto, $cod_funcionario);

		$prepared->execute();
		$prepared->close();
	}

	function listar_projetos($search){
		$q = "SELECT p.codigo, p.nome, p.descricao, p.concluido, p.cod_cliente FROM projetos p JOIN clientes c ON c.codigo=p.cod_cliente WHERE p.deletado_em IS NULL";
		if($search != null){
			$q = $q." AND (p.nome LIKE '%$search%' OR p.descricao LIKE '%$search%' OR c.nome_completo LIKE '%$search%' )";
		}

		$prepared = $this->mysqli->prepare($q);
		$prepared->execute();
		$prepared->bind_result($codigo, $nome, $descricao, $concluido, $cod_cliente);

		$result = array();
		while($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'nome' => $nome,
				'descricao' => $descricao,
				'concluido' => $concluido == 1 ? true:false,
				'cliente' => $cod_cliente
				);
		}

		$prepared->close();

		$cDao = new ClienteDAO($this->mysqli);

		foreach ($result as &$proj) {	
			$c = $cDao->obter_por_codigo($proj['cliente']);

			$proj['cliente'] = $c;			
		}

		return $result;
	}

	function obter_projeto_por_codigo($codigo){
		$prepared = $this->mysqli->prepare("SELECT nome, descricao, concluido, cod_cliente FROM projetos WHERE codigo=?");
		$prepared->bind_param("i", $codigo);
		$prepared->execute();
		$prepared->bind_result($nome, $descricao, $concluido, $cod_cliente);

		$result = null;
		if($prepared->fetch()){
			$result = array(
				'codigo' => $codigo,
				'nome' => $nome,
				'descricao' => $descricao,
				'concluido' => $concluido == 1 ? true:false,
				'cod_cliente' => $cod_cliente
				);
		}

		$prepared->close();

		$cDao = new ClienteDAO($this->mysqli);

		$result['cliente'] = $cDao->obter_por_codigo($result['cod_cliente']);

		return $result;
	}

	function salvar_projeto(&$p){
		$q;

		if($p['codigo'] == 0){
			$q = "INSERT INTO projetos SET nome=?, descricao=?, concluido=?, cod_cliente=?";
		}else{
			$q = "UPDATE projetos SET nome=?, descricao=?, concluido=?, cod_cliente=? WHERE codigo=?";
		}

		$prepared = $this->mysqli->prepare($q);

		$codigo = $p['codigo'];
		$nome = $p['nome_completo'];
		$descricao = str_replace("\n", "", str_replace("\t", "", $p['descricao']));
		$concluido = $p['concluido']=="true" ? 1:0;
		$cod_cliente = $p['cod_cliente'];

		if($p['codigo'] == 0){
			$prepared->bind_param("ssii", $nome, $descricao, $concluido, $cod_cliente);
		}else{
			$prepared->bind_param("ssiii", $nome, $descricao, $concluido, $cod_cliente, $codigo);
		}

		$prepared->execute();

		if($p['codigo'] == 0){
			$p['codigo'] = $prepared->insert_id;
		}

		$prepared->close();
	}
}
?>