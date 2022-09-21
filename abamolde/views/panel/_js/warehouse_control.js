sideMenu("catalog", true,"products_catalog");

$("#table-unity").DataTable({
    ajax: {
        url: URL + '/tabelas/almoxarifado-unidade',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
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
            $('#table-unity').DataTable().ajax.reload();
            $("#unidade_id").val("");
            $("#unidade").val("");
            reloadUnity();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function editUnity(id){
    sendAjax("/almoxarifado/carregar-unidade", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#unidade_id").val(callback.unity_id);
            $("#unidade").val(callback.unity_name);
            $("html, body").animate({scrollTop: 0});
        }
    });
}

function reloadUnity(){
    const tipo = $("#tipo");
    sendAjax("/almoxarifado/listar-unidade", {"id":"1"}, function (callback) {
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



$("#table-warehouse").DataTable({
    ajax: {
        url: URL + '/tabelas/almoxarifado-produtos',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

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
            $('#table-warehouse').DataTable().ajax.reload();
            $("#btn-reset").click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function changeStatus(product_id, status){
    sendAjax("/almoxarifado/status-produto-almoxarifado", {product_id : product_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-warehouse').DataTable().ajax.reload();
            if (callback.status === "1"){
                returnMessage("Ativado com sucesso!");
            }else{
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}

function editProduct(id){
    $("#btn-reset").click();
    sendAjax("/almoxarifado/editar-produto-almoxarifado", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#almoxarifado_id").val(callback.product_id);
            $("#code").val(callback.product_code);
            $("#product").val(callback.product_name);
            $("#category").val(callback.product_fk_category);
            $("#fabricante").val(callback.product_maker);
            $("#modelo").val(callback.product_model);
            $("#tipo").val(callback.product_fk_unity);
            $("#estoqueMin").val(callback.product_min);
            $("#estoqueMax").val(callback.product_current);
            $("#alocation").val(callback.product_alocation);
            if (callback.product_control == 1){
                $("#warehouse_control").click();
            }
            if (callback.product_tooling == 1){
                $("#ferramentaria_control").click();
            }

            $("html, body").animate({scrollTop: 0});
        }
    });
}

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