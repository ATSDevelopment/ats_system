<?php
define("ROOT", "../..");
define("NAV", "side_btn_f");

require ROOT."/libs/lib_list.php";

$func = null;
if(array_key_exists('cod_funcionario', $_GET)){
	$fDao = new FuncionarioDAO(get_connection());

	$func = $fDao->obter_por_codigo($_GET['cod_funcionario']);
}

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<link rel="stylesheet" type="text/css" href="css/editar.css">

<script src=<?=ROOT.'/vendor/tinymce/js/tinymce/tinymce.min.js'?>></script>
<script src=<?=ROOT.'/site/js/tinymce_init.js'?>></script>

<div class="sub_body">
	<fieldset>
		<legend>Cadastro de Funcionário</legend>

		<div id="alert_info" class="alert" role="alert" style="display: none"></div>

		<div id="f_editor" class="panel panel-default">
			<div class="panel-body">

				<form name="form_editor">

					<div class="row">
						<div class="col-lg-7">
							<fieldset>
								<legend>
									<small>Dados Do Funcionário</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-2"><label>Nome:</label></div>
									<div class="col-lg-10"><input id="tf_nome_completo" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>E-Mail:</label></div>
									<div class="col-lg-10"><input id="tf_e_mail" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Telefone:</label></div>
									<div class="col-lg-10 row">
										<div class="col-lg-6">
											<input id="tf_telefone" type="text" class="form-control">
										</div>
										<div class="col-lg-6">
											<div class="row input_row">
												<div class="col-lg-2"><input id="cbx_ativo" type="checkbox"></div>
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
									<div class="col-lg-10"><input id="tf_nome_de_usuario" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Senha:</label></div>
									<div class="col-lg-10"><input id="tf_senha" type="password" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input id="cbx_bloqueado" type="checkbox"></div>
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
								<textarea id="tf_observacoes" name="tf_observacoes"></textarea>
							</fieldset>
						</div>
						<div class="col-lg-5">
							<fieldset>
								<legend>
									<small>Permissões</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-1"><input id="gf" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Funcionarios</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input id="gp" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Projetos</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input id="gd" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Downloads</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input id="gc" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Clientes</label></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-1"><input id="gn" type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Notícias</label></div>
								</div>
							</fieldset>
							<div id="controls">
								<div class="btn-group">
									<a href="listar.php" type="button" class="btn btn-primary">Voltar</a>
									<button id="btn_deletar" type="button" class="btn btn-primary">Deletar</button>
									<button id="btn_salvar" type="button" class="btn btn-primary">Salvar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</fieldset>
</div>

<script type="text/javascript" src="js/editar.js"></script>

<?php
if($func != null){	
	?>
	<script type="text/javascript">
		json = '<?=json_encode($func)?>';

		func_edit = JSON.parse(json);

		update_form();
	</script>
	<?php
}
?>