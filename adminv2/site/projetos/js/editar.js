api_url = "../../api/api.php";

projeto = null;
atividades = null;

function deletar_participante(codigo){
	alert = $("#alert_participantes");

	alert.attr("class", "alert alert-info");
	alert.html("Cadastrando participantes");
	alert.css("display", "block");

	data = {
		cod_projeto: projeto.codigo,
		cod_funcionario: codigo
	};

	console.log(data);

	url = api_url+"?f=deletar_participante";

	console.log(url);

	var request = $.ajax({
		url: url,
		dataType: "text",
		type: "POST",
		data: data
	});

	console.log("ok");

	request.done(function(resp){
		console.log(resp);

		alert.attr("class", "alert alert-success")
		alert.html("Participante removido com sucesso");

		table = $("#part_table");
		table.html(JSON.parse(resp).html);
	});

	request.fail(function(jqXHR, textStatus) {
		alert.attr("class", "alert alert-error")
		alert.html(textStatus);
	});
}

function update_form_projeto(){
	$("#tf_nome_completo").val(projeto.nome);
	$("#cb_cliente").val(projeto.cod_cliente);
	$("#area_descricao").val(projeto.descricao);
	document.getElementById("cbx_concluido").checked = projeto.concluido;
}

$(document).ready(function(){
	$("#btn_cadastrar_part").click(function(){
		if(projeto != null){
			alert = $("#alert_participantes");

			alert.attr("class", "alert alert-info");
			alert.html("Cadastrando participantes");
			alert.css("display", "block");

			nome_de_usuario = $("#tf_cadastrar_participante").val();

			data = {
				nome_de_usuario: nome_de_usuario,
				cod_projeto: projeto.codigo
			}

			url = api_url+"?f=projeto_add_participante";

			var request = $.ajax({
				url: url,
				dataType: "text",
				type: "POST",
				data: data
			});

			request.done(function(resp){
				console.log(resp);

				alert.attr("class", "alert alert-success")
				alert.html("Participante adicionado com sucesso");

				table = $("#part_table");
				table.html(JSON.parse(resp).html);
			});

			request.fail(function(jqXHR, textStatus) {
				alert.attr("class", "alert alert-error")
				alert.html(textStatus);
			});
		}else{
			alert("O Projeto ainda não foi salvo!");
		}
	});

	$("#btn_salvar").click(function(){
		alert = $("#alert_info");
		alert.attr("class", "alert alert-info");
		alert.html("Salvando projeto");
		alert.css("display", "block");

		if(projeto == null){
			projeto = {
				codigo: 0,
				nome_completo: $("#tf_nome_completo").val(),
				cod_cliente: $("#cb_cliente").val(),
				descricao: tinyMCE.get("area_descricao").getContent(),
				concluido: document.getElementById("cbx_concluido").checked
			}
		}else{
			projeto.nome_completo = $("#tf_nome_completo").val();
			projeto.cod_cliente = $("#cb_cliente").val();
			projeto.descricao = tinyMCE.get("area_descricao").getContent();
			projeto.concluido = document.getElementById("cbx_concluido").checked;
		}

		url = api_url+"?f=salvar_projeto";

		var request = $.ajax({
			url: url,
			dataType: "json",
			type: "POST",
			data: projeto
		});

		request.done(function(resp){
			alert.attr("class", "alert alert-success")
			alert.html("Projeto salvo com sucesso");

			status = resp.status;

			if(status == "success"){
				projeto = resp.json;
			}else{
				alert.attr("class", "alert alert-error")
				alert.html(resp.message);
			}
		});
		request.fail(function(jqXHR, textStatus) {
			alert.attr("class", "alert alert-error")
			alert.html(textStatus);
		});

		console.log(projeto);
	});
});