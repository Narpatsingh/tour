$( document ).ready(function() {
  $(window).scroll(function(){
     if ($(window).scrollTop() >= 300) {
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

});