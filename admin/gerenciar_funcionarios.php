<?php
require "dao/funcionario_dao.class.php";

$gf_funcionario_dao = new funcionario_dao();

$gf_funcionarios = $gf_funcionario_dao->listar_nomes();
?>

<link rel="stylesheet" type="text/css" href="css/ger-funcionarios.css">
<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		selector: "textarea"
	});
</script>

<div id="gf_div" class="row">
	<div class="col-lg-3">
		<div id="gf_seach_funcionario" class="panel panel-default">
			<div class="panel-body">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Buscar...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">IR!</button>
					</span>
				</div>
			</div>
		</div>

		<div id="gf_list_funcionarios" class="panel panel-default">
			<table class="table">
				<tr>
					<th>Funcionarios</th>
				</tr>
				<?php
				foreach ($gf_funcionarios as $gf_funcionario) {
					$gf_list_cod = $gf_funcionario['codigo'];
					$gf_list_nome = $gf_funcionario['nome_completo'];
					?>
					<tr>
						<td>
							<a href="index.php?page=gerenciar_funcionarios&cod_funcionario=<?=$gf_list_cod?>">
								<?=$gf_list_nome?>
							</a>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<div id="gf_editor_funcionario" class="col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">

				<form method="post" action="#">

					<div class="row">
						<div class="col-lg-7">
							<fieldset>
								<legend>
									<small>Dados Pessoais</small>
								</legend>
								<div class="row input-row">
									<div class="col-lg-2"><label>Nome:</label></div>
									<div class="col-lg-10"><input type="text" class="form-control"></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-2"><label>E-Mail:</label></div>
									<div class="col-lg-10"><input type="text" class="form-control"></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-2"><label>Telefone:</label></div>
									<div class="col-lg-10"><input type="text" class="form-control"></div>
								</div>
							</fieldset>
						</div>

						<div class="col-lg-5">
							<fieldset>
								<legend>
									<small>Dados de Acesso</small>
								</legend>
								<div class="row input-row">
									<div class="col-lg-2"><label>Usuário:</label></div>
									<div class="col-lg-10"><input type="text" class="form-control"></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-2"><label>Senha:</label></div>
									<div class="col-lg-10"><input type="password" class="form-control"></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
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
								<textarea></textarea>
							</fieldset>
						</div>
						<div class="col-lg-5">
							<fieldset>
								<legend>
									<small>Permissões</small>
								</legend>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Funcionarios</label></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Projetos</label></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Downloads</label></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Clientes</label></div>
								</div>
								<div class="row input-row">
									<div class="col-lg-1"><input type="checkbox" ></div>
									<div class="col-lg-11"><label>Gerenciar Notícias</label></div>
								</div>
							</fieldset>
						</div>
					</div>
					<div id="controls" class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-primary">Cancelar</button>
						<button type="button" class="btn btn-primary">Deletar</button>
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>