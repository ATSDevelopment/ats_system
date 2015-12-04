<?php
define("ROOT", "../../..");
define("NAV", "side_btn_d");

require ROOT."/libs/lib_list.php";

$cod_projeto = $_GET['cod_projeto'];

$cod_download = 0;
if(array_key_exists("cod_download", $_GET)){
	$cod_download = $_GET['cod_download'];
}

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<link rel="stylesheet" type="text/css" href="css/editar.css">

<div class="sub_body">
	<div class="row">
		<div class="col-lg-6">
			<form class="panel panel-default panel-body" method='post' action="dao.php?f=salvar_download&cod_projeto=<?=$cod_projeto?>">
				<div class="row">
					<div class="col-lg-4">
						<div class="input-group">
							<span class="input-group-addon">Versão</span>
							<input name="versao" type="text" class="form-control" placeholder="Versão">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="row">
							<div class="input-group">
								<span class="input-group-addon">Privado</span>
								<select name="privado" type="text" class="form-control">
									<option value="true">sim</option>
									<option value="false">não</option>
								</select>
							</div>
						</div>
					</div>
					<div id="#controls_padding" class="controls_padding col-lg-4">
						<div class="btn-group">
							<a href="listar.php?cod_projeto=<?=$cod_projeto?>" id="btn_voltar" type="button" class="btn btn-primary">Voltar</a>
							<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-6">
			<form class="panel panel-default" method='post' action="dao.php?f=salvar_download&cod_projeto=<?=$cod_projeto?>">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-10">
							<div class="input-group">
								<span class="input-group-addon">Arquivo</span>
								<input name="project_file" type="file" class="form-control">
							</div>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary">Salvar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
