var $ = jQuery;
var calendarWidget = ".calendar-widget";
var calendarRow = ".calendar-widget__row";

$(document).ready(function(){
  $(calendarWidget).hover(
    // Hover in
    function(e) {
      // Todo bug when slide over title
      let element = $(e.srcElement);
      let backgroundImg = element.attr('data-bg-img');

      $(calendarRow).css("background-image", "url(" + backgroundImg + ")");

    },
    // Hover out
    function(e) {

      //$(calendarRow).css("background-image", "none");

    }
  );
});
