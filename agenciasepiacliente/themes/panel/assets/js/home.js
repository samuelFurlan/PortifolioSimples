$("#home").addClass("active");

$('#tableHome').DataTable({
    ajax: {
        url: URL + '/tabela/home',
        type: 'POST'
    },
    language: {
        url: URL + '/themes/panel/assets/vendors/DataTables/pt_br.json'
    }
});

function loadClient(id) {
    $.ajax({
        url: URL + "/painel/editar-cliente",
        data: {"clientId": id},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            $(".previewImage").attr('src', URL + callback.previewImage);
            $(".clientUserLabel").html("@" + callback.userClient);
        }
    });
}

function viewArchives(id_publication){
    $.ajax({
        url: URL + '/painel/editar-publicacoes',
        data: {idPubli: id_publication},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            const divCarousel = $("#divCarousel");
            let date = callback.date_publication.split("-");
            date = date[2] +"/"+date[1]+"/"+date[0];
            $("#datePost").html( date+" "+callback.time_publication)
            $("#copyInsta").html(callback.copyInsta_publication.replace(/\n/g, '<br/>'));
            if (callback.archives_publication !== null){
                if(callback.type_publication === "Galeria"){
                    divCarousel.html("<div class='carousel-item active'>\n" +
                        "<img src='" + URL+callback.archives_publication[0] + "'" +
                        "class='d-block w-100'>" +
                        "</div>");
                    for ($i = 1; $i < callback.archives_publication.length; $i++) {
                        divCarousel.append("<div class='carousel-item'>\n" +
                            "<img src='" + URL+callback.archives_publication[i] + "'" +
                            "class='d-block w-100'>" +
                            "</div>");
                    }
                    $("#controlSlide").html("<a class=\"carousel-control-prev\"\n" +
                        "href=\"#previewArchive\"\n" +
                        "role=\"button\"\n" +
                        "data-bs-slide=\"prev\">\n" +
                        "<span class=\"carousel-control-prev-icon\"\n" +
                        "aria-hidden=\"true\"></span>\n" +
                        "<span class=\"visually-hidden\">Previous</span>\n" +
                        "</a>\n" +
                        "<a class=\"carousel-control-next\"\n" +
                        "href=\"#previewArchive\"\n" +
                        "role=\"button\"\n" +
                        "data-bs-slide=\"next\">\n" +
                        "<span class=\"carousel-control-next-icon\"\n" +
                        "aria-hidden=\"true\"></span>\n" +
                        "<span class=\"visually-hidden\">Next</span>\n" +
                        "</a>");
                }else{
                    divCarousel.html("<div class=\"carousel-item active\">\n" +
                        "   <img src=\""+ URL+callback.archives_publication +"\"\n" +
                        "     class=\"d-block w-100\"\n" +
                        "     alt=\"...\">\n" +
                        "</div>");
                }
            }else{
                divCarousel.html("<div class='carousel-item active'>" +
                    "<img src='" + URL + "/themes/_assets/_images/defaults/upload.webp' class='d-block w-100'>" +
                    "</div>");
            }
            loadClient(callback.fk_client);
            $("#archives").modal("show");
        }
    });
}