$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  let favorite = $('.favorite-toggle'); //iタグを取得し代入
  let favoriteDogId;
  favorite.on('click',function(){
    let $this = $(this);
    favoriteDogId = $this.data('dog-id');
    //ajax処理
    $.ajax({
        url: '/favorite',
        method: 'post',
        dataType: 'json',
        data: {
          'dog_id' : favoriteDogId
        },
    })
    //通信成功したときの処理
    .done(function(data){
      $this.toggleClass('far fas liked');
    })

    //通信失敗したときの処理
    .fail(function(jqXHR, textStatus, errorThrown){
      console.error('Ajax処理失敗:', textStatus, errorThrown);
    })
  });
});