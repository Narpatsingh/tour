$( document ).ready(function() {
	$(window).scroll(function(){
		 if ($(window).scrollTop() >= 300) {
		 	$('.detail_inner_nav').addClass('fixed-header_inner');
		 	
		 }else{
		 	  $('.detail_inner_nav').removeClass('fixed-header_inner');
		 }
	});

	  var windowsize = $(window).width();
        if (windowsize < 991) {
        	console.log(windowsize);
             $('.remove_add').removeClass('collapse');
             $('.remove_add').removeClass('navbar-collapse');
        }else{
        	$('.remove_add').addClass('navbar-collapse');
        	$('.remove_add').addClass('collapse');
        }


    
    
    $(".dropdown").hover(            
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
        $(this).toggleClass('open');        
      },
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
        $(this).toggleClass('open');       
      });
  

	$(".Enquiry").click(function(){
	    $(".overview_enquiry_popup").css('display','block').animate({right:'20px'});
	});
	$(".close_enquiry").click(function(){
	    $(".overview_enquiry_popup").css('display','none');
	});


});