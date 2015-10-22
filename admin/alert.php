<?php
$title = "Alert";
$message = "";
$default_redirect = "index.php";
$confirm_refirect = "";
$default_text="Voltar";
$confirm_text="";
$type = "information";


if (array_key_exists("type", $_GET)) {
	$type = $_GET['type'];
}

if(array_key_exists("title", $_GET)){
	$title = $_GET['title'];
}

if(array_key_exists("message", $_GET)){
	$message = $_GET['message'];
}

if(array_key_exists("default_redirect", $_GET)){
	$default_redirect = $_GET['default_redirect'];
}

if(array_key_exists("confirm_refirect", $_GET)){
	$confirm_refirect = $_GET['confirm_refirect'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" >
	<style>
		body {
			width: 400px;
			margin: 15px auto;
		}

		.controls {
			float: right;
		}
	</style>
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-body">
			<fieldset>
				<legend><?=$title?></legend>
				<p>
					<?=$message?>
				</p>
				<div class="controls">
					<div class="btn-group">
						<?php
							if($type == "information"){
								?>
								<a href="<?=$default_redirect?>" class="btn btn-primary"><?=$default_text?></a>
								<?php
							}else if($type == "confirm"){
								?>
								<a href="<?=$default_redirect?>" class="btn btn-primary	"><?=$default_text?></a>
								<a href="<?=$confirm_refirect?>" class="btn btn-primary"><?=$confirm_text?></a>
								<?php
							}
						?>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</body>
</html>