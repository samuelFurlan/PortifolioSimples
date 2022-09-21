$(document).ready(function () {
    setInterval(loadChats, 1000*30);
    setInterval(openMessages, 1000*30);
    loadChats();
    $("#menuMessages").addClass("active");
});
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

function dataFormatada() {
    let data = new Date(),
        dia = String(data.getDate()).padStart(2, '0'),
        mes = String(data.getMonth() + 1).padStart(2, '0'),
        ano = data.getFullYear(),
        hora = data.getHours(),
        minutos = data.getMinutes();
    return [dia, mes, ano].join('/') + ' ' + [hora, minutos].join(':');
}

function loadChats() {
    $("#newMessages").html("");
    sendAjax("/painel/todas-conversas", {}, function (callback) {

        for (let i = 0; i < callback.length; i++) {
            let newMessage = "";
            if (callback[i].status_chat === "1") {
                newMessage = "<p id='notification" + callback[i].fk_client + "' class='font-bold ms-3 mb-0'><i class='bi bi-bell-fill'></i></p>";
            }
            $("#newMessages").append(
                "<tr class='openMessages' onclick='openMessages(" + callback[i].fk_client + ")'>" +
                "   <td class='col-12'>" +
                "       <div class='d-flex align-items-center'>" +
                "           <div class='avatar avatar-md'>" +
                "               <img id='imgClient" + callback[i].fk_client + "' src='" + URL + callback[i].logo_clients + "'" +
                "           </div>" +
                "           <p id='nameClient" + callback[i].fk_client + "' class='ms-3 mb-0'>" + callback[i].name_clients + "</p>" +
                newMessage +
                "       </div>" +
                "   </td>" +
                " </tr>");
        }
    });
}
let id_client_global;
function openMessages(id_client) {
    if(id_client_global === undefined && id_client === undefined){
        return false;
    }else if (id_client_global === undefined && id_client !== undefined ){
        id_client_global = id_client;
    }else if (id_client_global !== undefined && id_client === undefined){
        id_client = id_client_global;
    }else if(id_client_global !== undefined && id_client !== undefined){
        id_client_global = id_client;
    }
$(".chat-content").html("");
    sendAjax("/painel/carregar-conversas", {"id_client": id_client}, function (callback) {
        for (let i = 0; i < callback.length; i++) {
            if (callback[i].client) {
                $(".chat-content").append(
                    "<div class='chat chat-left'>" +
                    "   <div class='chat-body'>" +
                    "       <h6 class='dateSend'>" + callback[i].client.date + "</h6>" +
                    "       <div class='chat-message'>" + callback[i].client.message + "</div>" +
                    "   </div>" +
                    "</div>");
            } else if (callback[i].team) {
                $(".chat-content").append(
                    "<div class='chat chat-right'>" +
                    "   <div class='chat-body'>" +
                    "       <h6 class='dateSend'>" + callback[i].team.date + "</h6>" +
                    "       <div class='chat-message'>" + callback[i].team.message + "</div>" +
                    "   </div>" +
                    "</div>");
            }
        }
        $("#divMessages").show();
        $("#notification"+id_client).hide();
        $("#imgClient").attr('src', $("#imgClient"+id_client).attr('src'));
        $("#nameClient").html($("#nameClient"+id_client).text());
        scrollDown(0);
    });
}

function saveMessage(message) {
    let send = message.trim();
    if (send) {
        let date = dataFormatada();
        sendAjax("/painel/enviar-chat", {"message": send, "date": date, "id_client" : id_client_global}, function (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                $(".chat-content").append(
                    "<div class='chat chat-right'>" +
                    "   <div class='chat-body'>" +
                    "       <h6 class='dateSend'>" + date + "</h6>" +
                    "       <div class='chat-message'>" + send + "</div>" +
                    "   </div>" +
                    "</div>");
                $(".Input_field").val("");
                openMessages();
                scrollDown();
                newMessages();

            }
        });
    }
}

$(".Input_field").on('keypress', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        saveMessage($(this).val());
    }
});

function scrollDown(speed = 1000) {
    $(".chat-start").animate({scrollTop: $(".chat-content").height()}, speed);
}