jQuery( document ).ready(function( $ ) {


	"use strict";


        // Page loading animation

        $("#preloader").animate({
            'opacity': '0'
        }, 600, function(){
            setTimeout(function(){
                $("#preloader").css("visibility", "hidden").fadeOut();
            }, 300);
        });
        

        $(window).scroll(function() {
          var scroll = $(window).scrollTop();
          var box = $('.header-text').height();
          var header = $('header').height();

          if (scroll >= box - header) {
            $("header").addClass("background-header");
          } else {
            $("header").removeClass("background-header");
          }
        });

        if ($('.owl-clients').length) {
            $('.owl-clients').owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                items: 1,
                margin: 30,
                autoplay: false,
                smartSpeed: 700,
                autoplayTimeout: 6000,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 3,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 30
                    }
                }
            });
        }

        if ($('.owl-banner').length) {
            $('.owl-banner').owlCarousel({
                loop: true,
                nav: true,
                dots: true,
                items: 3,
                margin: 10,
                autoplay: true,
                smartSpeed: 700,
                autoplayHoverPause:true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                      items: 1,
                      margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 1,
                        margin: 10
                    },
                    992: {
                      items: 2,
                      margin: 10
                    }
                }
            });
        }
        
         if ($('.owl-photo').length) {
            $('.owl-photo').owlCarousel({
                loop: true,
                nav: true,
                dots: true,
                items: 1,
                margin: 10,
                autoplay: true,
                smartSpeed: 700,
                autoplayHoverPause:true,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                      items: 1,
                      margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 1,
                        margin: 10
                    },
                    992: {
                      items: 1,
                      margin: 10
                    }
                }
            });
        }
  if ($('.slider').length) {
    $(".slider").owlCarousel({
      loop: false,
      nav: true,
      dots: false,
      items: 1,
      margin: 10,
      autoplay: false,
      smartSpeed: 700,
      navText : ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
      autoplayTimeout: 5000,

      responsive: {
        0: {
          items: 1,
          margin: 0,
          nav: false,
          stagePadding: 40,
        },
        460: {
          items: 1,
          margin: 0,
          nav: false,
          stagePadding: 40,
        },
        576: {
          items: 1,
          margin: 10,
          nav: false,
          stagePadding: 40,
        },
        992: {
          items: 4,
          margin: 10
        }
      },

    });
  }

});


        

 $(function() {
	'use strict';

  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

 });

