/*global $, console, document*/

$(function () {
    "use strict";
    
    
    $(".fixed li").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("html, body").animate({
            scrollTop: $($(this).data("value")).offset().top
        }, 1500);
    });
    
    
    
    
    
    $(window).scroll(function () {
        
        if ($(window).scrollTop() >= $(".institute").offset().top - 200) {
            $(".institute .row > div.cl1").animate({left: "0"}, 2200);
        }
       
        if ($(window).scrollTop() >= $(".institute").offset().top - 200) {
            $(".institute .row > div.cl2").delay(200).animate({left: "0"}, 2000);
        }
      
        if ($(window).scrollTop() >= $(".institute").offset().top - 200) {
            $(".institute .row > div.cl3").delay(400).animate({left: "0"}, 2200);
        }
        
        if ($(window).scrollTop() >= $(".institute").offset().top - 200) {
            $(".institute .row > div.cl4").delay(800).animate({left: "0"}, 1900);
        }
        
        if ($(window).scrollTop() >= $(".news").offset().top - 200) {
            $(".news .row > div").css("transform", "scale(.99)");
        }
        
    });
});

$(window).on("load", function () {
	"use strict";
	
	$(".spinner").fadeOut(1500, function () {
		$(".loading").fadeOut(1000);
	});
	$("body").css("overflow", "auto");
	
});