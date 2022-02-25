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
 $('#index .slider').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  swipeToSlide:true,
 }).css('opacity',1);
 $('#options main section .slider').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 1,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  swipeToSlide:true,
 }).css('opacity',1);
 $('#options main section .slider img.slick-slide').on('click', function(){
  let index = $(this).data('slick-index');
  let id = $(this).closest("section").attr('id').replace('_slider','');
  let modal = $('.modal.'+id);
  let slider = modal.find('.slider');
  modal.addClass('active');
  if (slider.hasClass('slick-initialized')){
   slider.slick('slickGoTo', index, true);
  } else {
   slider.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    swipeToSlide: true,
    adaptiveHeight: true,
    initialSlide: index,
   });
  }
 });

 $('.modal .close').on('click', function(){
  $(this).parent().removeClass('active');
 });
});