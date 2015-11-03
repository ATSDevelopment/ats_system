function preencher(f){
	document.f_editor.nome_completo.value = f.nome_completo;
	document.f_editor.e_mail.value = f.e_mail;
	document.f_editor.telefone.value = f.telefone;
	document.f_editor.ativo.checked = f.ativo;
	document.f_editor.observacoes.value = f.observacoes;
	document.f_editor.usuario.value = f.usuario;
	document.f_editor.senha.value = f.senha;
	document.f_editor.bloqueado.checked = f.bloqueado;

	document.f_editor.ger_func.checked = f.permissoes.gf;
	document.f_editor.ger_proj.checked = f.permissoes.gp;
	document.f_editor.ger_down.checked = f.permissoes.gd;
	document.f_editor.ger_cli.checked = f.permissoes.gc;
	document.f_editor.ger_not.checked = f.permissoes.gn;
}

$(document).ready(function(){
	tinymce.init({
		selector: "textarea"
	});
});