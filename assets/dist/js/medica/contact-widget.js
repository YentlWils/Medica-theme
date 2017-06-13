var $ = jQuery;

function showStep(stepNumber) {
  var activeClass = "contact-widget__section--active";
  var nextStep = $("#contact-widget--sep-" + stepNumber);

  $('.' + activeClass).removeClass(activeClass);
  nextStep.addClass(activeClass);
}