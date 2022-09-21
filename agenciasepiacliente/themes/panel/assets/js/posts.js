//Var controllers
const archive = $("#archive");
const othersArchive = $("#othersArchive");
const divCarousel = $("#divCarousel");
const divCarouselOthers = $("#divCarouselOthers");
const typePost = $("#typePost");
const controlSlide = $("#controlSlide");
const controlSlideOthers = $("#controlSlideOthers");
const btnReset = $("#btnReset");
const selectClient = $("#selectClient");

//Var controllers

function fragmentCarousel(reset = 0, target = null, src = null, type = typePost.val()) {
    if (reset === 1) {
        let html = "<div class='carousel-item active'>" +
            "<img src='" + URL + "/themes/_assets/_images/defaults/upload.webp' class='d-block w-100' alt=''>" +
            "</div>";
        divCarousel.html(html);
        divCarouselOthers.html(html);
        archive.val("");
        othersArchive.val("");
        return false;
    }
    switch (type) {
        case "Imagem":
        case "Galeria":
            target.html("<div class='carousel-item active'>\n" +
                "<img src='" + pathFile(src[0]) + "' class='d-block w-100' alt=''></div>");
            for (let i = 1; i < src.length; i++) {
                target.append("<div class='carousel-item'>\n" +
                    "<img src='" + pathFile(src[i]) + "' class='d-block w-100' alt=''></div>");
            }
            break;
        case "Video":
        case "IGTV":
            target.html("<div class='carousel-item active'>\n" +
                "<video width='100%' controls='controls'>>\n" +
                "   <source src='" + pathFile(src[0]) + "' type='video/mp4'>\n" +
                "</video>" +
                "</div>");
            break;
    }
}

function fragmentControlSlide(reset = 0, target = null, src = null) {
    if (reset === 1) {
        controlSlide.html("");
        controlSlideOthers.html("");
        return false;
    }
    target.html("<a class='carousel-control-prev'\n" +
        "href='#" + src + "' role='button' data-bs-slide='prev'>\n" +
        "<span class='carousel-control-prev-icon' aria-hidden='true'></span>\n" +
        "<span class='visually-hidden'>Previous</span></a>\n" +
        "<a class='carousel-control-next' href='#" + src + "' role='button' data-bs-slide='next'>\n" +
        "<span class='carousel-control-next-icon' aria-hidden='true'></span>\n" +
        "<span class='visually-hidden'>Next</span></a>");
}

function pathFile(src) {
    try {
        return window.URL.createObjectURL(src);
    } catch (e) {
        return URL + src;
    }

}

archive.change(function () {
    fragmentCarousel(0, divCarousel, this.files);
});

othersArchive.change(function () {
    fragmentCarousel(0, divCarouselOthers, this.files);
});

typePost.change(function () {
    fragmentControlSlide(1);
    fragmentCarousel(1);
    switch ($(this).val()) {
        case "Imagem":
            archive.attr("accept", "image/*").removeAttr("multiple");
            othersArchive.attr("accept", "image/*").removeAttr("multiple");
            break;
        case "Galeria":
            archive.attr("accept", "image/*").attr("multiple", true);
            othersArchive.attr("accept", "image/*").attr("multiple", true);
            fragmentControlSlide(0, controlSlide, "previewArchive");
            fragmentControlSlide(0, controlSlideOthers, "previewOthersArchive");
            break;
        case "Video":
        case "IGTV":
            archive.attr("accept", "video/*").removeAttr("multiple");
            othersArchive.attr("accept", "video/*").removeAttr("multiple");
            break;
    }
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

selectClient.change(function () {
    const id = $(this).val();
    sendAjax("/painel/editar-cliente", {"clientId": id}, function (callback) {
        if (callback) {
            $("#previewImage").attr('src', URL + callback.previewImage);
            $("#clientNameLabel").html(callback.clientName);
            $("#clientUserLabel").html("@" + callback.userClient);
            next(id);
            $("#dateSearch").show();
            btnReset.click();
        }
    });
});

function otherImages(type, archive) {
    switch (type) {
        case "Imagem":
            return "<img src='" + URL + archive + "' class='d-block w-100' alt=''/>";
        case "Galeria":
            let returnImage = "<img src='" + URL + archive[0] + "' class='d-block w-100' alt=''/>";
            for (let i = 1; i < archive.length; i++) {
                returnImage = returnImage +
                    "<img src='" + URL + archive[i] + "' class='d-block w-100' alt=''/>";
            }
            return returnImage;
        case "Video":
        case "IGTV":
            return "<iframe class='d-block w-100' src='" + URL + archive + "' >";
    }
}