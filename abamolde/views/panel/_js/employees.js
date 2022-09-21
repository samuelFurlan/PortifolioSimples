sideMenu("settings", true, "employees");

$("#table-employees").DataTable({
    ajax: {
        url: URL + '/tabelas/colaboradores',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});


$("#new-employe-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);
    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled', false);
        $("#password-alert").hide("slow");
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-employees').DataTable().ajax.reload();
            $("#button-reset").click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function edit(access_id) {
    sendAjax("/editar-colaborador", {access_id: access_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#employe_id").val(callback.access_id);
            $("#name").val(callback.access_name);
            $("#roles option[value='" + callback.access_fk_role + "']").attr("selected", "selected");
            $("#username").val(callback.access_username);
            $("html, body").animate({scrollTop: 0});
            $("#password-alert").show("slow");
        }
    });
}

function changeStatus(employe_id, status) {
    sendAjax("/status-colaborador", {employe_id: employe_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-employees').DataTable().ajax.reload();
            if (callback.status === "1") {
                returnMessage("Ativado com sucesso!");
            } else {
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}
