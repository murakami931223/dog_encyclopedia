$(function() {
  //操作対象のコンテナを$containerとする
  const $container = $("#display-switching");
  //表示/非表示を切り替えるリストの要素
  const $items = $container.find(".item");
  //表示させる要素の総数をlengthメドッソで取得
  let listLength = $items.length;

  //デフォルトの表示数
  const defaultNum = 6;
  //追加表示させる数
  const addNum = 10;
  //現在の表示数
  let currentNum = defaultNum;

  //もし要素数がデフォルトの表示数を下回るならmore-btn、close-btnどっちも非表示
  if(listLength <= defaultNum){
    $("#more-btn").hide();
    $("#close-btn").hide();
  }else{
    $("#more-btn").show();
    $("#close-btn").hide();
    //defaultNumより多い要素を隠す
    $items.slice(defaultNum).hide();
  }

  //もっと見るボタン処理
  $("#more-btn").on("click", function(){
    //次に表示する要素の範囲
    let nextNum = currentNum + addNum;
    //今表示されている要素から次表示する要素までを表示
    $items.slice(currentNum,nextNum).slideDown();

    //現在の表示数を更新
    currentNum = nextNum;

    //もし追加で表示する要素がなくなったらmore-btnを非表示にしclose-btnを表示
    if(listLength <= currentNum){
      $(this).hide();
      $("#close-btn").show();
    }
  });

  //折りたたむボタン処理
  $("#close-btn").on("click",function(){
    $items.slice(defaultNum).slideUp();

    //現在の表示数をデフォルト数に戻す
    currentNum = defaultNum;

    //close-btnを非表示にしmore-btnを表示
    $(this).hide();
    $("#more-btn").show();
  });
});