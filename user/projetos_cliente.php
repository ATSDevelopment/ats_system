<?php 
require "dao/cliente_dao.class.php";

$fdao = new cliente_dao();

$projetos = $fdao->listar_projetos($_SESSION["cod_cli"]);

?>
<div class="accordion" id="accordion2">

	<div class="accordion-group">
		<div class="accordion-heading">
			<div class="list-group">

				<?php 
				$cod = 0;
				foreach ($projetos as $p) {
					
					?>

					<a href="#collapse<?=$cod?>" class="list-group-item accordion-toggle" data-toggle="collapse" data-parent="#accordion2">
						<div class="list-group-item-heading">
							<h4 >
								<?= $p["nome"]?>
							</h4>
						</div>
						<p class="list-group-item-text">
							<div id="collapse<?=$cod?>" class="accordion-body collapse">
								<?= $p["descricao"]?>
							</div>
						</p>
					</a>

					<?php 
					$cod ++;
				}
				?>
			</div>
		</div>
	</div>
</div>
