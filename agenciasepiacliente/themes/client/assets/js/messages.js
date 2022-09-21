function loadContent(){
    $('#tableMessages').DataTable({
        ajax: {
            url: URL + '/cliente/mensagens',
            type: 'POST',
            error: function (xhr, error, code)
            {
                returnMessage("Erro ao carregar mensagens, entre em contato com o suporte!", "FF0000", "8B0000");
            }
        },
        language: {
            url: URL + '/themes/_assets/_vendors/DataTables/pt_br.json'
        }
    });
}