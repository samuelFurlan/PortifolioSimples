$("#clients").addClass("active");

$('#tableClients').DataTable({
    ajax: {
        url: URL + '/tabela/clientes',
        type: 'POST'
    },
    language: {
        url: URL + '/themes/panel/assets/vendors/DataTables/pt_br.json'
    }
});

$("#clientName").keyup(function () {
    $("#clientNameLabel").html($(this).val());
});
$("#userClient").keyup(function () {
    $("#clientUserLabel").html("@" + $(this).val());
});
$("#archive").change(function () {
    $("#previewImage").attr('src', window.URL.createObjectURL(this.files[0]));
});

function cleanForms() {
    $("#previewImage").attr('src', URL + '/themes/_assets/_images/defaults/default-avatar.jpg');
    $("#clientNameLabel").html("Cliente");
    $("#clientUserLabel").html("Usuário");
    $("#divInfo").hide();
    $('#archive').prop('required',true);
    $('#password').prop('required',true);
    $("#clientId").remove();
}

$("#client-forms").submit(function (e) {
    e.preventDefault();
    var bnt = $("#btnSubmit");
    //bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    var form = $(this);
    var form_data = new FormData(form[0]);
    form_data.append('file', $('#archive').prop('files')[0]);
    $.ajax({
        url: form.attr("action"),
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
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
                $('#tableClients').DataTable().ajax.reload();
            }
        }
    });
});

function editClient(clientId) {
    $.ajax({
        url: URL + '/painel/editar-cliente',
        data: {clientId: clientId},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            $("#clientName").val(callback.clientName);
            $("#userClient").val(callback.userClient);
            $("#previewImage").attr('src', URL + callback.previewImage);
            $("#clientNameLabel").html(callback.clientName);
            $("#clientUserLabel").html("@"+callback.userClient);
            $("#divInfo").show();
            $('#archive').prop('required',false);
            $('#password').prop('required',false);
            $("html, body").scrollTop(0);
            $("#client-forms").append("<input type='hidden' id='clientId' name='clientId' value='"+callback.clientId+"'>");
        }
    });
}