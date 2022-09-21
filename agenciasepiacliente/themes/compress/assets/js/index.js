//const URL = "https://webapp277757.ip-104-237-128-25.cloudezapp.io";
const URL = "http://localhost/agenciasepiacliente";


let mouseDown = false
const quality = $("#quality");
const archives = $("#archives");
const archivesList = $("#archivesList");
const width = $("#width");
const height = $("#height");
const proportion = $("#proportion");
const noResize = $("#noResize");
const divResize = $("#divResize");

width.mask("0000");
height.mask("0000");

quality.mousedown(function () {
    mouseDown = true;
    updateSlider()
});

quality.mouseup(function () {
    mouseDown = false;
});

function updateSlider() {
    if (mouseDown) {
        // Update the value while the mouse is held down.
        $("#spanValue").text($("#quality").val());
        setTimeout(updateSlider, 50);
    }
}

width.keyup(function () {
    validateSize(width, height);
});

height.keyup(function () {
    validateSize(height, width);
});

function validateSize(changed, target) {
    if (parseInt(changed.val()) > 1920) {
        returnMessage("Tamanho máximo permito 1920 Pixels", "FF0000", "8B0000");
        changed.val(1920)
    }
    if (proportion.is(':checked')) {
        if (changed.val() !== "") {
            target.prop('disabled', true);
        } else {
            target.prop('disabled', false);
        }
    } else {
        target.prop('disabled', false);
    }
}

proportion.change(function () {
    width.val("");
    width.prop('disabled', false);
    height.val("");
    height.prop('disabled', false);
});

noResize.change(function (){
    if (noResize.is(':checked')) {
        divResize.fadeOut();
    } else {
        divResize.fadeIn();
    }
});

archives.change(function (e) {
    archivesList.html("");
    if ($(this)[0].files.length > 10) {
        archives.val("");
        returnMessage("Ops! Permitido apenas 10 imagens de cada vez", "FF0000", "8B0000");
    } else {
        for (let $i = 0; $i < archives.prop('files').length; $i++) {
            archivesList.append("<li class='list-group-item'>" + archives.prop('files')[$i].name + "</li>");
        }
    }
});

function validateForms(){
    let form_data = new FormData();
    for (let $i = 0; $i < archives.prop('files').length; $i++) {
        form_data.append("archive[" + $i + "]", archives.prop('files')[$i]);
    }
    form_data.append("width", width.val());
    form_data.append("height", height.val());
    if (proportion.is(':checked')) {
        form_data.append("proportion", 1);
    } else {
        form_data.append("proportion", 0);
    }

    if (noResize.is(':checked')) {
        form_data.append("noResize", 1);
    } else {
        form_data.append("noResize", 0);
    }

    form_data.append("quality", quality.val());

    return form_data;
}

function clearInputs(){
    proportion.prop("checked", true);
    width.val("");
    height.val("");
    quality.val(70);
    $("#spanValue").text($("#quality").val());
    archives.val("");
    archivesList.html("");
}

$("#sendButton").click(function () {
    let values = validateForms();
    let bnt = $("#sendButton");
    //bnt.prop('disabled', true).html("<span class='spinner-border' role='status' aria-hidden='true'></span>");
    $.ajax({
        url: URL + "/editar-imagens/enviar-imagem",
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        dataType: "json",
        success: function (callback) {
            bnt.html("Enviar").prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                $("#divDownloader").css("display", "block");
                $("#downloaderLink").attr("download", "imagens_editadas.zip");
                $("#downloaderLink").attr("href", callback.file);
                clearInputs();
            }
        }
    });
});

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