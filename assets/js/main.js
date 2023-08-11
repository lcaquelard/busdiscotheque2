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
 //Mobile phone navigation menu
 $('#hamburger').on('click', function(e){
  $('#mobile_nav').addClass('active');
 });
 $('#mobile_nav .close').on('click', function(e){
  $('#mobile_nav').removeClass('active');
 });
 $('#mobile_nav .droppable .chevron').on('click', function(e){
  const droppable = $(this).parent();
  if (droppable.hasClass('active')) {
   droppable.removeClass('active');
  }else{
   droppable.addClass('active');
  }
 });

 $('video').on('click', function(){
  if (this.paused) {
   $(this).parent().addClass('playing');
   this.play();
  } else {
   $(this).parent().removeClass('playing');
   this.pause();
  }
 });

 $('#index #party.slider').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  swipeToSlide:true,
  variableWidth: true,
  responsive: [
   {
    breakpoint:600,
    settings:{
     slidesToShow:1
    }
   }
  ],
 });

 $('#index #party.slider img.slick-slide').on('click', function(){
  let index = $(this).data('slick-index');
  let id = $(this).closest(".slider").attr('id');
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
    initialSlide: index
   });
  }
 });

 $('#options main section .slider').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 1,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  swipeToSlide:true,
  responsive: [
   {
    breakpoint:600,
    settings:{
     slidesToShow:3
    }
   }
  ],
 }).css('opacity',1);

 $('#photo main section .slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 2000,
  swipeToSlide:true,
  responsive: [
   {
    breakpoint:600,
    settings:{
     slidesToShow:3
    }
   }
  ],
 }).css('opacity',1);

 $('section.bus').on('click', function(){
  let id = $(this).attr('id');
  let modal = $('.modal.'+id);
  let slider = modal.find('.slider');
  modal.addClass('active');
  if (slider.hasClass('slick-initialized')){
   slider.slick('slickGoTo', 1, true);
  } else {
   //let slidestoshow = (slider.hasClass('h-size-35') || slider.hasClass('h-size-50')) ? 2 : 1;
   slider.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    swipeToSlide: true,
    adaptiveHeight:true,
   });
  }
 });

 $('#options main section .slider img.slick-slide').on('click', function(){
  let index = $(this).data('slick-index');
  let id = $(this).closest("section").attr('id').replace('_slider','_modal');
  let modal = $('#'+id);
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
    initialSlide: index,
   });
  }
 });

 $('#photo main section .slider img.slick-slide').on('click', function(){
  let index = $(this).data('slick-index');
  let id = $(this).closest("section").attr('id').replace('_slider','_modal');
  let modal = $('#'+id);
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
    initialSlide: index,
   });
  }
 });

 $('.modal .close').on('click', function(){
  $(this).parent().removeClass('active');
 });
 $(document).on('keydown', function(event) {
  if (event.key === "Escape") {
   $('.modal.active').removeClass('active');
  }
 });
});