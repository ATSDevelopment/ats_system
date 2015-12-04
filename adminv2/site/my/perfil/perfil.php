<?php
define("ROOT", "../../..");
define("NAV", "side_btn_pf");

require ROOT."/libs/lib_list.php";
require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";

$fDao = new FuncionarioDAO(get_connection());
$func = $fDao->obter_por_codigo(LOGGED_USER);

?>

<link rel="stylesheet" type="text/css" href="css/perfil.css">

<div class="sub_body">
	<fieldset>
		<legend>Cadastro de Funcionário</legend>

		<div id="alert_info" class="alert" role="alert" style="display: none"></div>

		<div id="f_editor" class="panel panel-default">
			<div class="panel-body">

				<form name="form_editor" method="post" action="dao.php?f=salvar_perfil&cod_funcionario=<?=$func['codigo']?>">

					<div class="row">
						<div class="col-lg-7">
							<fieldset>
								<legend>
									<small>Dados Do Funcionário</small>
								</legend>
								<div class="row input_row">
									<div class="col-lg-2"><label>Nome:</label></div>
									<div class="col-lg-10"><input name="nome_completo" value="<?=$func['nome_completo']?>" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>E-Mail:</label></div>
									<div class="col-lg-10"><input name="e_mail" value="<?=$func['e_mail']?>" type="text" class="form-control"></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Telefone:</label></div>
									<div class="col-lg-10">
										<input name="telefone" value="<?=$func['telefone']?>" type="text" class="form-control">
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
									<div class="col-lg-10"><input value="<?=$func['usuario']['nome_de_usuario']?>" type="text" class="form-control" disabled></div>
								</div>
								<div class="row input_row">
									<div class="col-lg-2"><label>Senha:</label></div>
									<div class="col-lg-10"><input name="senha" value="<?=$func['usuario']['senha']?>" type="password" class="form-control"></div>
								</div>
							</fieldset>
						</div>
					</div>

					<div id="controls">
						<div class="btn-group">
							<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</fieldset>
</div>