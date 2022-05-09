/* アコーディオン */
$(function(){
    $('.accordion_q').click(function(){
      $(this).next().slideToggle(200); //要素の開閉
      $(this).toggleClass('arrow'); //矢印を回転させる
    });
    });