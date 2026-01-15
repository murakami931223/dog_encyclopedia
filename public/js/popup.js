$(function(){
  console.log('JSファイルは読み込まれました');
  const $flash = $('#flash-message');
  console.log('要素の数:', $flash.length);
  if($flash.length){
    setTimeout(() => {
      console.log('3秒経ったのでクラスを追加します');
      $flash.addClass('is-hidden');

      setTimeout(() => {
        console.log('さらに0.5秒経ったので削除します');
        $flash.remove();
      }, 500);
    }, 3000);
  }
});