$(function() {
  //共通の変数
  const DEFAULT_NUM = 6;
  const ADD_NUM = 10;

  //最新の要素数を取得する共通命令
  const getItems = () => $('#display-switching').find('.flex-column');

  //初期化関数
  window.initializeMoreList = function() {
    const $items = getItems();
    window.currentNum = DEFAULT_NUM;

    if($items.length <= DEFAULT_NUM){
      $('#more-btn, #close-btn').hide();
    } else {
      $('#more-btn').show();
      $('#close-btn').hide();
      $items.hide().slice(0, DEFAULT_NUM).show();
    }
  };

  //初期実行
  initializeMoreList();

  //もっと見るボタンの処理
  $(document).on('click', '#more-btn', function(){
    const $items = getItems();
    let nextNum = window.currentNum + ADD_NUM;
    $items.slice(window.currentNum, nextNum).slideDown();
    window.currentNum = nextNum;

    if($items.length <= window.currentNum) {
      $(this).hide();
      $('#close-btn').show();
    }
  });

  //折りたたむボタンの処理
  $(document).on('click', '#close-btn', function() {
    const $items = getItems();
    $items.slice(DEFAULT_NUM).slideUp();
    window.currentNum = DEFAULT_NUM;
    $(this).hide();
    $('#more-btn').show();
  });
})