/**
 * Created by yentl on 01/07/2017.
 */
jQuery(document).ready(function($)
{
  $(".tfdate").datepicker({
    dateFormat: 'dd-mm-yy',
    showOn: 'both',
    buttonText: "<i class='fa fa-calendar'></i>",
    numberOfMonths: 3

  });
});