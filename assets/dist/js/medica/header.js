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
      $('.owl-item.active').addClass(slideActiveClass);
    }
  });

  owl.on('translate.owl.carousel', function () {
    $('.medica-carousel').addClass(slidingClass);
  });

  owl.on('translated.owl.carousel', function () {
    $('.medica-carousel').removeClass(slidingClass);

    $('.owl-item.' + slideActiveClass).removeClass(slideActiveClass);
    $('.owl-item.active').addClass(slideActiveClass);
  });
});