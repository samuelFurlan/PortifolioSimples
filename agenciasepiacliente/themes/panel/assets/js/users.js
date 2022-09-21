$("#user").addClass("active");

$('#tableUsers').DataTable({
    ajax: {
        url: URL + '/tabela/usuarios',
        type: 'POST'
    },
    language: {
        url: URL + '/themes/panel/assets/vendors/DataTables/pt_br.json'
    }
});

$("#user-forms").submit(function (e) {
    e.preventDefault();
    var bnt = $("#btnSubmit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    var form = $(this);
    $.ajax({
        url: form.attr("action"),
        data: form.serialize(),
        type: "POST",
        dataType: "json",
        success: function (callback) {
            bnt.html("Salvar");
            bnt.prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Salvo com sucesso!");
                $("#btnReset").click();
                $('#tableUsers').DataTable().ajax.reload();
            }
        }
    });
});

function editStatusAccess(accessId, status) {
    $.ajax({
        url: URL + '/painel/update-usuario',
        data: {accessId: accessId, status: status},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Salvo com sucesso!");
                $('#tableUsers').DataTable().ajax.reload();
            }
        }
    });
}

function cleanForms() {
    $("#divInfo").hide();
    $('#password').prop('required', true);
    $("#accessId").remove();
}

function editAccess(accessId) {
    $.ajax({
        url: URL + '/painel/editar-usuario',
        data: {accessId: accessId},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            $("#userAccess").val(callback.user_access);
            $("#typeAccess").val(callback.profile_access);
            $("#divInfo").show();
            $('#password').prop('required', false);
            $("html, body").scrollTop(0);
            $("#user-forms").append("<input type='hidden' id='accessId' name='accessId' value='" + callback.id_access + "'>");
        }
    });
}