jQuery(function ($) {
  $('.js-accordion-title').on('click', function () {
    $(this).next().slideToggle(200);
    $(this).toggleClass('open', 200);
  });

  });

$(function () {
    $('.modal-open').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        console.log(modal);
        $(modal).fadeIn();
        return false;
      });
    });
    $('.js-modal-close').on('click', function () {
      $('.js-modal').fadeOut();
      return false;
    });
  });

