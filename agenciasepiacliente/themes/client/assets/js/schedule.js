function generateCalendar(events = null) {
    var calendarEl = document.getElementById('calendar');

    calendarEl.innerHTML = "";

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        locale: 'pt-br',
        eventClick: function (info) {
            openModal(info.event.id);
        }
    });

    if (events !== null) {
        for (let i = 0; i < events.length; i++) {
            calendar.addEvent({
                id: events[i].id_publication,
                title: events[i].title_publication,
                start: events[i].date_publication
            });
        }
    }
    calendar.render();
}

function loadContent(){
    $.ajax({
        url: URL + '/cliente/agenda-cliente',
        data: {},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            if (callback.erro) {
                generateCalendar();
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                generateCalendar(callback);
            }
        }
    });
}


function openModal(id_publication) {
    $.ajax({
        url: URL + '/cliente/editar-publicacoes',
        data: {idPubli: id_publication},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            const divCarousel = $("#divCarousel");
            let date = callback.date_publication.split("-");
            date = date[2] + "/" + date[1] + "/" + date[0];
            $("#datePost").html(date + " -  " + callback.time_publication.substr(0, 5) + "h")
            $("#copyInsta").html(callback.copyInsta_publication.replace(/\n/g, '<br/>'));
            if (callback.archives_publication !== null) {
                if (callback.type_publication === "Galeria") {
                    divCarousel.html("<div class='carousel-item active'>\n" +
                        "<img src='" + URL + callback.archives_publication[0] + "'" +
                        "class='d-block w-100'>" +
                        "</div>");
                    for ($i = 1; $i < callback.archives_publication.length; $i++) {
                        divCarousel.append("<div class='carousel-item'>\n" +
                            "<img src='" + URL + callback.archives_publication[i] + "'" +
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
                } else {
                    $("#controlSlide").html("");
                    divCarousel.html("<div class=\"carousel-item active\">\n" +
                        "   <img src=\"" + URL + callback.archives_publication + "\"\n" +
                        "     class=\"d-block w-100\"\n" +
                        "     alt=\"...\">\n" +
                        "</div>");
                }
            } else {
                divCarousel.html("<div class='carousel-item active'>" +
                    "<img src='" + URL + "/themes/_assets/_images/defaults/upload.webp' class='d-block w-100'>" +
                    "</div>");
            }


            $.ajax({
                url: URL + '/cliente/buscar-publicacoes',
                data: {
                    id_publication: id_publication,
                    date_publication: callback.date_publication,
                    time_publication: callback.time_publication
                },
                type: "POST",
                dataType: "json",
                success: function (callback) {
                    if (callback.previousPublication === "") {
                        $("#previousPublicationButton").hide("fast");
                    } else {
                        $("#previousPublicationButton").show("fast");
                        $("#previousPublicationInput").val(callback.previousPublication);
                    }

                    if (callback.nextPublication === "") {
                        $("#nextPublicationButton").hide("fast");
                    } else {
                        $("#nextPublicationButton").show("fast");
                        $("#nextPublicationInput").val(callback.nextPublication);
                    }
                }
            });
            $("#archives").modal("show");
        }
    });
}

const modalContent = $('.modal-content');

$("#previousPublicationButton").click(function () {
    animateModal("animate__backInLeft");
    let id_publication = $("#previousPublicationInput").val();
    openModal(id_publication);
});

$("#nextPublicationButton").click(function () {
    animateModal("animate__backInRight");
    let id_publication = $("#nextPublicationInput").val();
    openModal(id_publication);
});

function animateModal(animation) {
    modalContent.addClass("animate__animated " + animation);
    setTimeout(function () {
        modalContent.removeClass("animate__animated " + animation);
    }, 1000);
}