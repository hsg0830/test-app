/*------------------
規範原文ページの内容の表示/非表示切り替え
------------------*/
// 항 해설 표시 초기설정
$(".term__description").hide();
$(".qa-item__answer").hide();

// 항 해설 여닫기
$(".ex-btn").on("click", (e) => {
  const $clickedBtn = $(e.target);
  const clickedBtnStatus = $clickedBtn.hasClass("fa-plus");
  const selectedItem = $clickedBtn.parent().next();

  if (clickedBtnStatus === true) {
    $clickedBtn.removeClass("fa-plus");
    $clickedBtn.addClass("fa-minus");
    selectedItem.show();
  } else {
    $clickedBtn.removeClass("fa-minus");
    $clickedBtn.addClass("fa-plus");
    selectedItem.hide();
  }
});

// 전체해설보기
$(".all-ex-btn").on("click", (e) => {
  const status = $(e.target).text();

  if (status === "전체해설보기") {
    $(".all-ex-btn span").text("전체해설닫기");
    $(".ex-btn").removeClass("fa-plus");
    $(".ex-btn").addClass("fa-minus");
    $(".term__description").show();
  } else {
    $(".all-ex-btn span").text("전체해설보기");
    $(".ex-btn").removeClass("fa-minus");
    $(".ex-btn").addClass("fa-plus");
    $(".term__description").hide();
  }
});

/*------------------
スクロールに応じた各種処理
------------------*/

//スクロール発火処理
const scrollEffect = (element, adjustVlaue) => {
  $(`.${element}`).each(function () {
    const scroll = $(window).scrollTop(); //現在のyスクロール量を取得
    const windowHeight = $(window).height(); //ウィンドウの高さを取得
    const targetPos = $(this).offset().top; //ターゲットのy位置を取得
    //const subjectHeight = $(this).innerHeight(); //ターゲットの高さを取得
    const threshould = targetPos - windowHeight + adjustVlaue; //発火位置調整

    if (scroll > threshould) {
      $(this).addClass("isActive");
    } else {
      $(this).removeClass("isActive");
    }
  });
};

//強調箇所に下線を引く
$(window).scroll(() => {
  scrollEffect("underline", 150);
});

/*------------------
一覧の切り替えタブ
------------------*/
const showTab = (selector) => {
  const idValue = selector.slice(-1);
  $(".list-container__selector li").removeClass('active');
  $(`#${selector}`).addClass('active');
  $('.list-container__wrapper').hide();
  $(`#tabs-content-${idValue}`).show();
};

$(".list-container__selector li").on('click', (e) => {
  const selector = $(e.target).attr("id");
  console.log(selector);
  showTab(selector);
});

showTab('tabs-menu-a');
