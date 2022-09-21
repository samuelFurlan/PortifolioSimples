sideMenu("purchases", true, "providers");

let contactMask = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(contactMask.apply({}, arguments), options);
        }
    };

$("#contact").mask(contactMask, spOptions);
$("#cellphone").mask(contactMask, spOptions);
$("#others").mask(contactMask, spOptions);

let documentMask = function (val) {
        return val.replace(/\D/g, '').length < 12 ? '000.000.000-000' : '00.000.000/0000-00';
    },
    documentOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(documentMask.apply({}, arguments), options);
        }
    };

$("#cnpj").mask(documentMask, documentOptions);

$("#table-providers").DataTable({
    ajax: {
        url: URL + '/tabelas/fornecedores',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

$("#new-provider-form").submit(function (e) {
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
            $('#table-providers').DataTable().ajax.reload();
            $('#button-reset-provider').click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function editProvider(id){
    sendAjax("/compras/carregar-fornecedor", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#provider_id").val(callback.provider_id);
            $("#category").val(callback.provider_fk_category);
            $("#cnpj").val(callback.provider_cnpj);
            $("#name").val(callback.provider_name);
            $("#email").val(callback.provider_email);
            $("#contact").val(callback.provider_contact);
            $("#cellphone").val(callback.provider_cell);
            $("#others").val(callback.provider_others);
            $("#sellers").val(callback.provider_fk_seller);
            $("html, body").animate({scrollTop: 0});
        }
    });
}

$("#searchCategory").change(function (){
    let search = $(this).val();
    $('#table-providers').DataTable().destroy();
    $("#table-providers").DataTable({
        ajax: {
            url: URL + '/tabelas/fornecedores',
            data: {search : search},
            type: 'POST'
        },
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        }
    });
});

$("#table-categorias").DataTable({
    ajax: {
        url: URL + '/tabelas/vendedor-categoria',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

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
            $('#table-categorias').DataTable().ajax.reload();
            cleanCategory();
            reloadCategory();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function reloadCategory(){
    const category = $("#category");
    const searchCategory = $("#searchCategory");
    sendAjax("/compras/listar-categoria-fornecedor", {"id":"1"}, function (callback) {
        if (callback.erro) {
            category.html("<option>Escolha uma categoria</option>");
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            if (callback.data) {
                category.html("");
                callback.data.forEach(function (item) {
                    category.append("<option value='" + item.category_id + "'>" + item.category_name + "</option>")
                });

                searchCategory.html("");
                callback.data.forEach(function (item) {
                    searchCategory.append("<option value='" + item.category_id + "'>" + item.category_name + "</option>")
                });
            }
        }
    });
}

function cleanCategory(){
    $("#id_category").val("");
    $("#categoryName").val("");
}
function editCategory(id){
    sendAjax("/compras/carregar-categoria-fornecedor", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#id_category").val(callback.category_id);
            $("#categoryName").val(callback.category_name);
            $("html, body").animate({scrollTop: 0});
        }
    });
}

$("#table-vendedor").DataTable({
    ajax: {
        url: URL + '/tabelas/vendedor-fornecedor',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

$("#new-seller-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#seller-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-vendedor').DataTable().ajax.reload();
            cleanSeller();
            reloadSeller();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function reloadSeller(){
    const sellers = $("#sellers");
    sendAjax("/compras/listar-vendedor-fornecedor", {"id":"1"}, function (callback) {
        if (callback.erro) {
            sellers.html("<option>Escolha uma categoria</option>");
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            if (callback.data) {
                sellers.html("");
                callback.data.forEach(function (item) {
                    sellers.append("<option value='" + item.seller_id + "'>" + item.seller_name + "</option>")
                });
            }
        }
    });
}


function cleanSeller(){
    $("#id_seller").val("");
    $("#sellerName").val("");
}
function editSeller(id){
    sendAjax("/compras/carregar-vendedor-fornecedor", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#id_seller").val(callback.seller_id);
            $("#sellerName").val(callback.seller_name);
            $("html, body").animate({scrollTop: 0});
        }
    });
}