var $ = jQuery;

function showStep(stepNumber){
  let activeClass = "contact-widget__section--active";
  let nextStep = $("#contact-widget--sep-" + stepNumber);

  $('.' + activeClass).removeClass(activeClass);
  nextStep.addClass(activeClass)

}