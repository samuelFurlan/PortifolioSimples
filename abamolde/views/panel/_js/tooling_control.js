sideMenu("tooling", true,"tooling_control");

$(document).ready( function () {
    $('#table-warehouse').DataTable({
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        },
        "order": [[ 3, 'asc' ]]
    });
} );

$("#table-tooling").DataTable({
    ajax: {
        url: URL + '/tabelas/ferramentaria-produtos',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

$("#new-tooling-form").submit(function (e) {
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
            $('#table-tooling').DataTable().ajax.reload();
            $("#btn-reset").click();
            returnMessage("Salvo com sucesso!");
        }
    });
});

function changeStatus(tooling_id, status){
    sendAjax("/ferramentaria/status-produto-ferramentaria", {tooling_id : tooling_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-tooling').DataTable().ajax.reload();
            if (callback.status === "1"){
                returnMessage("Ativado com sucesso!");
            }else{
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}

function editTooling(id){
    $("#btn-reset").click();
    sendAjax("/ferramentaria/editar-produto-ferramentaria", {id : id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#tooling_id").val(callback.tooling_id);
            $("#code").val(callback.tooling_code);
            $("#name").val(callback.tooling_name);
            $("#condition").val(callback.tooling_usage);
            $("#maker").val(callback.tooling_maker);
            $("#model").val(callback.tooling_model);
            $("html, body").animate({scrollTop: 0});
        }
    });
}

function openObservation(tooling_id){
    sendAjax("/ferramentaria/carregar-observacoes", {tooling_id : tooling_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#observationBody").html("");
            for (let i = 0; i < callback.lista.length; i++){
                $("#observationBody").append(
                    "<div class='col-12'>" +
                    "<small>Data devolução: "+callback.lista[i].entry_date+" " +
                    "- Responsável: "+callback.lista[i].entry_employee+"" +
                    "- N° Pedido: "+callback.lista[i].entry_nf+"" +
                    "- Estado: "+callback.lista[i].entry_usage+"%</small>" +
                    "<p>Observação: "+callback.lista[i].entry_observation+"</p>" +
                    "</div>" +
                    "<hr>");
            }
            $("#link-open-observation").modal("show");
        }
    });
}
function GerarCdigoDeBarras(elementoInput) {
    let configuracao = {
        format: "CODE39",
        lineColor: "#000",
        width: 2,
        height: 100,
        displayValue: true,
    };
    JsBarcode('#barcode', elementoInput, configuracao);
    $("#link-open-barcode").modal("show");

}

