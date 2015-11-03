<?php
require "header.php";
?>

<link rel="stylesheet" type="text/css" href="css/clientes_cadastrar.css">
<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector: "textarea"
});
</script>

<div class="container">
	<div id="f_editor" class="panel panel-default">
		<div class="panel-body">

			<form name="f_editor" method="post" action="dao/cliente_dao.php?op=salvar_cliente&cod_cliente=0">

				<div class="row">

					<div class="col-lg-6">
						<fieldset>
							<legend>
								<small>Dados Pessoais</small>
							</legend>
							<div class="row input_row">
								<div class="col-lg-3"><label>Nome:</label></div>
								<div class="col-lg-9"><input id="nome_cliente" name="nome_cliente" type="text" class="form-control" onKeyUp="verifica();"></div>		
							</div>
							<div class="row input_row">
								<div class="col-lg-3"><label>CPF/CNPJ:</label></div>
								<div class="col-lg-9"><input id="cpf_cnpj" name="cpf_cnpj" type="number" class="form-control" onKeyUp="verifica();"></div>
							</div>
						</fieldset>
					</div>

					<div class="col-lg-6">
						<fieldset>
							<legend>
								<small>Dados de Acesso</small>
							</legend>
							<div class="row input_row">
								<div class="col-lg-4"><label>Usuário:</label></div>
								<div class="col-lg-8"><input id="usuario" name="usuario" type="text" class="form-control" onKeyUp="verifica();"></div>
							</div>
							<div class="row input_row">
								<div class="col-lg-4"><label>Senha:</label></div>
								<div class="col-lg-8"><input id="senha" name="senha" type="password" class="form-control" onKeyUp="verifica();"></div>
							</div>
							<div class="row input_row">
								<div class="col-lg-4"><label id="r_label">Repetir Senha:  </span></label></div>
								<div class="col-lg-8"><input id="r_senha" name="r_senha" type="password" class="form-control" onKeyUp="verifica();" ></div>
							</div>

						</fieldset>
					</div>
					<div id="controls">
						<div class="btn-group" role="group" aria-label="..." id="btn_salvar">
							<button type="submit" class="btn btn-primary" disabled>Salvar</button>
						</div>
					</div>
					<?php
					if(array_key_exists("exist", $_GET)){
						$exist = $_GET['exist'];
						if ($exist == "true") {
							echo "<br><label style='color: red;'>Usuário Existente!</label>";
						}
					}
					?>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

function verifica(){
	
	var nome = document.getElementById("nome_cliente").value;
	var cpf_cnpj = document.getElementById("cpf_cnpj").value;
	var usuario = document.getElementById("usuario").value;
	var senha = document.getElementById("senha").value;
	var r_senha = document.getElementById("r_senha").value;

	if ((nome!="")&&(cpf_cnpj!="")&&(usuario!="")&&(senha!="")) {


		if (senha == r_senha) {
			document.getElementById("r_label").innerHTML = "Repetir Senha: <span class='glyphicon glyphicon-ok' aria-hidden='true' style='color: green;'></span>";
			document.getElementById("btn_salvar").innerHTML = "<button type='submit' class='btn btn-primary'>Salvar</button>";
		}else{
			document.getElementById("r_label").innerHTML = "Repetir Senha: <span class='glyphicon glyphicon-remove' aria-hidden='true'style='color: red;' ></span>";
			document.getElementById("btn_salvar").innerHTML = "<button type='submit' class='btn btn-primary' disabled>Salvar</button>";
		};
	}else{
		document.getElementById("btn_salvar").innerHTML = "<button type='submit' class='btn btn-primary' disabled>Salvar</button>";
	};
}

</script>

<?php


require "footer.php";

?>