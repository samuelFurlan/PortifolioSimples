sideMenu("settings", true, "roles");

$("#table-roles").DataTable({
    ajax: {
        url: URL + '/tabelas/cargos',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

$("#new-role-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);
    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-roles').DataTable().ajax.reload();
            $("#button-reset").click();
            $("#role_id").val("");
            returnMessage("Salvo com sucesso!");
        }
    });
});

function editRole(role_id){
    sendAjax("/editar-cargos", {role_id : role_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#role_id").val(callback.role_id);
            $("#roleName").val(callback.role_name);
            $.each(callback.role_permissions, function (i, item){
                if (item){
                    $("#"+i).prop('checked', true);
                }
            });
            $("html, body").animate({ scrollTop: 0 });
        }
    });
}

function changeStatus(role_id, status){
    sendAjax("/status-cargos", {role_id : role_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-roles').DataTable().ajax.reload();
            if (callback.status === "1"){
                returnMessage("Ativado com sucesso!");
            }else{
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}

