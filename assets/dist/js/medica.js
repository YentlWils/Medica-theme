function showStep(e){var a="contact-widget__section--active",t=$("#contact-widget--sep-"+e);$("."+a).removeClass(a),t.addClass(a)}function initMap(){map=new google.maps.Map(document.getElementById("map"),{zoom:4,scrollwheel:!1,maxZoom:15,navigationControl:!1,mapTypeControl:!1,scaleControl:!1,draggable:!1,styles:[{featureType:"all",elementType:"labels.text.fill",stylers:[{saturation:36},{color:"#333333"},{lightness:40}]},{featureType:"all",elementType:"labels.text.stroke",stylers:[{visibility:"on"},{color:"#ffffff"},{lightness:16}]},{featureType:"all",elementType:"labels.icon",stylers:[{visibility:"off"}]},{featureType:"administrative",elementType:"all",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"geometry",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"geometry.fill",stylers:[{color:"#fefefe"},{lightness:20}]},{featureType:"administrative",elementType:"geometry.stroke",stylers:[{color:"#fefefe"},{lightness:17},{weight:1.2}]},{featureType:"administrative",elementType:"labels",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"labels.text",stylers:[{hue:"#ff0000"}]},{featureType:"administrative",elementType:"labels.text.fill",stylers:[{color:"#94335c"}]},{featureType:"administrative",elementType:"labels.text.stroke",stylers:[{hue:"#ff0000"}]},{featureType:"landscape",elementType:"geometry",stylers:[{color:"#f5f5f5"},{lightness:20}]},{featureType:"poi",elementType:"geometry",stylers:[{color:"#f5f5f5"},{lightness:21}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#dedede"},{lightness:21}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{color:"#ffffff"},{lightness:17}]},{featureType:"road.highway",elementType:"geometry.stroke",stylers:[{color:"#ffffff"},{lightness:29},{weight:.2}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#ffffff"},{lightness:18}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#ffffff"},{lightness:16}]},{featureType:"transit",elementType:"geometry",stylers:[{color:"#f2f2f2"},{lightness:19}]},{featureType:"water",elementType:"geometry",stylers:[{color:"#e9e9e9"},{lightness:17}]}]}),function(){var e={coords:[1,1,1,20,18,20,18,1],type:"poly"},a=0;_.forEach(medicaMarkers,function(t,l){var s=0==a++?medicaMapIcon:medicaMapIconInactive;gmapsMarkers[l]=new google.maps.Marker({position:{lat:t.lat,lng:t.lng},map:map,icon:getIcon(s),shape:e,title:l})});var t=new google.maps.LatLng(medicaMarkers[Object.keys(medicaMarkers)[0]].lat,medicaMarkers[Object.keys(medicaMarkers)[0]].lng);map.setCenter(t),map.setZoom(15)}()}function getIcon(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:medicaMapIcon,e={url:e,size:new google.maps.Size(22,22),origin:new google.maps.Point(0,0),anchor:new google.maps.Point(11,11)};return e}var $=jQuery,calendarWidgetLink=".calendar-widget__link a",calendarWidget=".calendar-widget",calendarRow=".calendar-widget__row";$(document).ready(function(){$(calendarWidgetLink).hover(function(e){var a=$(e.currentTarget).closest(calendarWidget),t=$(e.currentTarget).closest(calendarRow),l=a.attr("data-bg-img");t.css("background-image","url("+l+")")},function(e){$(e.currentTarget).closest(calendarRow).removeAttr("style")})});var $=jQuery,$=jQuery,slidingClass="medica-carousel--sliding",slideActiveClass="medica-carousel__item--activate";$(document).ready(function(){var e=$(".medica-carousel__holder.owl-carousel");e.owlCarousel({items:1,loop:!0,autoplay:!0,autoplayTimeout:1e4,autoplayHoverPause:!1,animateIn:"fadeIn",animateOut:"medicaFadeOut",mouseDrag:!1,touchDrag:!1,pullDrag:!1,freeDrag:!1,responsive:{0:{dots:!1},768:{dots:!0}},onInitialized:function(){$(".owl-item.active").addClass(slideActiveClass)}}),e.on("translate.owl.carousel",function(){$(".medica-carousel").addClass(slidingClass)}),e.on("translated.owl.carousel",function(){$(".medica-carousel").removeClass(slidingClass),$(".owl-item."+slideActiveClass).removeClass(slideActiveClass),$(".owl-item.active").addClass(slideActiveClass)}),$(".medica-carousel").parallax({speed:.6})});var $=jQuery,map=null,gmapsMarkers={};$(document).on("click",".medica-map__poi:not(a)",function(e){var a=$(this),t=a.attr("data-marker"),l=medicaMarkers[t],s=new google.maps.LatLng(l.lat,l.lng);map.panTo(s),_.forEach(gmapsMarkers,function(e,a){"use strict";e.setIcon(getIcon(medicaMapIconInactive))}),gmapsMarkers[t].setIcon(getIcon());var r="medica-map__poi--active";$("."+r).removeClass(r),a.addClass(r)});var $=jQuery;$(document).ready(function(){$("#nav-menu").click(function(e){e.preventDefault(),$(this).toggleClass("open"),$("#header").toggleClass("navbar--menu-open")})});var $=jQuery;$(document).ready(function(){function e(){var e=window.pageYOffset;0<e?a.add():0==e&&a.remove()}var a={flagAdd:!0,scrollingClass:"scrolling-class",elements:[],init:function(e){this.elements=e},add:function(){if(this.flagAdd){for(var e=0;e<this.elements.length;e++)document.getElementById(this.elements[e]).className+=" "+this.scrollingClass;this.flagAdd=!1}},remove:function(){for(var e=0;e<this.elements.length;e++){var a=new RegExp("(?:^|\\s)"+this.scrollingClass+"(?!\\S)");document.getElementById(this.elements[e]).className=document.getElementById(this.elements[e]).className.replace(a,"")}this.flagAdd=!0}};a.init(["header","header-container","brand","main-navigation"]),window.onscroll=function(a){e()},e()});var $=jQuery;$(document).ready(function(){$(".medica-workgroup__holder.owl-carousel").owlCarousel({items:1,mouseDrag:!1,touchDrag:!1,pullDrag:!1,freeDrag:!1,autoplayHoverPause:!1,loop:!0,autoplay:!0,autoplayTimeout:7e3,animateIn:"fadeIn",animateOut:"fadeOut",autoHeight:!0})});
//# sourceMappingURL=medica.js.map
