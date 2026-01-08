<?php
/*
Template Name: top
*/
?>
<?php get_header(); ?>
<!-- main -->
<main id="main-content">
  <!-- First View / Hero Section -->
  <section class="firstview">
    <div class="firstview__main-box">
      <figure class="firstview__main-img">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.svg"
          alt="自然の恵み農園ロゴ"
          fetchpriority="high"
          decoding="async"
          width="203"
          height="157">
      </figure>
      <div class="firstview__main-title">
        <h1 class="firstview__title">
          自然の恵みを感じ、<br class="sp">豊かな未来を。
        </h1>
      </div>
    </div>
    <div class="firstview__container">
      <article class="firstview__news-card">
        <?php
        $args = array(
          'posts_per_page' => 1,
          'order'          => 'DESC',
          'orderby'        => 'date'
        );
        $postslist = get_posts($args);
        foreach ($postslist as $post) :
          setup_postdata($post); ?>
          <a href="<?php the_permalink(); ?>" class="firstview__news-card-link" aria-label="最新ニュース記事へ">
            <div class="firstview__news-card-text">
              <p class="firstview__news-card-label">News</p>
              <time class="firstview__news-card-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php the_date(); ?></time>
            </div>

            <div class="firstview__news-card-title">
              <?php
              if (mb_strlen($post->post_title) > 17) {
                $title = mb_substr($post->post_title, 0, 17);
                echo $title . '...';
              } else {
                echo $post->post_title;
              }
              ?>
            </div>
          </a>

        <?php
        endforeach;
        wp_reset_postdata(); ?>
      </article>
    </div>
    <div class="firstview__scrolldown scrolldown" aria-hidden="true">
      <span>SCROLL</span>
    </div>
  </section>
</main>

<!-- about -->
<section id="about" class="about" aria-label="企業について">
  <div class="about__container">
    <div class="about__images">
      <figure class="about__figure about__figure--top-left">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about-image01.png"
          alt="羊"
          class="about__img fadein1"
          loading="lazy"
          decoding="async"
          width="200"
          height="252">
      </figure>

      <figure class="about__figure about__figure--top-right">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about-image02.png"
          alt="トマト"
          class="about__img fadein2"
          loading="lazy"
          decoding="async"
          width="181"
          height="217">
      </figure>

      <figure class="about__figure about__figure--bottom-left">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about-image03.png"
          alt="人"
          class="about__img fadein3"
          loading="lazy"
          decoding="async"
          width="200"
          height="200">
      </figure>

      <figure class="about__figure about__figure--bottom-right">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about-image04.png"
          alt="牛"
          class="about__img fadein4"
          loading="lazy"
          decoding="async"
          width="235"
          height="209">
      </figure>
    </div>

    <div class="about__content">
      <div class="about__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="自然の恵み農園ロゴ"
          loading="lazy"
          decoding="async"
          width="314"
          height="54">
      </div>
      <p class="about__text">
        自然の恵み農園は、<br />
        自然の恵みと動物の尊さが調和する<br class="sp" />特別な場所です。<br />
        新鮮で美味しい農産物を栽培し、<br class="sp" />心温まる動物たちと触れ合える場所<br class="sp" />でもあります。
      </p>
      <p class="about__text">
        自然の恵みを受け、<br class="sp" />動物たちとの特別なひとときを<br class="sp" />楽しんでいただける場所として、<br />私たちは誇りを持って活動をしています。
        <br />一緒に自然と動物の美しさを共有しましょう。
      </p>
    </div>
  </div>
</section>

<!-- work -->
<section id="work" class="work" aria-label="活動紹介">
  <div class="work__container">
    <div class="work__title">
      <h2 class="work__heading heading">活動紹介</h2>
    </div>

    <div class="work__tabs" role="tablist" aria-label="活動内容タブ">
      <button
        class="work__tab work__tab--active"
        role="tab"
        aria-selected="true"
        aria-controls="panel-farm"
        id="tab-farm">
        農園
      </button>
      <button
        class="work__tab"
        role="tab"
        aria-selected="false"
        aria-controls="panel-ranch"
        id="tab-ranch">
        牧場
      </button>
      <button
        class="work__tab"
        role="tab"
        aria-selected="false"
        aria-controls="panel-sales"
        id="tab-sales">
        オンライン販売
      </button>
    </div>

    <div class="work__panels">
      <section
        class="work__panel work__panel--active"
        role="tabpanel"
        id="panel-farm"
        aria-labelledby="tab-farm">
        <p class="work__description">
          私たちは、「持続可能な農業」を掲げて、自然<br class="sp">の恵みに感謝しながら、農作物を育てています。<br>無農薬で、体にも環境にも優しく、季節ごとに<br class="sp">異なる品種を育て、提供しています。<br>ぜひ一度、農園にお越し頂き、自分の手で収穫<br class="sp">した新鮮な野菜、果物をお召し上がりください。
        </p>
        <div class="work__slider">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen04.png"
            alt="農園の風景1"
            loading="lazy"
            decoding="async"
            width="300"
            height="250">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen03.png"
            alt="農園の風景2"
            loading="lazy"
            decoding="async"
            width="300"
            height="250">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen02.png"
            alt="農園の風景3"
            loading="lazy"
            decoding="async"
            width="300"
            height="250">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen01.png"
            alt="農園の風景4"
            loading="lazy"
            decoding="async"
            width="300"
            height="250">
        </div>
      </section>

      <section
        class="work__panel"
        role="tabpanel"
        id="panel-ranch"
        aria-labelledby="tab-ranch"
        hidden>
        <p class="work__description">
          私たちの牧場は、自然と動物との共存を尊重し、<br class="sp" />持続可能な農業の原則に基づいて運営されています。<br />広々とした環境で、動物たちとのふれ合いを<br class="sp" />通じて、自然の恵みと動物の尊さを感じ、<br />心温まるひとときを過ごしていただけます。
        </p>
        <div class="work__slider">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo04.png" alt="牧場の風景1" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo03.png" alt="牧場の風景2" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo02.png" alt="牧場の風景3" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo01.png" alt="牧場の風景4" />
        </div>
      </section>

      <section
        class="work__panel"
        role="tabpanel"
        id="panel-sales"
        aria-labelledby="tab-sales"
        hidden>
        <p class="work__description">
          自然の恵み農園から直接お届けする、<br class="sp" />新鮮で美味しい農産物と<br />手作りのジャムやバターなどの<br class="sp" />加工品を提供しています。<br />自然の恩恵をご自宅でお楽しみいただけます。
        </p>
        <div class="work__slider">
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec04.png" alt="販売商品1" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec03.png" alt="販売商品2" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec02.png" alt="販売商品3" />
          <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec01.png" alt="販売商品4" />
        </div>
      </section>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="faq" aria-label="よくあるご質問">
  <div class="faq__container">
    <div class="faq__title">
      <h2 class="faq__heading heading">よくあるご質問</h2>
    </div>

    <div class="faq__list">
      <div class="faq__item">
        <button
          class="faq__trigger"
          aria-expanded="false"
          aria-controls="faq-answer-1"
          id="faq-question-1">
          <span class="faq__question">農園の野菜や果物は有機栽培ですか？</span>
        </button>
        <div
          class="faq__answer"
          id="faq-answer-1"
          role="region"
          aria-labelledby="faq-question-1"
          hidden>
          <p class="faq__answer-text">
            はい、私たちの農園では有機栽培の原則に従って野菜と果物を栽培しています。<br />
            化学肥料や農薬を極力使用せず、土壌と作物の健康を第一に考えております。
          </p>
        </div>
      </div>

      <!-- FAQ Item 2 -->
      <div class="faq__item">
        <button
          class="faq__trigger"
          aria-expanded="false"
          aria-controls="faq-answer-2"
          id="faq-question-2">
          <span class="faq__question">農園での見学や体験ツアーは行っていますか？</span>
        </button>
        <div
          class="faq__answer"
          id="faq-answer-2"
          role="region"
          aria-labelledby="faq-question-2"
          hidden>
          <p class="faq__answer-text">
            はい、農園での見学や体験ツアーを随時開催しています。<br />
            農場の日常や農作業を親しみやすく説明し、実際に農園での体験を楽しむことができます。
          </p>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="faq__item">
        <button
          class="faq__trigger"
          aria-expanded="false"
          aria-controls="faq-answer-3"
          id="faq-question-3">
          <span class="faq__question">オンラインで注文した農産物はどのように配送されますか？</span>
        </button>
        <div
          class="faq__answer"
          id="faq-answer-3"
          role="region"
          aria-labelledby="faq-question-3"
          hidden>
          <p class="faq__answer-text">
            オンラインで注文いただいた農産物は、専用の梱包で新鮮さを保ったまま、<br />
            指定された配送先にお届けします。
          </p>
        </div>
      </div>

      <!-- FAQ Item 4 -->
      <div class="faq__item">
        <button
          class="faq__trigger"
          aria-expanded="false"
          aria-controls="faq-answer-4"
          id="faq-question-4">
          <span class="faq__question">農園で提供される季節ごとの野菜や果物の品種は何ですか？</span>
        </button>
        <div
          class="faq__answer"
          id="faq-answer-4"
          role="region"
          aria-labelledby="faq-question-4"
          hidden>
          <p class="faq__answer-text">
            春にはイチゴ、夏にはトマトや茄子、秋にはカボチャやリンゴ、冬にはブロッコリーやみかん<br />
            など、季節に応じた野菜、果物を提供、収穫体験することができます。
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- info -->
<section id="info" class="info" aria-label="最新情報">
  <div class="info__container">
    <div class="info__title">
      <h2 class="info__heading heading">お知らせ</h2>
    </div>
    <div class="info__description">
      <p class="info__text">
        季節の農作物のお知らせ、見学ツアーのご案内、<br class="pc">オンライン販売セールのお知らせなど、自然の恵み農園<br class="pc">の最新情報をお届けします。
      </p>
    </div>

    <div class="info__list">
      <?php
      $args = array(
        'posts_per_page' => 3,
        'order'          => 'DESC',
        'orderby'        => 'date',
      );
      $postslist = get_posts($args);
      foreach ($postslist as $post) :
        setup_postdata($post); ?>

        <article class="info__item">
          <a href="<?php the_permalink(); ?>">
            <p class="info__item-day">
              <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?>
              </time>

              <?php
              $cats = get_the_category();
              foreach ($cats as $cat) {
                echo '<span class="info__item-category category">' . $cat->name . '</span>';
              }
              ?>
            </p>

            <p class="info__item-title"><?php the_title(); ?></p>
          </a>
        </article>

      <?php
      endforeach;
      wp_reset_postdata(); ?>
    </div>

    <a href="<?php echo esc_url(home_url('/archive/')); ?>" class="info__more-btn">
      <span class="info__more">
        View More
      </span>
    </a>

  </div>
</section>

<!-- access -->
<section id="access" class="access" aria-label="アクセス情報">
  <div class="access__title">
    <h2 class="access__heading heading">アクセス</h2>
  </div>
  <div class="access__container">
    <div class="access__info-left">
      <ul class="access__labels">
        <li class="access__label">会社名</li>
        <li class="access__label">所在地</li>
        <li class="access__label">電話番号</li>
        <li class="access__label">営業時間</li>
      </ul>
      <p class="access__map-label">Googleマップ</p>
      <a class="access__map-link" aria-label="拡大地図を表示" target="_blank" href="https://maps.google.com/maps?ll=35.760458,140.061538&amp;z=14&amp;t=m&amp;hl=ja&amp;gl=JP&amp;mapclient=embed&amp;cid=15334165452323813764">拡大地図を表示</a>
    </div>
    <div class="access__info-right">
      <ul class="access__info-list">
        <li class="access__info-item">株式会社自然の恵み農園</li>
        <li class="access__info-item">
          <address class="access__info-item-address">
            〒123-4567 <br class="sp">千葉県〇〇市××町<br class="sp">1丁目23-45
          </address>
        </li>
        <li class="access__info-item">
          <a href="tel:012-3456-7890" class="access__info-item-phone">012-3456-7890</a>
        </li>
        <li class="access__info-item">10:00〜18:00<br class="sp" />（土日祝を除く）</li>
      </ul>
    </div>
    <div class="access__map">
      <iframe title="自然の恵み農園のGoogle マップ" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21778.460319406986!2d140.0478957058432!3d35.765856699519894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60227e5329d23245%3A0xd4cde63c28d3f984!2z44G144Gq44Gw44GX44Ki44Oz44OH44Or44K744Oz5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1713698087440!5m2!1sja!2sjp" width="710" height="300" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<?php get_template_part('parts', 'contact'); ?>
<?php get_footer(); ?>