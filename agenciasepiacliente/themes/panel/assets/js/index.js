const URL = "https://webapp277757.ip-104-237-128-25.cloudezapp.io";
//const URL = "http://localhost/agenciasepiacliente";

//Retorna msg responsiva
function returnMessage(text, color1 = "00b09b", color2 = "96c93d") {
    Toastify({
        text: text,
        duration: 3000,
        close: true,
        gravity: "bottom",
        position: "right",
        backgroundColor: "linear-gradient(to right, #" + color1 + ", #" + color2 + ")",
    }).showToast();
}

setInterval(newMessages, 1000*30);
newMessages();
function newMessages(){
    $.ajax({
        url: URL + "/painel/novas-conversas",
        data: {},
        type: "POST",
        dataType: "json",
        success: function (callback) {
            if (callback.messages === 0){
                $("#newMessagesNotifications").hide();
            }else{
                $("#newMessagesNotifications").show();
                $("#newMessagesNotifications").html(callback.messages);
            }

        }
    });
}