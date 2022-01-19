/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
 import '../scss/main.scss';

 import $ from 'jquery';

 $(window).ready(function() {
  $('.slider').slick({
   infinite: true,
   slidesToShow: 5,
   slidesToScroll: 1,
   speed: 300,
   lazyLoad: 'ondemand',
   autoplay: true,
   autoplaySpeed: 2000,
  }).css('opacity',1);
});