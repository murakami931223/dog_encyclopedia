$(function(){
  const $flash = $('#flash-message');
  if($flash.length){
    setTimeout(() => {
      $flash.addClass('is-hidden');

      setTimeout(() => {
        $flash.remove();
      }, 500);
    }, 3000);
  }
});