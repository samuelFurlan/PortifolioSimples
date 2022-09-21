sideMenu("purchases", true, "new_purchase");


// var selectStatesInputEl = document.querySelector('#item');
// if (selectStatesInputEl) {
//     const choices = new Choices(selectStatesInputEl);
// }

$("#unitValue").mask("#,##0.00", {reverse: true});
$("#totalValue").mask("#,##0.00", {reverse: true});

$("#category").change(function () {
    update_items($(this).val());
});

function update_items(category_id) {
    const provider = $("#provider");
    const item_select = $("#item");
    sendAjax("/compras/listar-fornecedor", {"category_id": category_id}, function (callback) {
        if (callback.provider_erro) {
            provider.html("<option>Nenhum fornecedor cadastrado</option>");
            returnMessage(callback.provider_erro, "FF0000", "8B0000");
        } else if (callback.provider_success === 200) {
            if (callback.provider_data) {
                provider.html("");
                callback.provider_data.forEach(function (item) {
                    provider.append("<option value='" + item.provider_id + "'>" + item.provider_name + "</option>")
                });
            }
        }
        if (callback.category_erro) {
            item_select.html("<option value=''>Nenhum item cadastrado</option>");
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
}

$("#totalValue").focus(function () {
    let total = parseFloat(parseInt($("#qtde").val()) * parseFloat($("#unitValue").val())).toFixed(2);
    $(this).val(total)
});

function addRow() {
    if ($("#item").val() == "" || $("#qtde").val() == "" || $("#unitValue").val() == "" || $("#totalValue").val() == "") {
        returnMessage("Todos campos são obrigatórios!", "FF0000", "8B0000");
        return false;
    }
    $("#body-table-itens").append(
        "<tr>" +
        "<td style='display: none'>" + $("#item").val() + "</td>" +
        "<td>" + $("#item").text() + "</td>" +
        "<td>" + $("#qtde").val() + "</td>" +
        "<td> R$ " + $("#unitValue").val() + "</td>" +
        "<td> R$ " + $("#totalValue").val() + "</td>" +
        "<td><i class='fal fa-times' onclick='$(this).closest(\"tr\").remove();'></i></td>" +
        "</tr>");
    reset_itens();
}


function reset_itens() {
    $("#qtde").val("");
    $("#unitValue").val("");
    $("#totalValue").val("");
}

function validateForms() {
    let form_data = new FormData();

    form_data.append("compra_id", $("#compra_id").val());
    form_data.append("request", $("#request").val());
    form_data.append("category", $("#category").val());
    form_data.append("provider", $("#provider").val());
    form_data.append("status", $("#status").val());
    form_data.append("purchase_date", $("#purchase_date").val());
    form_data.append("delivery_date", $("#delivery_date").val());

    let budget = $("#budget");
    for (let $i = 0; $i < budget.prop('files').length; $i++) {
        form_data.append("budget[" + $i + "]", budget.prop('files')[$i]);
    }

    let table = $('#body-table-itens').tableToJSON();
    form_data.append("table", JSON.stringify(table));

    return form_data;
}

$("#new-purchase-form").submit(function (e) {
    let forms = $(this);
    e.preventDefault();
    let values = validateForms();
    if (!values) {
        return false;
    }
    let bnt = $("#button-submit");
    bnt.prop('disabled', true).html("<span class='spinner-border' role='status' aria-hidden='true'></span>");
    $.ajax({
        url: forms.attr("action"),
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        dataType: "json",
        success: function (callback) {
            bnt.html("Salvar").prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Salvo com sucesso!");
                returnMessage("Redirecionando...");
                setTimeout(function () {
                    window.location = callback.path;
                }, 1500);

            }
        }
    });
});

$("#unity-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#unity-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#unidade_id").val("");
            $("#unidade").val("");
            reloadUnity();
            $("#link-unit-modal").modal("hide");
            returnMessage("Salvo com sucesso!");
        }
    });
});

function reloadUnity() {
    const tipo = $("#tipo");
    sendAjax("/almoxarifado/listar-unidade", {"id": "1"}, function (callback) {
        if (callback.erro) {
            tipo.html("<option>Escolha um tipo</option>");
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            if (callback.data) {
                tipo.html("");
                callback.data.forEach(function (item) {
                    tipo.append("<option value='" + item.unity_id + "'>" + item.unity_name + "</option>")
                });
            }
        }
    });
}

$("#new-category-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#category-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            cleanCategory();
            reloadCategory();
            $("#link-request-modal").modal("hide");
            returnMessage("Salvo com sucesso!");
        }
    });
});

function cleanCategory() {
    $("#id_category").val("");
    $("#categoryName").val("");
}

function reloadCategory() {
    const category = $(".category");
    sendAjax("/compras/listar-categoria-fornecedor", {"id": "1"}, function (callback) {
        if (callback.erro) {
            category.html("<option>Escolha uma categoria</option>");
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            if (callback.data) {
                category.html("");
                callback.data.forEach(function (item) {
                    category.append("<option value='" + item.category_id + "'>" + item.category_name + "</option>")
                });
            }
        }
    });
}

$("#new-warehouse-form").submit(function (e) {
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
            $("#btn-reset-warehouse").click();
            update_items($("#category").val());
            returnMessage("Salvo com sucesso!");
        }
    });
});