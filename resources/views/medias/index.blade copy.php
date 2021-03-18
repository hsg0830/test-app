@extends('common.app2')

@section('title', 'ファイル一覧')

@section('css')
  <style>
    #modal-overlay {
      z-index: 1;
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      /* height: 120%; */
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.75);
    }

    #modal-content {
      width: 80%;
      margin: 1.5em auto 0;
      padding: 10px 20px;
      border: 2px solid #aaa;
      background: #fff;
      display: none;
      z-index: 2;
      position: fixed;
    }

    .modal-p {
      margin-top: 1em;
    }

    .modal-p:first-child {
      margin-top: 0;
    }

    .button-link {
      color: #00f;
      text-decoration: underline;
    }

    .button-link:hover {
      cursor: pointer;
      color: #f00;
    }

  </style>
@endsection
@section('content')
  <h1>ファイル一覧</h1>
  <p><a id="modal-open" class="button-link">クリックするとモーダルウィンドウを開きます。</a></p>

  {{-- <div id="modal-overlay"></div> --}}

  <div id="modal-content">
    <p>「閉じる」か「背景」をクリックするとモーダルウィンドウを終了します。</p>
    <p><a id="modal-close" class="button-link">閉じる</a></p>
  </div>
@endsection

@section('js')
  <script>
    $("#modal-open").click(() => {
      //キーボード操作などにより、オーバーレイが多重起動するのを防止する
      $(this).blur(); //ボタンからフォーカスを外す
      if ($("#modal-overlay")[0]) {
        $("#modal-overlay").remove(); //現在のモーダルウィンドウを削除して新しく起動する
      }
      //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
      $("body").append('<div id="modal-overlay"></div>');

      //[$modal-overlay]をフェードインさせる
      $("#modal-overlay").fadeIn("slow");

      centeringModalSyncer();
      //[$modal-content]をフェードインさせる
      $("#modal-content").fadeIn("slow");
    });

    $("#modal-overlay,#modal-close").unbind().click(() => {
      $("#modal-content,#modal-overlay").fadeOut("slow", () => {
        $("#modal-overlay").remove();
      });
    });

    //センタリングをする関数
    const centeringModalSyncer = () => {
      const w = $(window).width();
      const h = $(window).height();
      //コンテンツ(#modal-content)の幅を取得し、変数[cw]に格納
      const cw = $("#modal-content").outerWidth({
        margin: true
      });
      //コンテンツ(#modal-content)の高さを取得し、変数[ch]に格納
      const ch = $("#modal-content").outerHeight({
        margin: true
      });
      //コンテンツ(#modal-content)を真ん中に配置するのに、左端から何ピクセル離せばいいか？を計算して、変数[pxleft]に格納
      const pxleft = ((w - cw) / 2);
      //コンテンツ(#modal-content)を真ん中に配置するのに、上部から何ピクセル離せばいいか？を計算して、変数[pxtop]に格納
      const pxtop = ((h - ch) / 2);

      //[#modal-content]のCSSに[left]の値(pxleft)を設定
      $("#modal-content").css({
        "left": pxleft + "px"
      });
      //[#modal-content]のCSSに[top]の値(pxtop)を設定
      $("#modal-content").css({
        "top": pxtop + "px"
      });

    };

  </script>
@endsection
