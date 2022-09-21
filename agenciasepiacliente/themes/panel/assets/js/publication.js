//Var controllers
const forms = $("#publication-forms");

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
    next(selectClient.val(), start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
});

//Var controllers

$("#publi").addClass("active");

function validateForms() {
    let form_data = new FormData();
    let field;
    for (let i = 0; i < 3; i++) {
        field = $("#" + forms[0][i].name);
        if (field.val() === "") {
            field.addClass("is-invalid").focus();
            return false;
        } else {
            field.removeClass("is-invalid");
        }
    }

    for (let i = 0; i < 8; i++) {
        field = $("#" + forms[0][i].name);
        form_data.append(forms[0][i].name, field.val());
    }

    for (let $i = 0; $i < archive.prop('files').length; $i++) {
        form_data.append("archive[" + $i + "]", archive.prop('files')[$i]);
    }

    for ($i = 0; $i < othersArchive.prop('files').length; $i++) {
        form_data.append("othersArchive[" + $i + "]", othersArchive.prop('files')[$i]);
    }
    let id_publication = $("#publicationId");
    if (id_publication.length) {
        form_data.append("idPublication", id_publication.val());
    }
    return form_data;
}

forms.submit(function (e) {
    e.preventDefault();
    let values = validateForms();
    if (!values) {
        return false;
    }
    let bnt = $("#btnSubmit");
    bnt.prop('disabled', true).html("<span class='spinner-border' role='status' aria-hidden='true'></span>");
    $.ajax({
        url: forms.attr("action"),
        data: values,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        dataType: "json",
        success: function (callback) {
            bnt.html("Salvar").prop('disabled', false);
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else if (callback.success === 200) {
                returnMessage("Salvo com sucesso!");
                btnReset.click();
                next(selectClient.val());
            }
        }
    });
});

btnReset.click(function (e) {
    e.preventDefault();
    $("#datePost").val("");
    $("#timePost").val("");
    $("#headPost").val("");
    $("#copyInsta").val("");
    $("#copyFace").val("");
    fragmentControlSlide(1);
    fragmentCarousel(1);
    $("#publicationId").remove();
});

function fragmentEdit(index, id_item, checked, date_item, time_item, type_item, head_item, insta_item, face_item, imagesOthers, authorized = "red", edited, liEdited, changed) {
    let css = " display: block;" +
        "        padding: 2px 5px;" +
        "        text-decoration: none;" +
        "        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;";
    let html =
        "<div class='col-4' id='divFade" + index + "'>" +
        "   <div class='card border'>" +
        "       <div class='card-content'>" +
        "           <div class='card-body'>" +
        "               <div class='row'>" +
        "                   <div class='col-10'>" +
        "                       <a class='link-primary' href='#' onclick='edit(" + id_item + ");return false;'>" +
        "                           <i class='bi bi-pen-fill'></i></a>" +
        "                       <a class='link-danger' href='#' onclick='deleteItem(" + id_item + "," + index + ");return false;'>" +
        "                           <i class='bi bi-trash-fill'></i></a>" +
        "                   </div>" +
        "                   <div class='col-2'>" +
        "                       <div class='form-check form-switch'>" +
        "                           <input class='form-check-input' type='checkbox'" + checked +
        "                               onclick='changeStatus(" + id_item + ");'>" +
        "                       </div>" +
        "                   </div>" +
        "               </div>" +
        "               <h5 class='card-title' style='font-size: 14px;'><i class='bi bi-calendar-fill'></i> " + date_item + " - " + time_item +
        "                   | " + type_item + " <i class='bi bi-star-fill' style='color: " + authorized + "'></i> " + edited + "</h5>" +
        "               <ul class='nav nav-tabs' id='myTab' role='tablist' style=' font-size: 10px;'>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-home-tab' data-bs-toggle='pill'" +
        "                           href='#divHead" + index + "' role='tab' aria-controls='v-pills-home'" +
        "                           aria-selected='false' style='" + css + "'>Head</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divInsta" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false' style='" + css + "'>Insta</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divFace" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false' style='" + css + "'>Face</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divOutros" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false' style='" + css + "'>Outros Arquivos</a>" +
        "                   </li>" +
        "                   <li class='nav-item " + liEdited + "' role='presentation' style='display: none'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divEdited" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false' style='" + css + "'>Mostrar Editado</a>" +
        "                   </li>" +
        "               </ul>" +
        "               <div class='tab-content' id='v-pills-tabContent'>" +
        "                   <div class='tab-pane fade' id='divHead" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-home-tab'>" +
        "                       <p>" + head_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divInsta" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + insta_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divFace" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + face_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divOutros" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + imagesOthers + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divEdited" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p> Head: <br/>" + changed.head_change + "</p>" +
        "                       <p> Insta: <br/>" + changed.insta_change + "</p>" +
        "                       <p> Face: <br/>" + changed.face_change + "</p>" +
        "                   </div>" +
        "               </div>" +
        "           </div>" +
        "           <div id='divPreview" + index + "' class='carousel slide' data-ride='carousel'>" +
        "               <div class='carousel-inner' id='divCarousel" + index + "'></div>" +
        "               <div id='controlSlide" + index + "'></div>" +
        "           </div>" +
        "       </div>" +
        "   </div>" +
        "</div>";
    return html;
}

function next(id, startDate = "", endDate = "") {
    $("#nextPublication").html("");
    sendAjax("/painel/todas-publicacoes", {
        "clientId": id,
        "startDate": startDate,
        "endDate": endDate
    }, function (callback) {
        if (callback) {
            for (let i = 0; i < callback.length; i++) {
                let imagesOthers = "";
                let checked = "";
                let authorized = "red";
                let archives = "";
                let edited = "";
                let liEdited = "";
                let changed = "";
                if (callback[i].status_publication !== "0") {
                    checked = "checked";
                }
                if (callback[i].status_publication == "2") {
                    authorized = "gold";
                }

                if (callback[i].edited == true) {
                    edited = "<i class='bi bi-chat-dots-fill text-danger copyEdited' style='display:none;'></i>";
                    liEdited = "liEdited";
                    changed = callback[i].changed;
                }
                let head_publication = callback[i].head_publication ? callback[i].head_publication.replace(/\n/g, '<br/>') : "";
                let copyInsta_publication = callback[i].copyInsta_publication ? callback[i].copyInsta_publication.replace(/\n/g, '<br/>') : "";
                let copyFace_publication = callback[i].copyFace_publication ? callback[i].copyFace_publication.replace(/\n/g, '<br/>') : "";
                if (callback[i].othersArchives_publication !== null) {
                    imagesOthers = otherImages(callback[i].type_publication, callback[i].othersArchives_publication);
                }
                let html = fragmentEdit(i,
                    callback[i].id_publication,
                    checked,
                    callback[i].date_publication,
                    callback[i].time_publication,
                    callback[i].type_publication,
                    head_publication,
                    copyInsta_publication,
                    copyFace_publication,
                    imagesOthers,
                    authorized,
                    edited,
                    liEdited,
                    changed);
                $("#nextPublication").append(html);
                if (callback[i].type_publication === "Galeria") {
                    archives = callback[i].archives_publication;
                    let target = $("#controlSlide" + i);
                    fragmentControlSlide(0, target, "divPreview" + i)
                } else {
                    archives = [callback[i].archives_publication];
                }
                if (callback[i].archives_publication !== null) {
                    let target = $("#divCarousel" + i);
                    fragmentCarousel(0, target, archives, callback[i].type_publication);
                }
            }
        }
    });
}

function edit(idPubli) {
    sendAjax("/painel/editar-publicacoes", {"idPubli": idPubli}, function (callback) {
        if (callback) {
            btnReset.click();
            $("#datePost").val(callback.date_publication);
            $("#timePost").val(callback.time_publication);
            typePost.val(callback.type_publication);
            $("#responsiblePost").val(callback.responsible_publication);
            $("#headPost").val(callback.head_publication);
            $("#copyInsta").val(callback.copyInsta_publication);
            $("#copyFace").val(callback.copyFace_publication);
            let archives = "";
            if (callback.archives_publication !== null) {
                if (callback.type_publication === "Galeria") {
                    archives = callback.archives_publication;
                    fragmentControlSlide(0, controlSlide, "previewArchive");
                } else {
                    archives = [callback.archives_publication];
                }
                fragmentCarousel(0, divCarousel, archives, callback.type_publication);
            }
            if (callback.othersArchives_publication !== null) {
                if (callback.type_publication === "Galeria") {
                    archives = callback.othersArchives_publication;
                    fragmentControlSlide(0, controlSlideOthers, "previewOthersArchive");
                } else {
                    archives = [callback.othersArchives_publication];
                }
                fragmentCarousel(0, divCarouselOthers, archives, callback.type_publication);
            }
            $("#publication-forms").append("<input type='hidden' id='publicationId' name='publicationId' value='" + callback.id_publication + "'>");
            $("html, body").scrollTop(0);
        }
    });
}

function deleteItem(idPubli, index) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Não é possivel reverter esta ação!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Desistir'
    }).then((result) => {
        if (result.isConfirmed) {
            sendAjax("/painel/deletar-publicacao", {"idPubli": idPubli}, function (callback) {
                if (callback) {
                    if (callback.erro) {
                        returnMessage(callback.erro, "FF0000", "8B0000");
                    } else if (callback.success === 200) {
                        $("#divFade" + index).fadeOut();
                        Swal.fire({
                            text: "Deletado com sucesso!",
                            icon: 'success',
                        })
                    }
                }
            });
        }
    })
}

function changeStatus(idPubli) {
    sendAjax("/painel/alterar-publicacao", {"idPubli": idPubli}, function (callback) {
        if (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                returnMessage(callback.success);
            }
        }
    });
}

function openDiv(source, target) {
    if ($("#" + source).is(":checked") === true) {
        $("." + target).show('slow');
    } else {
        $("." + target).hide('slow');
    }
}

$("#copyEdit").change(function () {
    openDiv("copyEdit", "copyEdited");
    openDiv("copyEdit", "liEdited");
});
