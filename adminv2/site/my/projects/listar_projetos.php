<?php
define("ROOT", "../../..");
define("NAV", "side_btn_mp");

require ROOT."/libs/lib_list.php";
require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";

$pDao = new ProjetoDAO(get_connection());
$projetos = $pDao->listar_projetos_por_funcionaro(LOGGED_USER);

?>

<div class="sub_body">
	<fieldset>
		<legend>Meus Projetos</legend>
		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Cliente</th>
					<th>Concluído</th>
				</tr>
				<?php
				foreach ($projetos as $p) {
					?>
					<tr>
						<td>
							<a href="visualizar_projeto.php?cod_projeto=<?=$p['codigo']?>">
								<span class="glyphicon glyphicon-eye-open" ></span>
							</a>
						</td>
						<td><?=$p['nome']?></td>
						<td><?=$p['cliente']['nome_completo']?></td>
						<td><?=$p['concluido'] ? "sim":"não"?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</fieldset>
</div>