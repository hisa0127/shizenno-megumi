<!DOCTYPE html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns#">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
  // デフォルトのタイトルとディスクリプション
  $title = "自然の恵み農園 | 自然の恵みを感じ、豊かな未来をつくる";
  $description = "自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、豊かな未来を想像して頂ける取り組みを行なっています。";
  $image = get_stylesheet_directory_uri() . '/images/ogp-default.jpg';
  $url = home_url('/');

  // 条件分岐でタイトル、ディスクリプション、画像、URLを変更
  if (is_page('contact')) {
    // お問い合わせページ
    $title = "お問い合わせ | 自然の恵み農園";
    $description = "自然の恵み農園への、お仕事のご相談、農園体験、牧場の見学、その他ご質問など、お気軽にお問い合わせください。";
    $url = home_url('/contact/');
  } elseif (is_page('archive')) {
    // お知らせ一覧ページ(固定ページとして作成されている場合)
    $title = "お知らせ一覧 | 自然の恵み農園";
    $description = "季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。";
    $url = home_url('/archive/');
  } elseif (is_archive() || is_category()) {
    // カテゴリーページ
    $title = "お知らせ一覧 | 自然の恵み農園";
    $description = "季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。";
    $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  // 現在のURLを取得(上記で設定されていない場合)
  if ($url === home_url('/')) {
    $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }
  ?>

  <title><?php echo htmlspecialchars($title); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($description); ?>">

  <!-- OGP設定 -->
  <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
  <meta property="og:image" content="path_to_your_image.jpg"> <!-- OGP画像のパスを指定してください -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <title><?php bloginfo('name'); ?></title>

  <!-- Twitter Card meta tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
  <meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
  <meta name="twitter:image" content="<?php echo esc_url($image); ?>">

  <link rel="canonical" href="<?php echo esc_url($url); ?>">
  <?php wp_head(); ?>
</head>

<body>
  <!-- header -->
  <header class="header">
    <div class="header__container">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="自然の恵み" />
      </a>
      <!-- ハンバーガーメニュー -->
      <button class="header__nav-toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="メニューを開く">
        <span class="header__nav-toggle-hamburger"></span>
        <span class="header__nav-toggle-hamburger"></span>
        <span class="header__nav-toggle-text">MENU</span>
      </button>
      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/')); ?>">トップ<span class="sp">top</span></a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/#about')); ?>">私たちについて<span class="sp">about</span></a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/#work')); ?>">活動紹介<span class="sp">works</span></a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/#faq')); ?>">よくあるご質問<span class="sp">faq</span></a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/archive/')); ?>">お知らせ<span class="sp">news</span></a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/#access')); ?>">アクセス<span class="sp">access</span></a>
          </li>
          <li class="header__nav-item header__nav-item--contact">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">お問い合わせ</a>
          </li>
          <li class="header__nav-item">
            <p class="sp">問い合わせ電話</p>
            <a href="tel:123-4567-8910" class="header__nav-item-tel sp">123-4567-8910</a>
            <p class="sp">
              【受付時間】<br />
              10:00 ~ 18:00（土日祝を除く）
            </p>
          </li>
        </ul>
      </nav>
    </div>
  </header>