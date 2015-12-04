<link rel="stylesheet" type="text/css" href="<?=ROOT.'/site/css/sidebar.css'?>">

<div id="sidebar">
	<ul>
		<li class="sidebar_brand">
			<a href="#">
				ATS Development
			</a>
		</li>

		<hr>

		<li class="sidebar_option side_btn_f">
			<a href="<?=ROOT.'/site/funcionarios/listar.php'?>">Funcionarios</a>
		</li>
		<li class="sidebar_option side_btn_p">
			<a href="<?=ROOT.'/site/projetos/listar.php'?>">Projetos</a>
		</li>
		<li class="sidebar_option side_btn_c">
			<a href="<?=ROOT.'/site/clientes/listar.php'?>">Clientes</a>
		</li>

		<hr>

		<li class="sidebar_option side_btn_mp">
			<a href="<?=ROOT.'/site/my/projects/listar_projetos.php'?>">Meus Projetos</a>
		</li>
		<li class="sidebar_option side_btn_ep">
			<a href="<?=ROOT.'/site/my/perfil/perfil.php'?>">Editar Perfil</a>
		</li>
		<li class="sidebar_option">
			<a href="#">Logout</a>
		</li>

	</ul>
</div>

<?php
if(defined("NAV")){
	?>
	<script>
		$(".<?=NAV?>").toggleClass("option_active");
	</script>
	<?php
}
?>