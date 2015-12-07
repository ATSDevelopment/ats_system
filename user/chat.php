<?php 

$cod_projeto =$p['cod_projeto'];
$id_usuario = $_SESSION['id_usuario'];
$cliente = $fdao->obter_por_codigo($id_usuario);

require "dao/msgDAO.php";


$msgdao = new MensagemDAO();
$msgs = $msgdao->listar_mensagens($cod_projeto);
?>

<link rel="stylesheet" type="text/css" href="css/chat.css">
<div class="container">
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-primary">
				<div class="panel-collapse collapse" id="collapseChat<?=$cod?>">
					<div class="panel-body">
						<ul class="chat">
							<?php
							foreach ($msgs as $msg) {
								$class = ($msg['usuario']['codigo'] == $cliente['codigo'] ? "right":"left");
								?>
								<li class="<?=$class?> clearfix">
									<div class="chat-body clearfix">
										<div class="header">
											<strong class="primary-font"><?=$msg['usuario']['nome_de_usuario'].", ".$msg['data'].": "?></strong> 
										</div>
										<p>
											<?=$msg['conteudo']?>
										</p>
									</div>
								</li>

								<?php
							}
							?>
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<form class="input-group" method="post" action='<?="dao/cliente_dao.php?op=salvar_msg&cod_projeto=$cod_projeto&cod_usuario=".$id_usuario?>'>
								<input id="btn-input" type="text" name="conteudo" class="form-control input-sm" placeholder="Escreva sua mensagem aqui..." />
								<span class="input-group-btn">
									<button class="btn btn-warning btn-sm" id="btn-chat">Enviar</button>
								</span>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

