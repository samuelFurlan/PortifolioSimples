sideMenu("requests", true,"clients");

$("#table-clients").DataTable({
    ajax: {
        url: URL + '/tabelas/clientes',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});

function changeStatus(client_id, status){
    sendAjax("/status-cliente", {client_id : client_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-clients').DataTable().ajax.reload();
            if (callback.status === "1"){
                returnMessage("Ativado com sucesso!");
            }else{
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}

function viewRequests(client_id){
    var rowCount = $('#table-request >tbody >tr').length;
    if (rowCount > 0){
        $('#table-request').DataTable().destroy();
    }
    $("#table-request").DataTable({
        ajax: {
            url: URL + '/tabelas/pedidos-cliente',
            type: 'POST',
            data: {client_id: client_id}
        },
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        },
        searching: false
    });
    $("#request-modal").modal("show");
}

function viewSellers(client_id){
    var rowCount = $('#table-seller >tbody >tr').length;
    if (rowCount > 0){
        $('#table-seller').DataTable().destroy();
    }

    $("#seller-modal").modal("show");
    $("#table-seller").DataTable({
        ajax: {
            url: URL + '/tabelas/vendedores',
            type: 'POST',
            data: {client_id: client_id, view: true}
        },
        language: {
            url: URL + '/views/assets/vendors/DataTables/pt_br.json'
        },
        searching: false
    });

}