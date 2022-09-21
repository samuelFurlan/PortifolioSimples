setInterval(loadChat, 1000 * 30);
loadChat();
$("#home").addClass("active");

function sendAjax(path, data, callback) {
    $.ajax({
        url: URL + path,
        data: data,
        type: "POST",
        dataType: "json",
        success: function (data) {
            callback(data);
        }
    });
}

function loadContent(startDate = null, endDate = null) {
    let data = {};
    if (startDate !== null && endDate !== null) {
        data = {
            "startDate": startDate,
            "endDate": endDate,
        }
    }
    $("#divPrincipal").load(URL + "/cliente/fragmento-publicacao", data);
}

function loadChat() {
    $(".Messages_list").html("");
    sendAjax("/cliente/carregar-chat", {}, function (callback) {
        for (let i = 0; i < callback.length; i++) {
            if (callback[i].client) {
                $(".Messages_list").append(
                    "<div class='d-flex justify-content-end mb-1'>" +
                    "   <div class='sender'>" + callback[i].client.message +
                    "   </div>" +
                    "   <h6 class='dateSend'>" + callback[i].client.date + "</h6>" +
                    "</div>");
            } else if (callback[i].team) {
                $(".Messages_list").append(
                    "<div class='d-flex justify-content-start mb-1'>" +
                    "   <div class='recivier'>" + callback[i].team.message +
                    "   </div>" +
                    "   <h6 class='dateSend'>" + callback[i].team.date + "</h6>" +
                    "</div>");
            }
        }
        scrollDown(0);
    });
}

$(".chat_on").click(function () {
    $(".Layout").toggle();
    $(".chat_on").hide("slow");
    scrollDown();
});

$(".chat_close_icon").click(function () {
    $(".Layout").hide();
    $(".chat_on").show("slow");
});

$(".Input_field").on('keypress', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        saveMessage($(this).val());
    }
});
$(".Input_button-send").click(function () {
    saveMessage($(".Input_field").val());
});

function saveMessage(message) {
    let send = message.trim();
    if (send) {
        let date = dataFormatada();
        sendAjax("/cliente/enviar-chat", {"message": send, "date": date}, function (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                $(".Messages_list").append(
                    "<div class='d-flex justify-content-end mb-1'>" +
                    "   <div class='sender'>" + send +
                    "   </div>" +
                    "   <h6 class='dateSend'>" + date + "</h6>" +
                    "</div>");
                $(".Input_field").val("");
                loadChat();
                scrollDown();
            }
        });
    }
}

function scrollDown(speed = 1000) {
    $(".Messages").animate({scrollTop: $(".Messages_list").height()}, speed);
}

function dataFormatada() {
    let data = new Date(),
        dia = String(data.getDate()).padStart(2, '0'),
        mes = String(data.getMonth() + 1).padStart(2, '0'),
        ano = data.getFullYear(),
        hora = data.getHours(),
        minutos = data.getMinutes();
    return [dia, mes, ano].join('/') + ' ' + [hora, minutos].join(':');
}

function modalPublication(id_publication) {
    //$("#publication").modal("show");
}

function changeStatus(id) {
    sendAjax("/cliente/post-aprovado", {"id_publication": id}, function (callback) {
        if (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                returnMessage(callback.success);
            }
        }
    });
}



function saveCopy(id) {
    let copyInsta = $("#copyInsta" + id).val();
    let copyFace = $("#copyFace" + id).val();
    let head = $("#head" + id).val();
    let data = {
        copyInsta: copyInsta,
        copyFace: copyFace,
        head: head,
        id_publication: id
    }
    sendAjax("/cliente/atualizar-copy", data, function (callback) {
        if (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Salvo com sucesso!");
                $("#divCopy" + id).show();
                $("#divCopyedit" + id).hide();
                $("#divCopy" + id).children("#divCopyInsta").html(copyInsta.replace(/\n/g, '<br/>'));
                $("#divCopy" + id).children("#divCopyFace").html(copyFace.replace(/\n/g, '<br/>'));
                $("#divCopy" + id).children("#divCopyHead").html(head.replace(/\n/g, '<br/>'));
            }
        }
    });
}
