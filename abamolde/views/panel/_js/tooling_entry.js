sideMenu("tooling", true,"entry_tooling");

var selectStatesInputEl = document.querySelector('#item');
if (selectStatesInputEl) {
    const choices = new Choices(selectStatesInputEl);
}

$("#entry-tooling-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Adicionar").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#btn-reset").click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

$("#item").change(function (){
    let selected = $(this).val();
    sendAjax("/ferramentaria/carregar-ferramenta", {id: selected}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#nf").val(callback.remove_nf);
            $("#employee").val(callback.remove_employee);
        }
    });
});