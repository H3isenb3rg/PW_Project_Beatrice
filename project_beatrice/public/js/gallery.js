function resizeCarousel(item) {
    if ($(window).height() > $(window).width()) {
        $(item).height(0.3 * $(window).height())
    } else {
        $(item).height(0.6 * $(window).height())
    }
}

function checkImgUpload(lang) {
    if ($("#img").val() != "") {
        $('form[name=reservation]').submit();
        return
    }

    
}

$(document).ready(function () {

    $(".carousel-inner .item").each(function (index) {
        resizeCarousel(this);
    });

    $(window).resize(function () {
        $(".carousel-inner .item").each(function (index) {
            resizeCarousel(this);
        });
    });
});