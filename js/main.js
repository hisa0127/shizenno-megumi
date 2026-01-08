// グローバル変数としてscrollPositionを定義
var scrollPosition = 0;

// ハンバーガーメニュー
$(".header__nav-toggle").click(function () {
    var isMenuOpen = $(".header__nav-toggle").hasClass("active");
    var $toggleText = $(".header__nav-toggle-text");

    if (isMenuOpen) {
        // メニューを閉じるときの処理
        $('body').css({
            'position': '',
            'width': '',
            'top': '',
            'overflow': ''
        });
        // scroll-behaviorを一時的にautoに変更して即座に戻す
        document.documentElement.style.scrollBehavior = 'auto';
        window.scrollTo(0, scrollPosition);
        // スクロール完了後にsmoothに戻す
        setTimeout(function() {
            document.documentElement.style.scrollBehavior = 'smooth';
        }, 0);
        $toggleText.text("MENU");
    } else {
        // メニューを開くときの処理
        scrollPosition = window.pageYOffset;
        $('body').css({
            'position': 'fixed',
            'width': '100%',
            'top': -scrollPosition + 'px',
            'overflow': 'hidden'
        });
        $toggleText.text("CLOSE");
    }

    $(".header__nav-toggle, .header__nav").toggleClass("active");
});

// ナビゲーションリンクのクリックイベント
$(".header__nav a").click(function (e) {
    const href = $(this).attr("href");
    const linkUrl = new URL(href, window.location.href);
    const currentUrl = new URL(window.location.href);

    // リンクにハッシュ(#)があり、かつリンク先のパスと現在のページのパスが一致する場合
    const isSamePageAnchor = linkUrl.hash && linkUrl.pathname === currentUrl.pathname;

    if (isSamePageAnchor) {
        e.preventDefault();

        const hashId = linkUrl.hash;
        const targetElement = $(hashId);

        if (targetElement.length) {
            // 画面幅に応じてオフセット値を設定
            let offset = 0;
            const headerHeightSp = 50; // SP版ヘッダーの高さ
            const headerHeightPc = 110; // PC版ヘッダーの実質的な高さ (90px + 20px)
            const breakpoint = 768; // 例: 768px未満をSP版とする

            if (window.innerWidth < breakpoint) {
                offset = headerHeightSp;
            } else {
                offset = headerHeightPc;
            }

            // ナビゲーションが開いている場合は閉じる処理
            if ($(".header__nav-toggle").hasClass("active")) {
                document.documentElement.style.scrollBehavior = 'auto';

                $(".header__nav-toggle, .header__nav, .header, .header__logo").removeClass("active");
                $("body").css({
                    "position": "",
                    "width": "",
                    "top": "",
                    "overflow": ""
                });
                // スムーススクロールと競合するため削除またはコメントアウト
                // window.scrollTo(0, scrollPosition);

                $(".header__nav-toggle").attr({
                    "aria-label": "メニューを開く",
                    "aria-expanded": "false"
                });
            }

            // スムーズスクロール処理
            $("html, body").animate({
                scrollTop: targetElement.offset().top - offset
            }, 300); // 300ms のスムーズスクロール
        }
    }
});

  function handleScroll() {
    var newsBox = document.querySelector('.firstview__news-card-link');
    var firstView = document.querySelector('.firstview');
    
    // 要素が存在しない場合は処理を中断
    if (!newsBox || !firstView) {
        return;
    }
    
    var rect = firstView.getBoundingClientRect();
    var windowHeight = window.innerHeight || document.documentElement.clientHeight;

    // ファーストビューが半分スクロールされたかどうかをチェック
    if (rect.top < -(rect.height / 2)) {
        newsBox.classList.remove('slide-in');
        newsBox.classList.add('slide-out');
    } else {
        newsBox.classList.remove('slide-out');
        newsBox.classList.add('slide-in');
    }
}

// ページがスクロールされたときにhandleScroll関数を呼び出す
window.addEventListener('scroll', handleScroll);

// ページがロードされたときにhandleScroll関数を呼び出す
window.addEventListener('load', handleScroll);

// フェードイン
  $(function () {
    $(window).scroll(function () {
      $(".fadein1, .fadein2, .fadein3, .fadein4").each(function () {
        var position = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();
        if (scroll > position - windowHeight + 200) {
          $(function () {
            $(".fadein1, .fadein2, .fadein3, .fadein4").each(function (i) {
              $(this)
                .delay(i * 200)
                .queue(function () {
                  $(this).addClass("active");
                });
            });
          });
        }
      });
    });
  });
  
// タブ機能(WAI-ARIA対応)
$(function() {
    $('.work__tab').on('click', function() {
        var $clickedTab = $(this);
        var targetPanelId = $clickedTab.attr('aria-controls');
        var $targetPanel = $('#' + targetPanelId);

        // 既にアクティブなタブをクリックした場合は何もしない
        if ($clickedTab.attr('aria-selected') === 'true') {
            return;
        }

        // 全てのタブから active クラスを削除し、aria-selected を false に
        $('.work__tab').removeClass('work__tab--active').attr('aria-selected', 'false');

        // クリックされたタブに active クラスを追加し、aria-selected を true に
        $clickedTab.addClass('work__tab--active').attr('aria-selected', 'true');

        // 全てのパネルから active クラスを削除し、hidden 属性を追加
        $('.work__panel').removeClass('work__panel--active').attr('hidden', '');

        // 対応するパネルに active クラスを追加し、hidden 属性を削除
        $targetPanel.addClass('work__panel--active').removeAttr('hidden');
    });
});

// スライダー
$(function () {
    // .slider と .work__slider 両方に対応
    $('.slider, .work__slider').slick({
        autoplay:true,//自動でスクロール
        autoplaySpeed:0,//自動再生のスライド切り替えまでの時間設定
        speed:3000,//スライドが流れるまでの時間　ミリ秒表示　3000＝3秒
        cssEase:"linear",//スライドの流れ方を等速に設定　ease-in
        slidesToShow:3.5,//表示するスライドの数
        swipe:false,//操作による切り替えをさせない
        arrows:false,//矢印非表示
        responsive: [//画面表示に合わせた処理
            {
                breakpoint:768,//表示幅が768px以下の時
                settings: {
                    slidesToShow:1.5,//表示するスライドの数
                }
            }
        ]
    });
});

// アコーディオンメニュー(WAI-ARIA対応)
$(function () {
    // 全てのFAQ回答を初期状態で隠す
    $(".faq__answer").attr('hidden', '');

    // 最初のアイテムを開いた状態にする
    var $firstTrigger = $(".faq__trigger").first();
    var firstAnswerId = $firstTrigger.attr('aria-controls');
    $firstTrigger.attr('aria-expanded', 'true');
    $("#" + firstAnswerId).removeAttr('hidden');

    // トリガーボタンのクリックイベント
    $(".faq__trigger").on("click", function () {
        var $trigger = $(this);
        var answerId = $trigger.attr('aria-controls');
        var $answer = $("#" + answerId);
        var isExpanded = $trigger.attr('aria-expanded') === 'true';

        if (isExpanded) {
            // 開いている場合は閉じる
            $trigger.attr('aria-expanded', 'false');
            $answer.slideUp(300, function() {
                $answer.attr('hidden', '');
            });
        } else {
            // 閉じている場合は開く
            // 他のアコーディオンを全て閉じる
            $(".faq__trigger").not($trigger).each(function() {
                var $otherTrigger = $(this);
                var $otherAnswer = $("#" + $otherTrigger.attr('aria-controls'));
                $otherTrigger.attr('aria-expanded', 'false');
                $otherAnswer.slideUp(300, function() {
                    $otherAnswer.attr('hidden', '');
                });
            });

            // 現在のアコーディオンを開く
            $trigger.attr('aria-expanded', 'true');
            $answer.removeAttr('hidden');
            $answer.slideDown(300);
        }
    });
});
  
// セレクトボックス
jQuery(function($){
  const Target = $('.is-empty');
  $(Target).on('change', function(){
    if ($(Target).val() !== ""){
      $(this).removeClass('is-empty');
    } else {
      $(this).addClass('is-empty');
    }
  });
});


  
//以下Contactform7のドロップダウンメニューのカスタマイズ

$(".custom-select").each(function () {
  // 各ドロップダウンメニューのクラス、ID、名前属性を取得
  var classes = $(this).attr("class"),
      id = $(this).attr("id"),
      name = $(this).attr("name");
  // ドロップダウンメニューのHTMLテンプレートを作成
  var template = '<div class="' + classes + '">';
  // ↓ ここに適切なプレースホルダーのテキストを設定
  var placeholderText = "選択してください"; 
  template += '<span class="custom-select-trigger">' + placeholderText + '</span>';
  template += '<div class="custom-options">';
  // 各オプションをカスタムHTMLに変換
  $(this).find("option").each(function () {
      template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
  });
  template += '</div></div>';
// 元の<select>要素をラップし、非表示にしてカスタムテンプレートを後に挿入
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);

  
});
// 最初のカスタムオプションにホバーイベントを設定
$(".custom-option:first-of-type").hover(function () {
  $(this).parents(".custom-options").addClass("option-hover");
}, function () {
  $(this).parents(".custom-options").removeClass("option-hover");
});
// カスタムセレクトトリガー(プレースホルダー部分)にクリックイベントを設定
$(".custom-select-trigger").on("click", function (event) {
  var customSelect = $(this).parents(".custom-select");
  $('html').one('click', function () {
      $(".custom-select").removeClass("opened");
      customSelect.find(".custom-select-trigger").removeClass("opened");
  });
  customSelect.toggleClass("opened");
  $(this).toggleClass("opened");

  event.stopPropagation();
});

// カスタムオプションにクリックイベントを設定
$(".custom-option").on("click", function () {
    var selectedValue = $(this).data("value");
  var customSelectWrapper = $(this).parents(".custom-select-wrapper");
  var selectElement = customSelectWrapper.find("select");
  
  // <select>要素の値を更新し、changeイベントをトリガーする
  selectElement.val(selectedValue).change();

  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  
  var customSelect = $(this).parents(".custom-select");
  customSelect.removeClass("opened");
  customSelect.find(".custom-select-trigger").removeClass("opened").text($(this).text());
  customSelectWrapper.find(".custom-select-trigger").css('color', '#555555');
});