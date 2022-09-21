//Envia formulário
$("#form_auth").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr("action"),
        data: form.serialize(),
        type: "POST",
        dataType: "json",
        success: function (callback) {
            //returnMessage("Sistema em manutenção, por favor, aguarde!");
            if (callback.erro) {
                returnMessage(callback.erro);
            } else if (callback.success === 200) {
                window.location = callback.path;
            }
        }
    });
});

//Retorna msg responsiva
const div_error = $("#div_error");
function returnMessage(text) {
    div_error.fadeIn().html("<i class='fal fa-exclamation-circle'></i>  " + text);
    setTimeout(function () {
        div_error.fadeOut()
    }, 3000);
}

