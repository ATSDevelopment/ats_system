<?php
define("ROOT", "../..");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>	
	<link rel="stylesheet" type="text/css" href="<?=ROOT.'/vendor/bootstrap/css/bootstrap.min.css'?>">
	
	<script type="text/javascript" src="<?=ROOT.'/vendor/jquery/js/jquery-2.1.4.min.js'?>"></script>
	<script type="text/javascript" src="<?=ROOT.'/vendor/bootstrap/js/bootstrap.min.js'?>"></script>

	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">Acesso Administrativo - ATS Development</div>
		<form class="panel-body" method="post" action="login_ctr.php?f=login">
			<table width="100%" cellspacing="10">
				<tr>
					<td>
						<label>Nome de Usuário: </label>
					</td>
					<td>
						<input name="nome_de_usuario" type="text" class="form-control" required>
					</td>
				</tr>
				<tr>
					<td>
						<label>Senha: </label>
					</td>
					<td>
						<input name="senha" type="password" class="form-control" required>
					</td>
				</tr>
				<tr>
					<td></td>

					<td>
						<button type="submit" class="btn btn-default">Login</button>
					</td>
				</tr>
			</div>
		</form>

		<?php
		if(array_key_exists("error", $_GET) && $_GET['error']=='true'){
			?>
			<div class="alert alert-warning"><strong>Acesso Negado!</strong> Nome de usuário ou senha incorretos.</div>
			<?php
		}
		?>
	</div>
</body>
</html>