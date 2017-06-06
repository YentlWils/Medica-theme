var $ = jQuery;
var slidingClass = "medica-carousel--sliding";
var slideActiveClass = "medica-carousel__item--activate";

$(document).ready(function () {
  var owl = $('.owl-carousel');

  owl.owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    autoplay: true,
    autoplayTimeout: 10000,
    autoplayHoverPause: false,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    onInitialized: function onInitialized() {
      // Give the first active slide the activation class
      $('.owl-item.active').addClass(slideActiveClass);
    }
  });

  // Add the sliding class when the owl animation starts
  owl.on('translate.owl.carousel', function () {
    $('.medica-carousel').addClass(slidingClass);
  });

  // Remove the slinging class when the owl animation ends
  owl.on('translated.owl.carousel', function () {
    // Remove te sliding class
    $('.medica-carousel').removeClass(slidingClass);

    //Remove the actavation class from the previous slide
    $('.owl-item.' + slideActiveClass).removeClass(slideActiveClass);
    // Set the new active slide with the activation class
    $('.owl-item.active').addClass(slideActiveClass);
  });
});