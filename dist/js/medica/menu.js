var $ = jQuery;

$(document).ready(function () {
  $('#nav-menu').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('open');
    $("#header").toggleClass('navbar--menu-open');
  });
});