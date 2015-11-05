
<link rel="stylesheet" type="text/css" href="css/clientes_cadastrar.css">
<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
	selector: "textarea"
});
</script>


<?php 
$f = null;
require "dao/cliente_dao.class.php";

$fdao = new cliente_dao();

$f = $fdao->obter_por_codigo($_SESSION["cod_cli"]);

$cod_cli = $_SESSION['cod_cli'];
?>

<div id="f_editor2" class="panel panel-default">
	<div class="panel-body">
		<form name="f_editor2" method='post' action="dao/cliente_dao.php?op=salvar_cliente&cod_cliente=<?=$cod_cli?>" >
			<div class="row">

				<div class="col-lg-5">
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
							<div class="col-lg-9"><input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control" onKeyUp="verifica();"></div>
						</div>
					</fieldset>
				</div>

				<div class="col-lg-7">
					<fieldset>
						<legend>
							<small>Dados de Acesso</small>
						</legend>
						<div class="row input_row">
							<div class="col-lg-4"><label>Usuário:</label></div>
							<div class="col-lg-8"><input disabled id="usuario" name="usuario" type="text" class="form-control" onKeyUp="verifica();"></div>
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
					<div id="btn_salvar" class="btn-group" role="group" aria-label="...">
						<button  type="submit" class="btn btn-primary" onClick="window.location.reload();">Salvar</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Alterar Foto</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form method='post' enctype='multipart/form-data' action="dao/cliente_dao.php?op=salvar_foto">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Alterar Foto</h4>
				</div>
				<div class="modal-body">
					<input accept="image/jpeg" type='file' name='foto' value='Enviar Foto'>
				</div>
				<div class="modal-footer">
					<input type="submit" name='submit' onClick="window.location.reload();" class="btn btn-default"  value="Salvar"/>
				</div>
			</form>

			<?php	
			/*include "dao/upload.class.php"; 

			if ((isset($_POST["submit"])) && (! empty($_FILES['foto']))){
				
				$upload = new Upload($_FILES['foto'], 1000, 800, "img/perfil/");
				$upload->salvar(); 
			} */
			?>


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

	var btn = "<button  type='submit' class='btn btn-primary' onClick='window.location.reload()'>Salvar</button><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Alterar Foto</button>";
	var btnds = "<button  type='submit' class='btn btn-primary' onClick='window.location.reload()' disabled>Salvar</button><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Alterar Foto</button>";


	if ((nome!="")&&(cpf_cnpj!="")&&(usuario!="")&&(senha!="")) {

		if (senha == r_senha) {
			document.getElementById("r_label").innerHTML = "Repetir Senha: <span class='glyphicon glyphicon-ok' aria-hidden='true' style='color: green;'></span>";
			document.getElementById("btn_salvar").innerHTML = btn;
		}else{
			document.getElementById("r_label").innerHTML = "Repetir Senha: <span class='glyphicon glyphicon-remove' aria-hidden='true'style='color: red;' ></span>";
			document.getElementById("btn_salvar").innerHTML = btnds;
		}
	}else{
		document.getElementById("btn_salvar").innerHTML = btnds;
	};
}


</script>

<?php
if($f != null){
	?>

	<script type="text/javascript" language="javascript">

	document.f_editor2.nome_cliente.value = "<?=$f['nome_completo']?>";
	document.f_editor2.cpf_cnpj.value = "<?=$f['cpf_cnpj']?>";
	document.f_editor2.usuario.value = "<?=$f['nome_de_usuario']?>";
	document.f_editor2.senha.value = "<?=$f['senha']?>"
	document.f_editor2.r_senha.value = "<?=$f['senha']?>";

	</script>

	<?php
}
?>

