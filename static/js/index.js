"use strict";

$(function () {
	if (!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function () {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};
});

AOS.init();
$(document).ready(function () {
	// $(window).resize(function(event) {
	// 	var chechMenu = document.getElementById('mobile_nav').style.display;
	// 	if (chechMenu == "block" && event.currentTarget.innerWidth >= 1040) {
	// 		$("#mobile_nav").stop().hide("300");
	// 		$('.logo').stop().show()
	// 	}
	// })
	// $('.close_mobile').click(function() {
	// 	$("#mobile_nav").stop().hide('300');
	// 	$('.logo').stop().show()					
	// });
	// $('#mobile_toggle').on('click', function(){
	// 	$('.logo').hide()
	// 	$('#mobile_nav').show('400');
	// });
	$('a[href^="#brand"], a[href^="#main"]').on('click', function (e) {
		e.preventDefault();
		var target = this.hash;
		$target = $(target);
		$('html, body').stop().animate({
			'scrollTop': $target.offset().top + 2
		}, 800, 'swing', function () {
			window.location.hash = target;
		});
	});
	$(".brand-carousel").owlCarousel({
		autoPlay: true,
		slideSpeed: 3000,
		pagination: false,
		navigation: false,
		items: 3
	});

	// $('.bg-image').parallax({imageSrc: '/static/img/bg.jpg'});
	// $('.bg-image').css('backgroundSize', 'cover');
});