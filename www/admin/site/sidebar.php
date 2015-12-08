<?php

$fDao = new FuncionarioDAO(get_connection());
$f = $fDao->obter_por_codigo(LOGGED_USER);
?>

<link rel="stylesheet" type="text/css" href="<?=ROOT.'/site/css/sidebar.css'?>">

<div id="sidebar">
	<ul>
		<li class="sidebar_brand">
			<a href="#">
				ATS Development
			</a>
		</li>

		<hr>

		<?php
		if($f['permissoes']['gf'] || $f['permissoes']['gp'] || $f['permissoes']['gc']){
			if($f['permissoes']['gf']){
				?>
				<li class="sidebar_option side_btn_f">
					<a href="<?=ROOT.'/site/funcionarios/listar.php'?>">Funcionarios</a>
				</li>
				<?php
			}

			if($f['permissoes']['gp']){
				?>
				<li class="sidebar_option side_btn_p">
					<a href="<?=ROOT.'/site/projetos/listar.php'?>">Projetos</a>
				</li>
				<?php
			}

			if($f['permissoes']['gc']){
				?>
				<li class="sidebar_option side_btn_c">
					<a href="<?=ROOT.'/site/clientes/listar.php'?>">Clientes</a>
				</li>
				<?php
			}
		}else{
			?>
			<li class="sidebar_option">
				<a href="#">Sem Permissões</a>
			</li>
			<?php
		}
		?>

		<hr>

		<li class="sidebar_option side_btn_mp">
			<a href="<?=ROOT.'/site/my/projects/listar_projetos.php'?>">Meus Projetos</a>
		</li>
		<li class="sidebar_option side_btn_ep">
			<a href="<?=ROOT.'/site/my/perfil/perfil.php'?>">Editar Perfil</a>
		</li>
		<li class="sidebar_option">
			<a href="<?=ROOT.'/site/login/login_ctr.php?f=logout'?>">Logout</a>
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