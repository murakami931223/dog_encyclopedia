$(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  //お気に入り登録処理
  function addFavorite(){
    $(document).on('click', '.favorite-toggle', function(e){
      e.stopImmediatePropagation();
      
      let $this = $(this);
      let favoriteDogId = $this.data('dog_id');

      $.ajax({
        url: APP_BASE_URL + 'favorite',
        method: 'post',
        dataType: 'json',
        data: { 'dog_id' : favoriteDogId },
      })
      .done(function(data){
        $this.toggleClass('far fas');

        if (data.deleteOK) {
          $this.closest('.favorite-dog-item').fadeOut(300, function(){
            $(this).remove();

            if ($('.favorite-dog-item').length === 0){
              $('#favorite-items-container').html('<p class="favorite-none">お気に入りはありません。</p>')
            }
        });
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown){
        console.error('Ajax処理失敗:', textStatus, errorThrown);
      });
    });
  }

  //編集権限切り替え処理
  function empowerment(){
    $(document).on('click','.empowerment-btn', function(e){
      e.stopImmediatePropagation();

      let $this = $(this);
      let userId = $this.data('user_id');

      $.ajax({
        url: APP_BASE_URL + 'empowerment',
        method: 'post',
        dataType: 'json',
        data: {'user_id' : userId},
      })
      .done(function(data){
        let $container = $this.closest('.empowerment-toggle');

        //data.is_adminが1の時（管理者の時）
        if (data.is_admin){
          $container.html(
            `<p data-user_id="${userId}" class="empowerment-btn release-btn">編集権限を解除しますか？</p>`
          )
        }else{
          $container.html(
            `<p data-user_id="${userId}" class="empowerment-btn grant-btn">編集権限を付与しますか？</p>`
          )
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown){
        console.error('Ajax処理失敗:', textStatus, errorThrown);
      });
    });
  }
  
  //削除処理
  function deleteClick(){
    $(document).on('click', '.list-delete-btn', function(e) {
      e.preventDefault();

      const $this = $(this);
      const $form = $this.closest('form');
      const deleteUrl = $form.attr('action');
      const $targetElement = $this.closest('.flex-column');

      if (confirm('本当に削除しますか？')) {
        $.ajax({
          url: deleteUrl,
          type: 'POST',
          data: $form.serialize(),
        })

        .done(function(data) {
            $targetElement.remove();

          $('#flash-message-container').html(
            '<div id="flash-message" class="alert-success">'
            + data.message
            + '</div>'
          )

          setTimeout(function() {
            $('#flash-message').fadeOut();
          }, 3000);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {
          console.error('削除失敗:', textStatus, errorThrown);
          alert('削除に失敗しました。');
        });
      }
    });
  }

  //ソート処理
  function dogSort() {
    $(document).on('change', '#dog-sort-select', function() {
      console.log('動いてる？');
      let sortVal = $(this).val();

      //現在のURLを取得し、sortパラメータを更新する
      let url = new URL(window.location.href);
      url.searchParams.set('sort', sortVal);

      $.ajax({
        url: url.href,
        method: 'get', //ソートはデータの取得なのでGET
      })
      .done(function(html) {
        $('#dog-container').html(html);

        window.history.pushState({}, '', url);

        //「もっと見る」を再適応
        if (typeof initializeMoreList === 'function') {
          initializeMoreList();
        }
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        console.error('ソート失敗:', textStatus, errorThrown);
      });
    });
  }

  //ページネーションの非同期処理
  function paginationAjax() {
    $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();

      let url = $(this).attr('href');

      $.ajax({
        url: url,
        method: 'get'
      })
      .done(function(html) {
        $('#dog-container').html(html);
        window.history.pushState({}, '', url);
      });
    });
  }

  //実行
  addFavorite();
  deleteClick();
  empowerment();
  dogSort();
  paginationAjax();
});