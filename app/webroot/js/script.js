(function($)
{
	"use strict";
	
	
	//jQuery("#packages owl-carousel .owl-controls .owl-nav .owl-prev").css('display', 'block');
	//========================= preloader ================
	$(window).on('load', function() {
		preloader();
	})

	$('.count').each(function () {
	    $(this).prop('Counter',0).animate({
	        Counter: $(this).text()
	    }, {
	        duration: 5000,
	        easing: 'swing',
	        step: function (now) {
	            $(this).text(Math.ceil(now));
	        }
	    });
	});
	
	//JQuery for page scrolling feature - requires JQuery Easing plugin
	$(document).on('ready', function () {
		$('a.page-scroll').on('click', function(event) {
			$('.nav li').removeClass('active');
			$('li.nav-item').removeClass('active');
			$(this).parent().addClass('active');
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top-75
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});



		$('.single-page-scroll').on('click', function(event) {

			// $(".nav-item").dblclick();
			$('.nav li').removeClass('active');
			$('li.nav-item').removeClass('active');
			$(this).parent().addClass('active');

				var $anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top-100
				}, 1500, 'easeInOutExpo');
				event.preventDefault();
		});
		 
		$('#page-top').scrollspy({ 
			target: '.navbar-collapse',
			offset: 77
		}) 
		$(".navbar-nav li a").on('click', function(event) {
			$(".navbar-collapse").removeClass('in');
		});
		 
		//============= animation section ============  
		 if($('.wow').length){
			var wow = new WOW(
			  {
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       0,          // distance to the element when triggering the animation (default is 0)
				mobile:       true,       // trigger animations on mobile devices (default is true)
				live:         true       // act on asynchronously loaded content (default is true)
			  }
			);
			wow.init();
		}
		
		//============= Deals and Discount Carousel =====
		
		$("#deals-discounts-carousel").owlCarousel({
			autoplay: false,
			autoplayTimeout:2000,
			margin:30,
			nav: false,
			smartSpeed:1000,
			dots:false,
			autoplayHoverPause:true,
			loop:true,
			responsiveClass: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  600: {
				items: 2,
			  },
			  1000: {
				items: 3,
			  }
			}
		 });

		$("#packages-carousel").owlCarousel({
			autoplay: true,
			autoplayTimeout:2000,
			margin:30,
			nav: true,
			smartSpeed:1000,
			dots:false,
			autoplayHoverPause:true,
			loop:true,
			responsiveClass: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  600: {
				items: 2,
			  },
			  1000: {
				items: 3,
			  }
			}
		 });

		$("#blogs-carousel").owlCarousel({
			autoplay: true,
			autoplayTimeout:2000,
			margin:30,
			nav: true,
			smartSpeed:1000,
			dots:false,
			autoplayHoverPause:true,
			loop:true,
			responsiveClass: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  600: {
				items: 2,
			  },
			  1000: {
				items: 3,
			  }
			}
		 });

		$('.owl-nav').find('.owl-prev').addClass('control').html('<i class="fa fa-long-arrow-left"></i>');
		$('.owl-nav').find('.owl-next').addClass('control').html('<i class="fa fa-long-arrow-right"></i>');
		
		//===================== Datepicker ================
		$( ".date_pic" ).datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format: 'mm/dd/yyyy'
		});
		
		
		//===================== Testimonials Carousel =====
		
		$("#testimonial-carousel").owlCarousel({
			autoplay: true,
			autoplayTimeout:2000,
			margin:0,
			nav: false,
			smartSpeed:1200,
			dots:true,
			autoplayHoverPause:true,
			loop:true,
			responsiveClass: true,
			responsive: {
			  0: {
				items: 1,
			  },
			  600: {
				items: 1,
			  },
			  1000: {
				items: 1,
			  }
			}
		 });
		
		
		//============= Portfolio section ============ 
		
		$('.gallery-item').mixitup({
			targetSelector: '.gallery',
			transitionSpeed: 650
		});
		$('a.fancybox').fancybox();
		
		
		//============= Counter section ============ 
		$('.counter').counterUp({
			delay: 10,
			time: 2000
		});
		
		/*============================== Back to top =========================*/
		$(".back-top").hide();
		
		$('.back-top a').on('click', function(event) {
			$('body,html').animate({scrollTop:0},800);
			return false;
		});
		
		//============================ Background Scrolling ===================
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				 
		} else {
			$(window).stellar({
				horizontalScrolling: false,
				responsive: true
			});
		}
		
		 
	});
	
	$(window).on('scroll', function() {
	
	//JQuery to collapse the navbar on scroll
		// if ($(".navbar").offset().top > 50) {
		// 	$(".navbar-fixed-top").addClass("top-nav-collapse");
		// } else {
		// 	$(".navbar-fixed-top").removeClass("top-nav-collapse");
		// }
		
		
	//=================== Back to top ===========================
		if($(this).scrollTop()>150){
			$('.back-top').fadeIn();
		}
		else{
			$('.back-top').fadeOut();
		}
		
		
	});
	
	
	
	
	//============= Preload ============ 
	function preloader(){
		$(".preloaderimg").fadeOut();
		$(".preloader").delay(200).fadeOut("slow").delay(200, function(){
			$(this).remove();
		});
	}
	
	//===================== Slider Caption Animation
	
	function doAnimations( elems ) {
		//Cache the animationend event in a variable
		var animEndEv = 'webkitAnimationEnd animationend';
		
		elems.each(function () {
			var $this = $(this),
				$animationType = $this.data('animation');
			$this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}
	
	//Variables on page load 
	var $myCarousel = $('#package'),
		$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
	
	var $package = $('#package'),
		$firstpackage = $package.find('.item:first').find("[data-animation ^= 'animated']");
	
	var $blog = $('#blog'),
		$firstblog = $blog.find('.item:first').find("[data-animation ^= 'animated']");
		
	//Initialize carousel 
	$myCarousel.carousel();
	$package.carousel();
	$blog.carousel(); 
		
	//Animate captions in first slide on page load 
	doAnimations($firstpackage);
	doAnimations($firstAnimatingElems);
	doAnimations($firstblog);
	
	//Pause carousel  
	$myCarousel.carousel('pause');
	
	
	//Other slides to be animated on carousel slide event 
	$myCarousel.on('slide.bs.carousel', function (e) {
		var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		doAnimations($animatingElems);
	}); 

	// $(".slide").data('owlCarousel').reinit({
	//     touchDrag  : true,
	//     mouseDrag  : true
	// }); 
	
})(jQuery);	
	
