<?php
$nav = "side_btn_f";

require "header.php";
require "sidebar.php";

$f = null;
if (array_key_exists("cod_funcionario", $_GET)) {
	require "dao/funcionario_dao.class.php";

	$fdao = new funcionario_dao();

	$f = $fdao->obter_por_codigo($_GET['cod_funcionario']);

	if($f == null){
		?>
		<script type="text/javascript">
			alert("Não é possível editar este funcionário\nContate o administrador do sistema!");
			location.href="funcionarios_listar.php";
		</script>
		<?
	}
}
?>

<link rel="stylesheet" type="text/css" href="css/funcionarios_editar.css">

<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/funcionarios_editar.js"></script>

<div class="sub_body">
	<fieldset>
		<legend>Cadastro de Funcionário</legend>
		<div id="f_editor" class="panel panel-default">
			<div class="panel-body">

				<form name="f_editor" method="post" action="dao/funcionario_dao.php?op=salvar_funcionario&cod_funcionario=<?=$f != null ? $f['codigo']:0?>">

					<div class="row">
						<div class="col-lg-7">
							<fieldset>
								<legend>
									<small>Dados Do Funcionário</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-2"><label>Nome:</label></div>
									<div class="col-lg-10"><input name="nome_completo" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>E-Mail:</label></div>
									<div class="col-lg-10"><input name="e_mail" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Telefone:</label></div>
									<div class="col-lg-10 row">
										<div class="col-lg-6">
											<input name="telefone" type="text" class="form-control">
										</div>
										<div class="col-lg-6">
											<div class="row input_row">
												<div class="col-lg-2"><input name="ativo" type="checkbox" ></div>
												<div class="col-lg-10"><label>Ativo</label></div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="col-lg-5">
							<fieldset>
								<legend>
									<small>Dados de Acesso</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-2"><label>Usuário:</label></div>
									<div class="col-lg-10"><input name="usuario" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Senha:</label></div>
									<div class="col-lg-10"><input name="senha" type="password" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input name="bloqueado" type="checkbox" ></div>
									<div class="col-lg-11"><label>Bloqueado</label></div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-7">					
							<fieldset>
								<legend>
									<small>Observações</small>
								</legend>
								<textarea name="observacoes"></textarea>
							</fieldset>
						</div>
						<div class="col-lg-5">
							<fieldset>
								<legend>
									<small>Permissões</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-1"><input name="ger_func" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Funcionarios</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input name="ger_proj" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Projetos</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input name="ger_down" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Downloads</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input name="ger_cli" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Clientes</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input name="ger_not" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Notícias</label></div>
								</div>
							</fieldset>
							<div id="controls">
								<div class="btn-group">
									<a href="funcionarios_listar.php" type="button" class="btn btn-primary">Voltar</a>
									<a id="btn_deletar" href="dao/funcionario_dao.php?op=deletar_funcionario&cod_funcionario=<?=$f['codigo']?>" onclick="return confirm('Deletar realmente deletar o funcionário?')" class="btn btn-primary">Deletar</a>
									<button type="submit" class="btn btn-primary">Salvar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</fieldset>
<?php

if($f != null){
	?>

	<script type="text/javascript" language="javascript">
		preencher({
			nome_completo: "<?=$f['nome_completo']?>",
			e_mail: "<?=$f['e_mail']?>",
			telefone: "<?=$f['telefone']?>",
			ativo: "<?=$f['ativo'] == 1 ? true : false?>",
			observacoes: "<?=$f['observacoes'] == null ? '':$f['observacoes']?>",
			usuario: "<?=$f['nome_de_usuario']?>",
			senha: "<?=$f['senha']?>",
			bloqueado: "<?=$f['bloqueado'] == 1 ? true : false?>",
			permissoes: {
				gf: "<?=$f['permissoes']['gf'] == 1 ? true : false?>",
				gp: "<?=$f['permissoes']['gp'] == 1 ? true : false?>",
				gd: "<?=$f['permissoes']['gd'] == 1 ? true : false?>",
				gc: "<?=$f['permissoes']['gc'] == 1 ? true : false?>",
				gn: "<?=$f['permissoes']['gn'] == 1 ? true : false?>"
			}
		});
	</script>

	<?php
}else{
	?>

	<script type="text/javascript" language="javascript">
		$("#btn_deletar").toggleClass("disabled");
	</script>

	<?php
}
require "footer.php";
?>