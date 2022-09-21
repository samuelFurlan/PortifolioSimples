//Var controllers
const forms = $("#ads-forms");

//Var controllers

$("#ads").addClass("active");

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

    for (let i = 0; i < 10; i++) {
        field = $("#" + forms[0][i].name);
        form_data.append(forms[0][i].name, field.val());
    }

    for (let $i = 0; $i < archive.prop('files').length; $i++) {
        form_data.append("archive[" + $i + "]", archive.prop('files')[$i]);
    }

    for ($i = 0; $i < othersArchive.prop('files').length; $i++) {
        form_data.append("othersArchive[" + $i + "]", othersArchive.prop('files')[$i]);
    }
    let id_ads = $("#adsId");
    if (id_ads.length) {
        form_data.append("idAds", id_ads.val());
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
    $("#adsId").remove();
});

function fragmentEdit(index, id_item, checked, date_item, time_item, type_item, head_item, taget_item, link_item, insta_item, face_item, google_item, imagesOthers) {
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
        "               <hr>" +
        "               <h5 class='card-title'>Data: " + date_item + " - " + time_item + "</h5>" +
        "               <h5 class='card-title'>Tipo: " + type_item + "</h5>" +
        "               <ul class='nav nav-tabs' id='myTab' role='tablist'>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-home-tab' data-bs-toggle='pill'" +
        "                           href='#divHead" + index + "' role='tab' aria-controls='v-pills-home'" +
        "                           aria-selected='false'>Head</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-home-tab' data-bs-toggle='pill'" +
        "                           href='#divTarget" + index + "' role='tab' aria-controls='v-pills-home'" +
        "                           aria-selected='false'>Público</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-home-tab' data-bs-toggle='pill'" +
        "                           href='#divLink" + index + "' role='tab' aria-controls='v-pills-home'" +
        "                           aria-selected='false'>Link</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divInsta" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false'>Insta</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divFace" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false'>Face</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divGoogle" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false'>Google Ads</a>" +
        "                   </li>" +
        "                   <li class='nav-item' role='presentation'>" +
        "                       <a class='nav-link' id='v-pills-profile-tab' data-bs-toggle='pill'" +
        "                           href='#divOutros" + index + "' role='tab' aria-controls='v-pills-profile'" +
        "                           aria-selected='false'>Outros Arquivos</a>" +
        "                   </li>" +
        "               </ul>" +
        "               <div class='tab-content' id='v-pills-tabContent'>" +
        "                   <div class='tab-pane fade' id='divHead" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-home-tab'>" +
        "                       <p>" + head_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divTarget" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-home-tab'>" +
        "                       <p>" + taget_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divLink" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-home-tab'>" +
        "                       <p>" + link_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divInsta" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + insta_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divFace" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + face_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divGoogle" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + google_item + "</p>" +
        "                   </div>" +
        "                   <div class='tab-pane fade' id='divOutros" + index + "' role='tabpanel'" +
        "                       aria-labelledby='v-pills-profile-tab'>" +
        "                       <p>" + imagesOthers + "</p>" +
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

function next(id) {
    $("#nextAds").html("");
    sendAjax("/painel/todas-anuncios", {"clientId": id}, function (callback) {
        if (callback) {
            for (let i = 0; i < callback.length; i++) {
                let imagesOthers = "";
                let checked = "";
                let archives = "";
                if (callback[i].status_ads !== "0") {
                    checked = "checked";
                }
                let head_ads = callback[i].head_ads ? callback[i].head_ads.replace(/\n/g, '<br/>') : "";
                let target_ads = callback[i].target_ads ? callback[i].target_ads.replace(/\n/g, '<br/>') : "";
                let link_ads = callback[i].link_ads ? callback[i].link_ads.replace(/\n/g, '<br/>') : "";
                let copyInsta_ads = callback[i].copyInsta_ads ? callback[i].copyInsta_ads.replace(/\n/g, '<br/>') : "";
                let copyFace_ads = callback[i].copyFace_ads ? callback[i].copyFace_ads.replace(/\n/g, '<br/>') : "";
                let copyGoogle_ads = callback[i].copyGoogle_ads ? callback[i].copyGoogle_ads.replace(/\n/g, '<br/>') : "";
                if (callback[i].othersArchives_ads !== null) {
                    imagesOthers = otherImages(callback[i].type_ads, callback[i].othersArchives_ads);
                }
                let html = fragmentEdit(i,
                    callback[i].id_ads,
                    checked,
                    callback[i].date_ads,
                    callback[i].time_ads,
                    callback[i].type_ads,
                    head_ads,
                    target_ads,
                    link_ads,
                    copyInsta_ads,
                    copyFace_ads,
                    copyGoogle_ads,
                    imagesOthers);
                $("#nextAds").append(html);
                if (callback[i].type_ads === "Galeria") {
                    archives = callback[i].archives_ads;
                    let target = $("#controlSlide" + i);
                    fragmentControlSlide(0, target, "divPreview" + i)
                } else {
                    archives = [callback[i].archives_ads];
                }
                if (callback[i].archives_ads !== null) {
                    let target = $("#divCarousel" + i);
                    fragmentCarousel(0, target, archives, callback[i].type_ads);
                }
            }
        }
    });
}

function edit(idAds) {
    sendAjax("/painel/editar-anuncio", {"idAds": idAds}, function (callback) {
        if (callback) {
            btnReset.click();
            $("#datePost").val(callback.date_ads);
            $("#timePost").val(callback.time_ads);
            typePost.val(callback.type_ads);
            $("#headPost").val(callback.head_ads);
            $("#target").val(callback.target_ads);
            $("#linkAds").val(callback.link_ads);
            $("#copyInsta").val(callback.copyInsta_ads);
            $("#copyFace").val(callback.copyFace_ads);
            $("#copyGoogle").val(callback.copyGoogle_ads);
            let archives = "";
            if (callback.archives_ads !== null) {
                if (callback.type_ads === "Galeria") {
                    archives = callback.archives_ads;
                    fragmentControlSlide(0, controlSlide, "previewArchive");
                } else {
                    archives = [callback.archives_ads];
                }
                fragmentCarousel(0, divCarousel, archives, callback.type_ads);
            }
            if (callback.othersArchives_ads !== null) {
                if (callback.type_ads === "Galeria") {
                    archives = callback.othersArchives_ads;
                    fragmentControlSlide(0, controlSlideOthers, "previewOthersArchive");
                } else {
                    archives = [callback.othersArchives_ads];
                }
                fragmentCarousel(0, divCarouselOthers, archives, callback.type_ads);
            }
            forms.append("<input type='hidden' id='adsId' name='adsId' value='" + callback.id_ads + "'>");
            $("html, body").scrollTop(0);
        }
    });
}

function deleteItem(idAds, index) {
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
            sendAjax("/painel/deletar-anuncio", {"idAds": idAds}, function (callback) {
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

function changeStatus(idAds) {
    sendAjax("/painel/alterar-anuncio", {"idAds": idAds}, function (callback) {
        if (callback) {
            if (callback.erro) {
                returnMessage(callback.erro, "FF0000", "8B0000");
            } else {
                returnMessage(callback.success);
            }
        }
    });
}