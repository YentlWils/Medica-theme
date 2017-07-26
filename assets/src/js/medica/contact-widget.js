var $ = jQuery;
var is_sending = false;

function showStep(stepNumber){
  let activeClass = "contact-widget__section--active";
  let nextStep = $("#contact-widget--sep-" + stepNumber);

  $('.' + activeClass).removeClass(activeClass);
  nextStep.addClass(activeClass)

}


$('#contact-form__widget').parsley().on('field:validated', function() {
  var ok = $('.parsley-error').length === 0;
  $('.bs-callout-info').toggleClass('hidden', !ok);
  $('.bs-callout-warning').toggleClass('hidden', ok);
})
.on('form:submit', function() {
  if (is_sending) {
    return false;
  }

  var form = $('#contact-form__widget');
  $.ajax({
    url: form.attr('action'),
    type: 'post',
    dataType: 'JSON',
    data: form.serialize(),
    beforeSend: function () {
      is_sending = true;
    },
    error: handleFormError,
    success: function (data) {
      if (data.status === 'success') {

        showStep(3);

      } else {
        handleFormError();
      }
    }
  });

  function handleFormError () {
    is_sending = false;
    showStep(4);
  }

  return false;
});