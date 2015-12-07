func_edit = null;
api_url = "../../api/api.php";

function update_form(){
	$("#tf_nome_completo").val(func_edit.nome_completo);
	$("#tf_e_mail").val(func_edit.e_mail);
	$("#tf_telefone").val(func_edit.telefone);
	$("#tf_observacoes").val(func_edit.observacoes);
	$("#ativo").attr("checked", func_edit.ativo);
	$("#tf_nome_de_usuario").val(func_edit.usuario.nome_de_usuario);
	$("#tf_senha").val(func_edit.usuario.senha);
	$("#cbx_bloqueado").attr("checked", func_edit.usuario.bloqueado);
	$("#gf").attr("checked", func_edit.permissoes.gf);
	$("#gp").attr("checked", func_edit.permissoes.gf);
	$("#gd").attr("checked", func_edit.permissoes.gf);
	$("#gc").attr("checked", func_edit.permissoes.gf);
	$("#gn").attr("checked", func_edit.permissoes.gf);
}

$(document).ready(function(){
	$("#btn_deletar").click(function(){
		alert = $("#alert_info");
		alert.attr("class", "alert alert-info");
		alert.html("Deletando funcionario");
		alert.css("display", "block");


		if(confirm('Deseja realmente deletar este funcionario?')){
			url = api_url+"?f=deletar_funcionario";

			var request = $.ajax({
				url: url,
				dataType: "json",
				type: "POST",
				data: func_edit
			});

			request.done(function(resp){
				alert.attr("class", "alert alert-success")
				alert.html("Funcionario salvo com sucesso");

				status = resp.status;

				if(status == "success"){
					location.href="listar.php";
				}else{
					alert.attr("class", "alert alert-error")
					alert.html(resp.message);
				}
			});
			request.fail(function(jqXHR, textStatus) {
				alert.attr("class", "alert alert-error")
				alert.html(textStatus);
			});
		}
	});

	$("#btn_salvar").click(function(){
		alert = $("#alert_info");
		alert.html("Salvando funcionario ... ");
		alert.attr("class", "alert alert-info")
		alert.css("display", "block");

		cod_funcionario = func_edit == null ? 0:func_edit.codigo;
		cod_usuario = func_edit == null ? 0:func_edit.usuario.codigo;

		func = {
			codigo: cod_funcionario,
			nome_completo: $("#tf_nome_completo").val(),
			e_mail: $("#tf_e_mail").val(),
			telefone: $("#tf_telefone").val(),
			observacoes: tinyMCE.get("tf_observacoes").getContent(),
			ativo: document.getElementById("cbx_ativo").checked,
			usuario: {
				codigo: cod_usuario,
				nome_de_usuario: $("#tf_nome_de_usuario").val(),
				senha: $("#tf_senha").val(),
				bloqueado: document.getElementById("cbx_bloqueado").checked
			},
			permissoes: {
				gf: document.getElementById("gf").checked,
				gp: document.getElementById("gp").checked,
				gd: document.getElementById("gd").checked,
				gc: document.getElementById("gc").checked,
				gn: document.getElementById("gn").checked,
			}
		};
		
		url = api_url+"?f=salvar_funcionario";

		var request = $.ajax({
			url: url,
			dataType: "json",
			type: "POST",
			data: func
		});

		request.done(function(resp){
			alert.attr("class", "alert alert-success")
			alert.html("Funcionario salvo com sucesso");

			func_edit = resp.json;

			console.log(resp);
		});
		request.fail(function(jqXHR, textStatus) {
			alert.attr("class", "alert alert-error")
			alert.html(textStatus);
		});
	});
});