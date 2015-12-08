<?php 

$cod_projeto =$p['cod_projeto'];
$id_usuario = $_SESSION['id_usuario'];
$cliente = $fdao->obter_por_codigo($id_usuario);


$msgdao = new MensagemDAO();
$msgs = $msgdao->listar_mensagens($cod_projeto);
?>

<link rel="stylesheet" type="text/css" href="css/chat.css">

<div id="chat_panel" class="sub_body">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php
					foreach ($msgs as $msg) {
						$class = ($msg['usuario']['codigo'] == $cliente['codigo'] ? "alert-success":"alert-info");
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
				<form class="input-group" method="post" action='<?="dao/cliente_dao.php?op=salvar_msg&cod_projeto=$cod_projeto&cod_usuario=".$id_usuario?>'>
					<textarea name="conteudo" ></textarea>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Enviar</button>
					</span>
				</form>
			</div>
		</div>
	</div>
</div>





<?php /*

<div class="container">
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-primary">
				<div class="panel-collapse collapse" id="collapseChat<?=$cod?>">
					<div class="panel-body">
						<ul class="chat">
							<li class="left clearfix">
								<span class="chat-img pull-left">
									<img src="http://placehold.it/50/55C1E7/fff&text=DEV" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">Jack Sparrow</strong> 
									</div>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
										dolor, quis ullamcorper ligula sodales.
									</p>
								</div>
							</li>
							<li class="right clearfix">
								<span class="chat-img pull-right">
									<img src="http://placehold.it/50/FA6F57/fff&text=VOCÊ" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="pull-right primary-font">Bhaumik Patel</strong>
									</div>
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
										dolor, quis ullamcorper ligula sodales.
									</p>
								</div>
							</li>
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<input id="btn-input" type="text" class="form-control input-sm" placeholder="Escreva sua mensagem aqui..." />
							<span class="input-group-btn">
								<button class="btn btn-warning btn-sm" id="btn-chat">Enviar</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
*/
 ?>
