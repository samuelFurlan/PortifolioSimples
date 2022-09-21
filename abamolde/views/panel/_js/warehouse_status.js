sideMenu("warehouse", true,"status_warehouse");

$(document).ready( function () {
    $('#table-warehouse').DataTable({
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        },
        "order": [[ 3, 'asc' ]]
    });
} );

function sendTooling(product_id){
    sendAjax("/almoxarifado/carregar-produto-almoxarifado", {"product_id": product_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.category_erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#id_product").val(callback.product_id);
            $("#codeProduct").val(callback.product_code);
            $("#nameProduct").val(callback.product_name);
            $("#makerProduct").val(callback.product_maker);
            $("#modelProduct").val(callback.product_model);
            $("#currentProduct").val(callback.product_current);
            $("#link-tooling-modal").modal("show");
        }
    });

}

$("#qtdeSent").keyup(function (){
    let qtde = $(this).val();
    $("#groupSerie").html("");
    if (qtde != ""){
        if (parseInt(qtde) > parseInt($("#currentProduct").val())){
            returnMessage("Quantidade não pode ser maior que atual!", "FF0000", "8B0000");
            $(this).val("");
        }else{
            for (let i = 0; i < parseInt(qtde); i++){
                $("#groupSerie").append("<div class=\"form-group\" >\n" +
                    "                                            <label for=\"currentProduct\">N° Série</label>\n" +
                    "                                            <input type=\"text\" class=\"form-control\"\n" +
                    "                                                   name=\"serialNumber[]\" required>\n" +
                    "                                        </div>");
            }
        }
    }
});

$("#new-tooling-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    // bnt.prop('disabled', true);
    // bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Retirada").prop('disabled', false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#groupSerie").html("");
            $("#qtdeSent").val("");
            $("#link-tooling-modal").modal("hide");
            returnMessage("Salvo com sucesso!");
        }
    });
});

$("#searchCategory").change(function (){
    let search = $(this).val();
    $('#table-warehouse').DataTable().destroy();
    $("#table-warehouse").DataTable({
        ajax: {
            url: URL + '/tabelas/almoxarifado-pesquisa-categoria',
            data: {search : search},
            type: 'POST'
        },
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        },
        "order": [[ 3, 'asc' ]]
    });
});