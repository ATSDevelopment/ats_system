<?php
define("ROOT", "../../../..");
define("NAV", "side_btn_p");

require ROOT."/libs/lib_list.php";
require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";

$cod_projeto = $_GET['cod_projeto'];

$con = get_connection();

$funcDao = new FuncionarioDAO($con);
$funcionario = $funcDao->obter_por_codigo(LOGGED_USER);

$msDao = new MensagemDAO($con);
$msgs = $msDao->listar_mensagens($cod_projeto);
?>

<link rel="stylesheet" type="text/css" href="css/chat.css">

<div id="chat_panel" class="sub_body">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php
					foreach ($msgs as $msg) {
						$class = ($msg['usuario']['codigo'] == $funcionario['usuario']['codigo'] ? "alert-success":"alert-info");
						?>
						<div class="alert <?=$class?>">
							<strong><?=$msg['usuario']['nome_de_usuario'].", ".$msg['data'].": "?></strong>
							<br />
							<?=$msg['conteudo']?>
						</div>
						<?php
					}
					?>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<form class="input-group" method="post" action='<?="dao.php?cod_projeto=$cod_projeto&cod_usuario=".LOGGED_USER?>'>
						<textarea id="area_conteudo" name="conteudo"></textarea>
						<span id="controls" class="btn-group">
							<a class="btn btn-default" type="submit">Enviar</a>
							<button class="btn btn-default" type="submit">Enviar</button>
						</span>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src=<?=ROOT.'/vendor/tinymce/js/tinymce/tinymce.min.js'?>></script>
<script src=<?=ROOT.'/site/js/tinymce_init.js'?>></script>

<?php
require ROOT."/site/footer.php";
?>