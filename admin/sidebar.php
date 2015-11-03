<link rel="stylesheet" type="text/css" href="css/sidebar.css">

<div id="sidebar">
	<ul>
		<li class="sidebar_brand">
			<a href="#">
				ATS Development
			</a>
		</li>

		<hr>

		<li class="sidebar_option side_btn_f">
			<a href="funcionarios_listar.php">Funcionarios</a>
		</li>
		<li class="sidebar_option side_btn_p">
			<a href="projetos_listar.php">Projetos</a>
		</li>
		<li class="sidebar_option side_btn_c">
			<a href="#">Clientes</a>
		</li>
		<li class="sidebar_option side_btn_d">
			<a href="#">Downloads</a>
		</li>

		<hr>

		<li class="sidebar_option">
			<a href="#">Meus Projetos</a>
		</li>
		<li class="sidebar_option">
			<a href="#">Editar Perfil</a>
		</li>
		<li class="sidebar_option">
			<a href="#">Logout</a>
		</li>

	</ul>
</div>

<script>
	$(".<?=$nav?>").toggleClass("option_active");
</script>