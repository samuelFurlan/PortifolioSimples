const URL = "http://192.168.0.3:8080/abamolde/abamolde";

//Dispara requisição Ajax
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

//Habilita marcação menu lateral
function sideMenu(firt_level, sub_menu = false, second_level = "") {
    let requests = $("#" + firt_level);
    requests.addClass("active");
    if (sub_menu) {
        requests.children("ul").addClass("active");
        $("#" + second_level).addClass("active");
    }
}

$(".inProgress").click(function (e){
    e.preventDefault();
    Swal.fire(
        'Ops!',
        'Em desenvolvimento, aguarde!',
        'info'
    );
    return false;
});