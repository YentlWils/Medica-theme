var $ = jQuery;
var calendarWidgetLink = ".calendar-widget__link a";
var calendarWidget = ".calendar-widget";
var calendarRow = ".calendar-widget__row";

$(document).ready(function(){
  $(calendarWidgetLink).hover(
    // Hover in
    function(e) {
      // Todo bug when slide over title
      let widgetElement = $(e.currentTarget).closest(calendarWidget);
      let widgetRow = $(e.currentTarget).closest(calendarRow);
      let backgroundImg = widgetElement.attr('data-bg-img');

      widgetRow.css("background-image", "url(" + backgroundImg + ")");

    },
    // Hover out
    function(e) {

      let widgetRow = $(e.currentTarget).closest(calendarRow);
      widgetRow.removeAttr("style");

    }
  );
});
