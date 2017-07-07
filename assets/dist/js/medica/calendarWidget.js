var $ = jQuery;
var calendarWidgetLink = ".calendar-widget__link a";
var calendarWidget = ".calendar-widget";
var calendarRow = ".calendar-widget__row";

$(document).ready(function () {
  $(calendarWidgetLink).hover(function (e) {
    var widgetElement = $(e.currentTarget).closest(calendarWidget);
    var widgetRow = $(e.currentTarget).closest(calendarRow);
    var backgroundImg = widgetElement.attr('data-bg-img');

    widgetRow.css("background-image", "url(" + backgroundImg + ")");
  }, function (e) {

    var widgetRow = $(e.currentTarget).closest(calendarRow);
    widgetRow.removeAttr("style");
  });
});