<?php

require "header.php";
if(array_key_exists("nav", $_GET)){
	$nav = $_GET['nav'];
}

require "verifica.php";
?>
<link rel="stylesheet" type="text/css" href="css/area_cliente.css">
<div class="container">
	<div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">

					<?php $foto = "img/perfil/".$_SESSION['id_usuario']. '.jpg'; 
					if (file_exists($foto)) {						
						echo "<img src=$foto class='img-responsive'>";	
					}else{
						echo "<img src='img/avatar.jpg' class='img-responsive'>";
					}
					?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $_SESSION['nome_cli'];?>
					</div>
					<!--<div class="profile-usertitle-job">
						Developer
					</div>-->
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS 
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div>
				END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<?php 
						if ($nav =="projetos") {
							echo "<li class='active'>";
						}else{
							echo "<li>";
						}
						?>
						<a href="area_do_cliente.php?nav=projetos">
							<i class="glyphicon glyphicon-home"></i> Projetos 
						</a>
					</li>
					<?php 
					if ($nav =="perfil") {
						echo "<li class='active'>";
					}else{
						echo "<li>";
					}
					?>
					<a href="area_do_cliente.php?nav=perfil">
						<i class="glyphicon glyphicon-user"></i> Editar Perfil
					</a>
				</li>
				<?php 
				if ($nav =="downloads") {
					echo "<li class='active'>";
				}else{
					echo "<li>";
				}
				?>
				<a href="area_do_cliente.php?nav=downloads">
					<i class="glyphicon glyphicon-download-alt"></i> Downloads 
				</a>
			</li>

			<li>
				<a href="logout.php">
					<i class="glyphicon glyphicon-log-out"></i> Sair 
				</a>
			</li>
		</ul>
	</div>
	<!-- END MENU -->
</div>
</div>

<div class="col-md-9">
	<div class="profile-content">
		<?php
		if($nav == "projetos"){
			include "projetos_cliente.php";
		}elseif ($nav == "perfil") {
			include "perfil_cliente.php";
		}elseif ($nav == "downloads") {
			include "downloads_cliente.php";

		}
		?>
	</div>
</div>
</div>
</div>
<br>
<br>
<?php
require "footer.php";
?>