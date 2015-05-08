// Global js
$(function($){

  // ## Responsive navigation

  // Add hamburger icon
  $("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu").addClass("responsive-menu").before('<div class="responsive-menu-icon"></div>');

  // Slide mobile menu on click
  $(".responsive-menu-icon").click(function(){
    $(this).next("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu").slideToggle();
  });

  // Close sub menu on window resize
  $(window).resize(function(){
    if(window.innerWidth > 767) {
      $("header .genesis-nav-menu, .nav-primary .genesis-nav-menu, .nav-secondary .genesis-nav-menu, nav .sub-menu").removeAttr("style");
      $(".responsive-menu > .menu-item").removeClass("menu-open");
    }
  });

  // Sub menus
  $(".responsive-menu > .menu-item").click(function(event){
    if (event.target !== this)
    return;
      $(this).find(".sub-menu:first").slideToggle(function() {
      $(this).parent().toggleClass("menu-open");
    });
  });


  // ## Anchor scroll animation duration
  $.localScroll({
    duration: 750
  });

  // ## Sticky Message
  $(document).on("scroll", function(){

    if($(document).scrollTop() > 200){

      $(".sticky-message").fadeIn('fast');

    } else {

      $(".sticky-message").fadeOut('fast');

    }

  });

});