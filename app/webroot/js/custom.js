$( document ).ready(function() {
  $(window).scroll(function(){
     if ($(window).scrollTop() >= 400) {
      $('.detail_inner_nav').addClass('fixed-header_inner');
      
     }else{
        $('.detail_inner_nav').removeClass('fixed-header_inner');
     }
  });


if (document.documentElement.clientWidth > 700) {
  $( "div[rel='mptdash-scrollcontent1']" ).slimScroll( { size: '5px', height:'800px',wheelStep : 10,touchScrollStep : 75 });
  $( "div[rel='mptdash-scrollcontent2']" ).slimScroll( { size: '5px', height:'950px',wheelStep : 10,touchScrollStep : 75 });
  $( "div[rel='mptdash-scrollcontent_gallery']" ).slimScroll( { size: '5px', height:'620px',wheelStep : 10,touchScrollStep : 75 });
}
$( "div[rel='mptdash_scrollcontent_hot_deals']" ).slimScroll( { size: '5px', height:'600px',wheelStep : 10,touchScrollStep : 75 });
    var windowsize = $(window).width();
    if (windowsize < 991) {
       $('.remove_add').removeClass('collapse');
       $('.remove_add').removeClass('navbar-collapse');
    }else{
      $('.remove_add').addClass('navbar-collapse');
      $('.remove_add').addClass('collapse');
    }

  
    if (windowsize < 991) {
      $('.india').on('click', function(event) {
        $('.navbar-collapse').addClass('in');
      });

      $('.user-menu').on('click', function(event) {
        if($(this).find('.dropdown-menu').css('display')=="block"){
          $('.navbar-collapse').addClass('in');
          $(this).find('.dropdown-menu').css('display','none');
        }else{
          $('.navbar-collapse').addClass('in');
          $(this).find('.dropdown-menu').css('display','block');
        }
      });
    }

    if (windowsize > 991) {
      $(".dropdown").hover(            
        function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
          $(this).toggleClass('open');        
        },
        function() {
          $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
          $(this).toggleClass('open');       
      });
    }
  

  $(".Enquiry").click(function(){
      $(".overview_enquiry_popup").css('display','block').animate({right:'20px'});
  });
  $(".close_enquiry").click(function(){
      $(".overview_enquiry_popup").css('display','none');
  });

  $('#ContactAddForm').validate({ 
        rules: {
            'name': {
                required: true,
            },
            'email': {
                required: true,
                email : true
            },
            'message': {
                required: true,
            }
        },
        messages: {
            'first_name': {
                required: "Please enter name.",
            },
            'email': {
                required: "Please enter email.",
                email: "Please enter valid email.",
            },
            'message': {
                required: "Please enter message.",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  $('#customers-testimonials').owlCarousel({
        center: true,
        autoplay: true,
        autoplayTimeout:2000,
        margin:30,
        nav: true,
        smartSpeed:1000,
        dots:true,
        autoplayHoverPause:true,
        loop:true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1170: {
            items: 3
          }
        }
    });

    //============= Portfolio section ============ 
    
    $('.gallery-item').mixitup({
      targetSelector: '.gallery',
      transitionSpeed: 650
    });
    $('a.fancybox').fancybox();

    //============= Blogs Crousel   =============

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

    $("#package-slider").owlCarousel({
        loop: true,
        nav: false,
        pagination:true,
        navigation:false,
        slideSpeed:1000,
        autoplay: true,
        responsive: {
            0: {
              items: 1
            },
            768: {
              items: 2
            },
            1170: {
              items: 3
            }
          }
    }); 

});