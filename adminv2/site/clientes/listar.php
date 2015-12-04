<?php
define("ROOT", "../..");
define("NAV", "side_btn_c");

require ROOT."/libs/lib_list.php";

$search = null;
if(array_key_exists("search", $_GET)){
	$search = $_GET['search'];
}

$dao = new ClienteDAO(get_connection());
$clientes = $dao->listar_clientes($search);

require ROOT."/site/header.php";
require ROOT."/site/sidebar.php";
?>

<div class="sub_body">
	<fieldset>
		<legend>Clientes</legend>
		<div class="panel panel-default panel-body">
			<form class="input-group input-group-sm">
				<input name="search" type="text" class="form-control" placeholder="Digite sua busca aqui..." value="<?=$search?>">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">Procurar</button>
				</span>
			</form>
		</div>

		<?php
		if(array_key_exists("alert", $_GET)){
			if($_GET['alert'] == 'success'){
				?>
				<div class="alert alert-success" role="alert">Cliente deletado com sucesso!</div>
				<?php
			}else if($_GET['alert'] == 'arror'){
				?>
				<div class="alert alert-danger" role="alert">Erro ao deletar cliente</div>
				<?php
			}
		}	
		?>

		<div class="panel panel-default">
			<table class="table">
				<tr>
					<th></th>
					<th>Codigo</th>
					<th>Nome</th>
					<th>CPF/CNPJ</th>
					<th>Nome de Usuário</th>
				</tr>
				<?php
				foreach ($clientes as $c) {
					?>
					<tr>
						<td>
							<a href="dao.php?cod_cliente=<?=$c['codigo']?>">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</a>
						</td>
						<td><?=$c['codigo']?></td>
						<td><?=$c['nome_completo']?></td>
						<td><?=$c['cpf_cnpj']?></td>
						<td><?=$c['usuario']['nome_de_usuario']?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</fieldset>
</div>
