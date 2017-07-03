var $ = jQuery;

$(document).ready(function(){
  var owl = $('.medica-workgroup__holder.owl-carousel');

  owl.owlCarousel({
    items:1,
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    freeDrag: false,
    autoplayHoverPause: false,
    loop:true,
    autoplay:true,
    autoplayTimeout:7000,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoHeight:true

  });
});
