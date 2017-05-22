var $ = jQuery;

$(document).ready(function(){
  $('#nav-menu').click(function(){
    $(this).toggleClass('open');
    $("#header").toggleClass('menu-open');
  });
});