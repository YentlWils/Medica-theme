var $ = jQuery;
var calendarWidget = ".calendar-widget";
var calendarRow = ".calendar-widget__row";

$(document).ready(function () {
  $(calendarWidget).hover(function (e) {
    var element = $(e.currentTarget);
    var backgroundImg = element.attr('data-bg-img');

    $(calendarRow).css("background-image", "url(" + backgroundImg + ")");
  }, function (e) {

    $(calendarRow).removeAttr("style");
  });
});