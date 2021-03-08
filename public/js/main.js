/*------------------
スクロールに応じたPCヘッダーの固定
------------------*/

$(window).on("load resize", function () {
  const winW = $(window).width();
  const devW = 767;

  if (winW <= devW) {
    //767px以下の時の処理
    const spNavPos = $(".global-nav").offset().top;
    const spNavHeight = $(".global-nav").outerHeight();

    $(window).on("scroll", () => {
      if ($(this).scrollTop() > spNavPos) {
        // $(".wrapper").css("padding-top", spNavHeight + 30);
        $(".sp-fixed").addClass("fixed");
        $(".cover__clock").addClass("fixed");
      } else {
        // $(".wrapper").css("padding-top", 20);
        $(".sp-fixed").removeClass("fixed");
        $(".cover__clock").removeClass("fixed");
      }
    });
  } else {
    //768pxより大きい時の処理
    const pcNavPos = $(".global-nav").offset().top;
    const pcNavHeight = $(".global-nav").outerHeight();

    $(window).on("scroll", () => {
      if ($(this).scrollTop() > pcNavPos) {
        // $(".wrapper").css("padding-top", pcNavHeight + 20);
        $(".global-nav").addClass("fixed");
        $("#sidemenu").addClass("fixed");
      } else {
        // $(".wrapper").css("padding-top", 50);
        $(".global-nav").removeClass("fixed");
        $("#sidemenu").removeClass("fixed");
      }
    });
  }
});

/*------------------
SP用ハンバーガーメニュー
------------------*/
$(".sp-btn").on("click", () => {
  $("html").toggleClass("open");
});

/*------------------
トップへ戻るボタン
------------------*/
// ボタンの表示／非表示を切り替える関数
const updateButton = () => {
  if ($(window).scrollTop() >= 220) {
    $(".back-to-top").fadeIn();
  } else {
    $(".back-to-top").fadeOut();
  }
};

// スクロールされる度にupdateButtonを実行
$(window).on("scroll", updateButton);

// ボタンをクリックしたらページトップにスクロールする
$(".back-to-top").on("click", (e) => {
  e.preventDefault();

  // 600ミリ秒かけてトップに戻る
  $("html, body").animate({ scrollTop: 0 }, 600);
});

// ページの途中でリロード（再読み込み）された場合でも、ボタンが表示されるようにする
updateButton();

/*------------------
ツールチップ
------------------*/
$(document).ready(function () {
  $(".tooltip").tooltipster({
    theme: "tooltipster-noir",
  });
});
