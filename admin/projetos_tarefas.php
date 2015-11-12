<?php
$cod_projeto = $_GET['cod_projeto'];
require "dao/projeto_dao.class.php";

$pdao = new projeto_dao();
$p = $pdao->obter_por_codigo($cod_projeto);

$nav = "side_btn_p";
require "header.php";
require "sidebar.php";
?>

<script src="vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/projetos_tarefas.js"></script>

<div class="sub_body">
	<fieldset>
		<legend><?=$p['nome']?> :: Tarefas</legend>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
			Adicionar Tarefa
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Adicionar Tarefa</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="row">
								<div class="col-lg-2">
									<label>Título</label>
								</div>
								<div class="col-lg-10">
									<input type="text" class="form-control">
								</div>
							</div>

							<br />

							<div class="row">
								<div class="col-lg-2">
									<label>Funcionário</label>
								</div>
								<div class="col-lg-10">
									<input type="text" class="form-control">
								</div>
							</div>

							<br />

							<label>Descrição</label>
							<br />
							<textarea></textarea>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</fieldset>
</div>