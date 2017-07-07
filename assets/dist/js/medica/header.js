var $ = jQuery;
var slidingClass = "medica-carousel--sliding";
var slideActiveClass = "medica-carousel__item--activate";

$(document).ready(function () {
  var owl = $('.medica-carousel__holder.owl-carousel');

  owl.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 10000,
    autoplayHoverPause: false,
    animateIn: 'fadeIn',
    animateOut: 'medicaFadeOut',
    mouseDrag: false,
    touchDrag: false,
    pullDrag: false,
    freeDrag: false,
    dotsContainer: ".medica-carousel__dots",
    responsive: {
      0: {
        dots: false
      },
      768: {
        dots: true
      }
    },
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

  $('.medica-carousel').parallax({
    speed: 0.6
  });
});