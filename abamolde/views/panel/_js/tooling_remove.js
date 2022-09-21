sideMenu("tooling", true, "remove_tooling");

var selectStatesInputEl = document.querySelector('#item');
if (selectStatesInputEl) {
    const choices = new Choices(selectStatesInputEl);
}

$("#remove-tooling-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Retirada").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#btn-reset").click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

$("#barcode").keydown(function (e) {
    let code = (e.keyCode ? e.keyCode : e.which);
    if (code === 13 || code === 9) {
        e.preventDefault();
        let id = $(this).val();
        sendAjax("/ferramentaria/carregar-codigobarras", {id: id}, function (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
                $("#barcode").val("");
            } else if (callback.success === 200) {
                let divs = $(".choices__item--selectable");
                divs.each(function (item){
                    if($(this).data('value') == callback.tooling_id){
                        var e = document.createEvent('HTMLEvents');
                        e.initEvent('mousedown', false, true);
                        divs[item].dispatchEvent(e);
                    }
                });
            }
        });
    }
});