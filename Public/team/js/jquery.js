$(function () {
    "use strict";
    
     (function autoslide() {
        $(".slider .active").each(function () {
            if (!$(this).is(":last-child")) {
                $(this).delay(2000).fadeOut(1500, function () {
                    $(this).removeClass("active").next().addClass("active").fadeIn(3000);
                    autoslide();
                });
            } else {
                $(this).delay(3000).fadeOut(1500, function () {
                    $(this).removeClass("active");
                    $(".slider .container > div:eq(0)").addClass("active").fadeIn(2000);
                    autoslide();
                });
            }
        });
    }());
})