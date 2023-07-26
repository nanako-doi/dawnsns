// console.log(1+1);

// 三角マーク
$(function(){
    $('.arrow').click(function () {
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $('.menu').addClass('active');
        }else{
            $('.menu').removeClass('active');
        }
    });
    $('.accordion ul li a').click(function(){
        $('.arrow').removeClass('active');
        $('.menu').removeClass('active');
    });
});

// モーダル
$(function () {
    $('.modalopen').each(function () {
      $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        console.log(modal);
        $(modal).fadeIn();
        return false;
      });
    });
    $('.modalClose').on('click', function () {
      $('.js-modal').fadeOut();
      return false;
    });
  });

