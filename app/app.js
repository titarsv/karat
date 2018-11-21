// God save the Dev
'use strict';

if (process.env.NODE_ENV !== 'production') {
  require('./assets/templates/layouts/index.html');
}

// Depends
var $ = require('jquery');
require('bootstrap');

// Modules
var Forms = require('_modules/forms');
var Slider = require('_modules/slider');
var Popup = require('_modules/popup');
var Fancy_select = require('_modules/fancyselect');
var Jscrollpane = require('_modules/jscrollpane');
// var LightGallery = require('_modules/lightgallery');
var Jslider = require('_modules/jslider');
var Fancybox = require('_modules/fancybox');
var Chosen = require('_modules/chosen');
var Zoom = require('_modules/elevate-zoom');

// Stylesheet entrypoint
require('_stylesheets/app.scss');

// Are you ready?
$(function() {
  new Forms();
  new Popup();
  new Fancy_select();
  new Jscrollpane();
  // new LightGallery();
  new Slider();
  new Jslider();
  new Fancybox();
  new Chosen();
  new Zoom();

  // Прокрутка к якорю
  $('.go_to').each(function() {
    var $this = $(this);
    $this.click(function() {
      var scroll_el = $($this.data('destination'));
      if ($(scroll_el).length != 0) {
        $('html, body').animate({
          scrollTop: $(scroll_el).offset().top
        }, 500);
      }
      return false;
    });
  });

  $('.share-icon').click(function() {
    $(this).next('.share-post').toggleClass('open');
  });

  $('.burger-menu').click(function() {
    $(this).toggleClass('open');
    $('.mobile-menu').toggleClass('open');
  });

  $('.mobile-menu .menu-item-has-children').click(function() {
    $(this).toggleClass('open');
    $(this).find('.sub-menu').toggleClass('open');
  });
  $('.seacher-icon').click(function() {
    $(this).next('.search').addClass('open');
  });
  $('.close-search-icon').click(function() {
    $('.search').removeClass('open');
  });
  $('.minus').click(function() {
    var $input = $('#quont');
    var count = parseInt($input.val(), 0) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function() {
    var $input = $('#quont');
    $input.val(parseInt($input.val(), 0) + 1);
    $input.change();
    return false;
  });
  $('.socials-links a').click(function(e){
      e.preventDefault();
      var href = $(this).attr('href');
      if(href.indexOf('http') === 0){
          window.open($(this).attr('href'),'pmw','scrollbars=1,top=0,left=0,resizable=1,width=680,height=350')
      }
  });

  $('.lostpassword_form').submit(function(e){
      e.preventDefault();
      $.post($(this).attr('action'), $(this).serializeArray(),function(){
          $('.lostpassword_form .login-popup__form-input').after('<p>Check your email for the confirmation link.</p>');
          $('.lostpassword_form input').val('');
      });
  });

  $('#bCopy').click(function (e) {
      e.preventDefault();
      $('.share-link-input').select();
      document.execCommand('copy');
  })
});