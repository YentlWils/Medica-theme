function initMap(){var e={lat:-25.363,lng:131.044},t=new google.maps.Map(document.getElementById("map"),{zoom:4,center:e,styles:[{featureType:"all",elementType:"labels.text.fill",stylers:[{saturation:36},{color:"#333333"},{lightness:40}]},{featureType:"all",elementType:"labels.text.stroke",stylers:[{visibility:"on"},{color:"#ffffff"},{lightness:16}]},{featureType:"all",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"administrative",elementType:"all",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"geometry",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"geometry.fill",stylers:[{color:"#fefefe"},{lightness:20}]},{featureType:"administrative",elementType:"geometry.stroke",stylers:[{color:"#fefefe"},{lightness:17},{weight:1.2}]},{featureType:"administrative",elementType:"labels",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"labels.text",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"labels.text.fill",stylers:[{color:"#94335c"}]},{featureType:"administrative",elementType:"labels.text.stroke",stylers:[{hue:"#ff0000"}]},{featureType:"landscape",elementType:"geometry",stylers:[{color:"#f5f5f5"},{lightness:20}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#f5f5f5"},{lightness:21}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#dedede"},{lightness:21}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{color:"#ffffff"},{lightness:17}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#ffffff"},{lightness:29},{weight:.2}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#ffffff"},{lightness:18}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#ffffff"},{lightness:16}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#f2f2f2"},{lightness:19}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#e9e9e9"},{lightness:17}]}]});new google.maps.Marker({position:e,map:t})}var $=jQuery,calendarWidget=".calendar-widget",calendarRow=".calendar-widget__row";$(document).ready(function(){$(calendarWidget).hover(function(e){var t=$(e.currentTarget),l=t.attr("data-bg-img");$(calendarRow).css("background-image","url("+l+")")},function(e){$(calendarRow).removeAttr("style")})});var $=jQuery,slidingClass="medica-carousel--sliding",slideActiveClass="medica-carousel__item--activate";$(document).ready(function(){var e=$(".owl-carousel");e.owlCarousel({items:1,loop:!0,dots:!0,autoplay:!0,autoplayTimeout:1e4,autoplayHoverPause:!1,animateIn:"fadeIn",animateOut:"fadeOut",onInitialized:function(){$(".owl-item.active").addClass(slideActiveClass)}}),e.on("translate.owl.carousel",function(){$(".medica-carousel").addClass(slidingClass)}),e.on("translated.owl.carousel",function(){$(".medica-carousel").removeClass(slidingClass),$(".owl-item."+slideActiveClass).removeClass(slideActiveClass),$(".owl-item.active").addClass(slideActiveClass)})});var $=jQuery,$=jQuery;$(document).ready(function(){$("#nav-menu").click(function(e){e.preventDefault(),$(this).toggleClass("open"),$("#header").toggleClass("navbar--menu-open")})});var $=jQuery;$(document).ready(function(){function e(){var e=window.pageYOffset;0<e?t.add():0==e&&t.remove()}var t={flagAdd:!0,scrollingClass:"scrolling-class",elements:[],init:function(e){this.elements=e},add:function(){if(this.flagAdd){for(var e=0;e<this.elements.length;e++)document.getElementById(this.elements[e]).className+=" "+this.scrollingClass;this.flagAdd=!1}},remove:function(){for(var e=0;e<this.elements.length;e++){var t=new RegExp("(?:^|\\s)"+this.scrollingClass+"(?!\\S)");document.getElementById(this.elements[e]).className=document.getElementById(this.elements[e]).className.replace(t,"")}this.flagAdd=!0}};t.init(["header","header-container","brand","main-navigation"]),window.onscroll=function(t){e()},e()});
//# sourceMappingURL=medica.js.map
