authToken();

//Envia formulário
$("#auth-forms").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr("action"),
        data: form.serialize(),
        type: "POST",
        dataType: "json",
        success: function (callback) {
            if (callback.erro) {
                authToken();
                returnMessage(callback.erro);
            } else if (callback.success === 200) {
                window.location = window.location.href+callback.path;
            }
        }
    });
});

//Carrega Token de autenticação
function authToken() {
    $.ajax({
        url: "http://localhost/agenciasepiacliente/auth-token",
        type: "POST",
        dataType: "json",
        success: function (callback) {
            if (callback.tokenName && callback.tokenValue) {
                $("#authTokenInput").attr('value', callback.tokenValue).attr('name', callback.tokenName);
            }
        },
        error: function () {
            returnMessage("Erro, por favor, recarregue a página!");
            //document.location.reload(true);
        }
    });
}

//Retorna msg responsiva
function returnMessage(text) {
    $("#errorDiv").fadeIn().html("<i class=\"bi bi-exclamation-circle\"></i>  " + text);
    setTimeout(function () {
        $("#errorDiv").fadeOut()
    }, 3000);
}
