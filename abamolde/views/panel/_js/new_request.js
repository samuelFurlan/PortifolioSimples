sideMenu("requests", true, "new_request");

var selectStatesInputEl = document.querySelector('#client');
if (selectStatesInputEl) {
    const choices = new Choices(selectStatesInputEl);
}

choice = 1;
$("#client").change(function () {
    let client_id = $(this).val();
    const select_seller = $("#seller");
    sendAjax("/buscar-comercial", {"client_id": client_id}, function (callback) {
        if (callback.erro) {
            select_seller.html("<option>Escolha um comercial</option>");
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            if (callback.data) {
                if (choice > 1){
                    choices.destroy();
                }else{
                    choice++;
                }
                select_seller.html("");
                callback.data.forEach(function (item) {
                    select_seller.append("<option value='" + item.seller_id + "'>" + item.seller_name + "</option>")
                });
                const choices = new Choices(select_seller[0],{removeItemButton: true,});
            }
        }
    });
});

$("#item").mask('0000');
$("#amount").mask('00000');
$("#unit-price").mask("#,##0.00", {reverse: true});
$("#discount").mask("#,##0.00", {reverse: true});
$("#general-discount").mask("#,##0.00", {reverse: true});

$("#discount-switch").change(function () {
    let checkbox = $(this);
    let discount = $("#discount");
    discount.val("");
    if (checkbox.is(":checked")) {
        discount.mask("00%", {reverse: true});
    } else {
        discount.mask("000,000.00", {reverse: true});
    }
});

$("#general-discount-switch").change(function () {
    let checkbox = $(this);
    let discount = $("#general-discount");
    discount.val("");
    if (checkbox.is(":checked")) {
        discount.mask("00%", {reverse: true});
    } else {
        discount.mask("000,000.00", {reverse: true});
    }
});

$("#final-item-price").focus(function () {
    let unit_price = $("#unit-price").val();
    let replace = unit_price.replace(/[^\d.]/g, '');
    let float = parseFloat(replace).toFixed(2);
    let amount = $("#amount").val();
    let discount = $("#discount");
    let discount_value;
    let result;

    if (discount.val() !== "") {
        discount_value = discount.val().replace(/[^\d.]/g, '');
        if ($("#discount-switch").is(":checked")) {
            result = ((float * amount) - ((discount_value / 100) * (float * amount))).toFixed(2);
        } else {
            discount_value = parseFloat(discount_value).toFixed(2);
            result = ((float * amount) - discount_value).toFixed(2);
        }
    } else {
        result = (float * amount).toFixed(2);
    }


    $(this).val(result);
    $("#final-item-price").mask("#,##0.00", {reverse: true});
});


$("#item_add").click(function () {
    let notification = "Não";
    if ($("#item-notification").is(":checked")) {
        notification = "Sim";
    }
    let currency = "";
    if ($("#currency").val() !== "Escolha o tipo") {
        currency = $("#currency").val();
    }
    let colum = "";
    if ($("#id_request").length) {
        colum = "<td style='display:none;'></td>"
    }

    $("#body-table-itens").append(
        "<tr>" +
        colum +
        "<td>" + $("#item").val() + "</td>" +
        "<td>" + $("#amount").val() + "</td>" +
        "<td>" + $("#draw-number").val() + "</td>" +
        "<td>" + $("#description").val() + "</td>" +
        "<td>" + currency + "</td>" +
        "<td>" + $("#unit-price").val() + "</td>" +
        "<td>" + $("#discount").val() + "</td>" +
        "<td>" + $("#final-item-price").val() + "</td>" +
        "<td>" + $("#delivery-date").val() + "</td>" +
        "<td>" + $("#item-observation").val() + "</td>" +
        "<td>" + notification + "</td>" +
        "<td><i class='fal fa-times' onclick='$(this).closest(\"tr\").remove(); final_price();'></i></td>" +
        "</tr>");
    reset_itens();
    final_price();
});


function reset_itens() {
    $("#item").val("");
    $("#amount").val("");
    $("#draw-number").val("");
    $("#description").val("");
    $("#unit-price").val("");
    $("#discount-switch").prop("checked", false);
    $("#discount").val("");
    $("#final-item-price").val("");
    $("#delivery-date").val("");
    $("#item-observation").val("");
    $("#item-notification").prop("checked", false);
}

$("#general-discount").keyup(function () {
    final_price();
});

function final_price() {
    let table = $('#table-itens').tableToJSON();
    let total = 0.00;
    let total_desconto = 0.00;
    if (table.length > 0) {
        $.each(table, function (i, item) {
            let replace = item["Preço Total"].replace(/[^\d.]/g, '');
            let float = parseFloat(replace);
            total = parseFloat(total) + float;
            if (item["Desconto"] !== "") {
                if (item["Desconto"].indexOf('%') > -1) {
                    let desconto = item["Desconto"].replace(/[^\d.]/g, '');
                    let unit_price = parseFloat(item["Preço Unit."].replace(/[^\d.]/g, ''));
                    let total_price = unit_price * parseInt(item["Qtde."]);
                    total_desconto = parseFloat(parseFloat(total_desconto) + parseFloat((desconto / 100) * total_price)).toFixed(2);
                } else {
                    let replace = item["Desconto"].replace(/[^\d.]/g, '');
                    let float = parseFloat(replace);
                    total_desconto = parseFloat(parseFloat(total_desconto) + float).toFixed(2);
                }
            }
        });

        let general_discount = $("#general-discount");
        if (general_discount.val() !== "") {
            let discount_value = general_discount.val().replace(/[^\d.]/g, '');
            if ($("#general-discount-switch").is(":checked")) {
                total = parseFloat(total - ((discount_value / 100) * total)).toFixed(2);
            } else {
                discount_value = parseFloat(discount_value).toFixed(2);
                total = parseFloat(total - discount_value).toFixed(2);
            }
        }

        $("#final-price").val(parseFloat(total).toFixed(2));
        $("#general-item-discount").val(parseFloat(total_desconto).toFixed(2));
    } else {
        $("#general-item-discount").val("");
        $("#final-price").val("");
    }

}

$("#link-submit").click(function (e) {
    e.preventDefault();
    let request_id = $("#request_id").val();
    sendAjax("/vincular-pedido", {"request_id": request_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#link-request-modal").modal("hide");
            returnMessage("Vinculado com sucesso!");
            $("#link-request-response").html("Vinculado ao pedido N° " + request_id + " <i class='fal fa-times-circle' onclick='removeLink()'></i>");
            $("#link-request-id").val(request_id);
        }
    });
});
function removeLink(){
    $("#link-request-id").val("");
    $("#link-request-response").html("");
}

function validateForms() {
    let form_data = new FormData();

    let request_number = $("#request_number").val();
    form_data.append("request_number", request_number);

    let client = $("#client").val();
    if (parseInt(client)) {
        form_data.append("client", client);
    } else {
        Swal.fire(
            'Erro!',
            'Obrigatório escolher o cliente!',
            'error'
        );
        return false;
    }

    let seller = $("#seller").val();
    if (parseInt(seller)) {
        form_data.append("seller", seller);
    } else {
        form_data.append("seller", 0);
    }


    let service_type = $("#service-type").val();
    form_data.append("service_type", service_type);

    let situation = $("#situation").val();
    form_data.append("situation", situation);

    let validity = $("#validity").val();
    form_data.append("validity", validity);

    let draw = $("#draw");
    for (let $i = 0; $i < draw.prop('files').length; $i++) {
        form_data.append("draw[" + $i + "]", draw.prop('files')[$i]);
    }

    let draw_type = $("#draw-type").val();
    form_data.append("draw_type", draw_type);

    let email_history = $("#email-history");
    for (let $i = 0; $i < email_history.prop('files').length; $i++) {
        form_data.append("email_history[" + $i + "]", email_history.prop('files')[$i]);
    }

    let other_files = $("#other-files");
    for (let $i = 0; $i < other_files.prop('files').length; $i++) {
        form_data.append("other_files[" + $i + "]", other_files.prop('files')[$i]);
    }

    let link_request_id = $("#link-request-id").val();


    if (parseInt(link_request_id)) {
        form_data.append("link_request_id", link_request_id);
    } else {
        form_data.append("link_request_id", 0);
    }

    let general_observations = $("#general-observations").val();
    form_data.append("general_observations", general_observations);

    let table = $('#table-itens').tableToJSON();
    form_data.append("table", JSON.stringify(table));

    let general_discount = $('#general-discount').val();
    form_data.append("general_discount", general_discount);

    let general_item_discount = $('#general-item-discount').val();
    form_data.append("general_item_discount", general_item_discount);

    let final_price = $('#final-price').val();
    form_data.append("final_price", final_price);

    if ($("#id_request").length) {
        let id_request = $('#id_request').val();
        form_data.append("id_request", id_request);
    }

    return form_data;
}

$("#form-request").submit(function (e) {
    let forms = $(this);
    e.preventDefault();
    let values = validateForms();
    if (!values) {
        return false;
    }
    let bnt = $("#save-button");
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

$("#form-edit-request").submit(function (e) {
    let forms = $(this);
    e.preventDefault();
    let values = validateForms();
    if (!values) {
        return false;
    }
    let bnt = $("#btn_update");
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
            bnt.html("Atualizar").prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Atualizado  com sucesso!");
                returnMessage("Redirecionando...");
                setTimeout(function () {
                    window.location = callback.path;
                }, 1500);

            }
        }
    });

});

function removeItem(item_id) {
    final_price();
    sendAjax("/remover-item", {"item_id": item_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Removido com sucesso!");
        }
    });
}

$("#btn_disable").click(function (e) {
    e.preventDefault();
    let id_request = $("#id_request").val();
    sendAjax("/desativar-pedido", {"request_id": id_request, "status": 0}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Desativado com sucesso!");
            $("#btn_disable").css("display", "none");
            $("#btn_enable").css("display", "block");
        }
    });
});

$("#btn_enable").click(function (e) {
    e.preventDefault();
    let id_request = $("#id_request").val();
    let status = $("#situation").val();
    sendAjax("/desativar-pedido", {"request_id": id_request, "status": status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Ativado com sucesso!");
            $("#btn_enable").css("display", "none");
            $("#btn_disable").css("display", "block");
        }
    });
});

$("#btn_production").click(function (e){
    e.preventDefault();
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Esse pedido será enviado e ficará disponivel para produção!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continuar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Concluido!',
                'Pedido disponivel para a produção.',
                'success'
            );
            $(this).attr("disabled","disabled");
            $(this).html("Liberado para produção");
        }
    })
});

$("#send-mail-form").submit(function (e) {
    let forms = $(this);
    e.preventDefault();
    returnMessage("Ops, erro ao enviar email, atualize e tente novamente!", "FF0000", "8B0000");


    return false;
    let values = validateForms();
    if (!values) {
        return false;
    }
    let bnt = $("#btn_update");
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
            bnt.html("Atualizar").prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Atualizado  com sucesso!");
                returnMessage("Redirecionando...");
                setTimeout(function () {
                    window.location = callback.path;
                }, 1500);

            }
        }
    });

});