<?php
class DownloadDAO {
	private $mysqli;
	function __construct($mysqli){
		$this->mysqli = $mysqli;
	}

	function deletar_pergunta($codigo){
		$prepared = $this->mysqli->prepare("DELETE FROM questoes WHERE codigo=$codigo");
		$prepared->execute();
		$prepared->close();
	}

	function salvar_pergunta($cod_download, $pergunta){
		$prepared = $this->mysqli->prepare("INSERT INTO questoes SET cod_download=$cod_download, titulo='$pergunta'");
		$prepared->execute();
		$prepared->close();
	}

	function listar_perguntas($cod_download){
		$prepared = $this->mysqli->prepare("SELECT codigo, titulo, resposta FROM questoes WHERE cod_download=$cod_download");
		$prepared->execute();
		$prepared->bind_result($codigo, $titulo, $resposta);

		$result = array();
		while($prepared->fetch()){
			$result[] = array(
				'codigo' => $codigo,
				'titulo' => $titulo,
				'resposta' => $resposta,
				'cod_download' => $cod_download
				);
		}

		$prepared->close();

		return $result;
	}

	function deletar_download($cod_download){
		$prepared = $this->mysqli->prepare("DELETE FROM downloads WHERE codigo=$cod_download");
		$prepared->execute();
		$prepared->close();
	}

	function salvar_download($down){
		$cod_projeto = $down['cod_projeto'];
		$versao = $down['versao'];
		$diretorio = $down['diretorio'];
		$privado = $down['privado'] ? 1:0;

		$prepared = $this->mysqli->prepare("INSERT INTO downloads SET cod_projeto=?, versao=?, diretorio=?, participantes=?");
		$prepared->bind_param("issi", $cod_projeto, $versao, $diretorio, $privado);
		$prepared->execute();

		$prepared->close();
	}

	function listar_downloads($cod_projeto){
		$prepared = $this->mysqli->prepare("SELECT * FROM downloads WHERE cod_projeto=$cod_projeto");
		$prepared->execute();
		$prepared->bind_result($codigo, $cod_projeto, $versao, $diretorio, $privado);

		$results = array();
		while($prepared->fetch()){
			$results[] = array(
				'codigo' => $codigo,
				'projeto' => $cod_projeto,
				'versao' => $versao,
				'diretorio' => $diretorio,
				'privado' => $privado
				);
		}

		$prepared->close();

		$pDao = new ProjetoDAO($this->mysqli);
		foreach ($results as &$down) {
			$down['projeto'] = $pDao->obter_projeto_por_codigo($down['projeto']);
		}

		return $results;
	}
}
?>