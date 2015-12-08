<?php
class ClienteDAO {
	private $mysqli;

	function __construct($mysqli){
		$this->mysqli = $mysqli;
	}

	function deletar_cliente($codigo){
		$prepared = $this->mysqli->prepare("UPDATE clientes SET deletado_em=NOW() WHERE codigo=$codigo");
		$prepared->execute();
		$prepared->close();
	}

	function obter_por_codigo($codigo){
		$prepared = $this->mysqli->prepare("SELECT nome_completo, cpf_cnpj, cod_usuario FROM clientes WHERE codigo=$codigo");
		$prepared->execute();
		$prepared->bind_result($nome_completo, $cpf_cnpj, $cod_usuario);

		$result = null;
		if($prepared->fetch()){
			$result = array(
				'codigo' => $codigo,
				'nome_completo' => $nome_completo,
				'cpf_pnpj' => $cpf_cnpj,
				'usuario' => $cod_usuario
				);
		}

		$prepared->close();

		$uDao = new UsuarioDAO($this->mysqli);
		if ($result != null) {
			$result['usuario'] = $uDao->obter_por_codigo($result['usuario']);
		}

		return $result;
	}

	function listar_clientes($search){
		$prepared = $this->mysqli->prepare("SELECT codigo, nome_completo, cpf_cnpj, cod_usuario FROM clientes");
		$prepared->execute();
		$prepared->bind_result($codigo, $nome_completo, $cpf_cnpj, $cod_usuario);

		$result = array();
		while($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'nome_completo' => $nome_completo,
				'cpf_cnpj' => $cpf_cnpj,
				'usuario' => $cod_usuario
				);
		}

		$prepared->close();

		$uDao = new UsuarioDAO($this->mysqli);
		foreach ($result as &$c) {
			$c['usuario'] = $uDao->obter_por_codigo($c['usuario']);
		}

		return $result;
	}
}
?>