$(window).on("load", function () {
	"use strict";
	
	$(".spinner").fadeOut(1500, function () {
		$(".loading").fadeOut(1000);
	});
	$("body").css("overflow", "auto");
});