sideMenu("requests", true, "all_requests");

$("#table-request").DataTable({
    ajax: {
        url: URL + '/tabelas/pedidos',
        type: 'POST'
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});