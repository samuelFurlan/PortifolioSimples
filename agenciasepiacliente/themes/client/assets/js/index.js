const URL = "http://localhost/agenciasepiacliente";

loadContent();

$("#dateRange").daterangepicker({
    opens: 'left',
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sab"
        ],
        "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
        "firstDay": 1
    }
}, function (start, end, label) {
    loadContent(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
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

$("#showCopy").change(function () {
    openDiv("showCopy", "divCopy");
});

$("#copyEdit").change(function () {
    openDiv("copyEdit", "copyEdited");
});

function editCopy(id) {
    $("#divCopy" + id).hide();
    $("#divCopyedit" + id).show();
}

function openDiv(source, target) {
    if ($("#" + source).is(":checked") === true) {
        $("." + target).show('slow');
    } else {
        $("." + target).hide('slow');
    }
}