sideMenu("purchases", true, "purchase_status");

function viewBudget(id) {
    let ul = $("#budget-list");
    ul.html("");
    sendAjax("/compras/carregar-orcamento", {id: id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            let list = callback.budget;
            for (let i = 0; i < list.length; i++) {
                ul.append("<li><a target='_blank' href='"+list[i].link+"'>"+list[i].name+"</a></li>")
            }
        }
    });
    $("#budget-modal").modal("show");
}