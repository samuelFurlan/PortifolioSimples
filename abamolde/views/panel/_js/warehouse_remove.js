sideMenu("warehouse", true,"remove_warehouse");

// var selectStatesInputEl = document.querySelector('#item');
// if (selectStatesInputEl) {
//     const choices = new Choices(selectStatesInputEl);
// }

$("#category").change(function () {
    let category_id = $(this).val();
    const item_select = $("#item");
    sendAjax("/compras/listar-fornecedor", {"category_id": category_id}, function (callback) {
        if (callback.category_erro) {
            item_select.html("<option value=''>Escolha uma Categoria</option>");
            returnMessage(callback.category_erro, "FF0000", "8B0000");
        } else if (callback.category_success === 200) {
            if (callback.category_data) {
                item_select.html("");
                callback.category_data.forEach(function (item) {
                    item_select.append("<option value='" + item.product_id + "'>" + item.product_code + " - " + item.product_name + "</option>")
                });
            }
        }
    });
});

$("#remove-warehouse-form").submit(function (e) {
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
