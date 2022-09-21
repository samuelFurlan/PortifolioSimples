$("#ads").addClass("active");

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
    $("#divPrincipal").load(URL + "/cliente/fragmento-ads", data);
}

function modalPublication(id_publication) {
    //$("#publication").modal("show");
}

function changeStatus(id) {
    sendAjax("/cliente/ads-aprovado", {"id_ads": id}, function (callback) {
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
    let copyGoogle = $("#copyGoogle" + id).val();
    let head = $("#head" + id).val();
    let target = $("#target" + id).val();
    let link = $("#link" + id).val();
    let data = {
        copyInsta: copyInsta,
        copyFace: copyFace,
        copyGoogle: copyGoogle,
        head: head,
        target: target,
        link: link,
        id_ads: id
    }
    sendAjax("/cliente/atualizar-ads", data, function (callback) {
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
                $("#divCopy" + id).children("#divTarget").html(target.replace(/\n/g, '<br/>'));
                $("#divCopy" + id).children("#divLink").html(link.replace(/\n/g, '<br/>'));
                $("#divCopy" + id).children("#divGoogle").html(copyGoogle.replace(/\n/g, '<br/>'));
            }
        }
    });
}
