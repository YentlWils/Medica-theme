
jQuery(document).ready(function ($) {
  $(".tfdate").datepicker({
    dateFormat: 'dd-mm-yy',
    showOn: 'both',
    buttonText: "<i class='fa fa-calendar'></i>",
    numberOfMonths: 3

  });
});