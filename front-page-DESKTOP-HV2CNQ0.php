<?php
/*
Template Name: top
*/
?>
<?php get_header(); ?>
<!-- main -->
<main>
  <div class="firstview">
    <div class="main-box">
      <div class="main-img">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-2.svg" alt="#" />
      </div>
      <div class="main-title">
        <h1 class="title">
          自然の恵みを感じ、<br class="sp" />豊かな未来を。
        </h1>
      </div>
    </div>
    <div class="container">
      <?php
      $args = array(
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date'
      );
      $postslist = get_posts($args);
      foreach ($postslist as $post) :
        setup_postdata($post); ?>
        <a href="<?php the_permalink(); ?>">
          <div class="news-box ">
            <div class="news-text">
              <p class="text20">News</p>
              <span class="news-data"><?php the_date(); ?></span>
              <br />
            </div>
            <div data-name="[news-title]">
              <?php
              if (mb_strlen($post->post_title) > 17) {
                $title = mb_substr($post->post_title, 0, 17);
                echo $title . '...';
              } else {
                echo $post->post_title;
              }
              ?>
            </div>
          </div>
        </a>
      <?php
      endforeach;
      wp_reset_postdata(); ?>
    </div>
    <div class="scrolldown"><span>SCROLL</span></div>
  </div>
</main>


<!-- about -->
<div id="about">
  <div class="about-box">
    <div class="about-img">
      <img src="<?php echo get_template_directory_uri(); ?>/images/about-image01.png" alt="羊" class="fadein1" />
    </div>
    <div class="about-img">
      <img src="<?php echo get_template_directory_uri(); ?>/images/about-image02.png" alt="トマト" class="fadein2" />
    </div>
    <div class="about-logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo" />
    </div>
  </div>
  <div class="about-text">
    <p>
      自然の恵み農園は、<br />
      自然の恵みと動物の尊さが調和する<br class="sp" />特別な場所です。<br />
      新鮮で美味しい農産物を栽培し、<br class="sp" />心温まる動物たちと触れ合える場所<br class="sp" />でもあります。
    </p>
    <p>
      自然の恵みを受け、<br class="sp" />動物たちとの特別なひとときを<br class="sp" />楽しんでいただける場所として、<br />私たちは誇りを持って活動をしています。
      <br />一緒に自然と動物の美しさを共有しましょう。
    </p>
  </div>
  <div class="about-box2">
    <div class="about-img">
      <img src="<?php echo get_template_directory_uri(); ?>/images/about-image03.png" alt="人" class="fadein3" />
    </div>
    <div class="about-img">
      <img src="<?php echo get_template_directory_uri(); ?>/images/about-image04.png" alt="牛" class="fadein4" />
    </div>
  </div>
</div>

<!--work  -->
<div id="work">
  <div class="work-title">
    <h2 class="text40">活動紹介</h2>
    <div class="work-line">
      <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
    </div>
  </div>

  <ul class="tab-area">
    <li class="tab active">農園</li>
    <li class="tab">牧場</li>
    <li class="tab">オンライン販売</li>
  </ul>
  <div class="panel-area">
    <div class="panel active">
      <p class="text">
        私たちは、「持続可能な農業」を掲げて、自然<br class="sp" />の恵みに感謝しながら、農作物を育てています。<br />無農薬で、体にも環境にも優しく、季節ごとに<br class="sp" />異なる品種を育て、提供しています。<br />ぜひ一度、農園にお越し頂き、自分の手で収穫<br class="sp" />した新鮮な野菜、果物をお召し上がりください。
      </p>
      <div class="slider">
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen04.png" alt="farm" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen03.png" alt="farm" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen02.png" alt="farm" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-nouen01.png" alt="farm" />
      </div>
    </div>
    <div class="panel">
      <p class="text">
        私たちの牧場は、自然と動物との共存を尊重し、<br class="sp" />持続可能な農業の原則に基づいて運営されています。<br />広々とした環境で、動物たちとのふれ合いを<br class="sp" />通じて、自然の恵みと動物の尊さを感じ、<br />心温まるひとときを過ごしていただけます。
      </p>
      <div class="slider">
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo04.png" alt="ranch" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo03.png" alt="ranch" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo02.png" alt="ranch" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-bokujo01.png" alt="ranch" />
      </div>
    </div>
    <div class="panel">
      <p class="text">
        自然の恵み農園から直接お届けする、<br class="sp" />新鮮で美味しい農産物と<br />手作りのジャムやバターなどの<br class="sp" />加工品を提供しています。<br />自然の恩恵をご自宅でお楽しみいただけます。
      </p>
      <div class="slider">
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec04.png" alt="sales" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec03.png" alt="sales" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec02.png" alt="sales" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/work-ec01.png" alt="sales" />
      </div>
    </div>
  </div>
</div>

<!-- FAQ -->
<div id="faq">
  <div class="faq-title">
    <h2 class="text40">よくあるご質問</h2>
    <div class="faq-line">
      <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
    </div>
  </div>
  <div class="faq-wrapper">
    <div class="faq-box">
      <div class="question-box">
        <p class="question-text">
          農園の野菜や果物は有機栽培ですか？
        </p>
      </div>
      <div class="answer-box">
        <p class="answer-text">
          はい、私たちの農園では有機栽培の原則に従って野菜と果物を栽培しています。<br />
          化学肥料や農薬を極力使用せず、土壌と作物の健康を第一に考えております。
        </p>
      </div>
    </div>
    <div class="faq-box">
      <div class="question-box">
        <p class="question-text">
          農園での見学や体験ツアーは行っていますか？
        </p>
      </div>
      <div class="answer-box">
        <p class="answer-text">
          はい、農園での見学や体験ツアーを随時開催しています。<br />
          農場の日常や農作業を親しみやすく説明し、実際に農園での体験を楽しむことができます。
        </p>
      </div>
    </div>
    <div class="faq-box">
      <div class="question-box">
        <p class="question-text">
          オンラインで注文した農産物はどのように配送されますか？
        </p>
      </div>
      <div class="answer-box">
        <p class="answer-text">
          オンラインで注文いただいた農産物は、専用の梱包で新鮮さを保ったまま、<br />
          指定された配送先にお届けします。
        </p>
      </div>
    </div>
    <div class="faq-box">
      <div class="question-box">
        <p class="question-text">
          農園で提供される季節ごとの野菜や果物の品種は何ですか？
        </p>
      </div>
      <div class="answer-box">
        <p class="answer-text">
          春にはイチゴ、夏にはトマトや茄子、秋にはカボチャやリンゴ、冬にはブロッコリーやみかん<br />
          など、季節に応じた野菜、果物を提供、収穫体験することができます。
        </p>
      </div>
    </div>
  </div>
</div>

<!-- info -->
<div id="info">
  <div class="info-title">
    <h2 class="text40">お知らせ</h2>
    <div class="info-line">
      <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
    </div>
  </div>
  <div class="info-text">
    <p class="text">
      季節の農作物のお知らせ、見学ツアーのご案<br class="sp" />内、<br class="pc" />オンライン販売セールのお知らせなど、自然の恵み農園<br class="pc" />の最新情報をお届けします。
    </p>
  </div>

  <div class="container">
    <div class="info-box">
      <?php
      $args = array(
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date',
      );
      $postslist = get_posts($args);
      foreach ($postslist as $post) :
        setup_postdata($post); ?>

        <a href="<?php the_permalink(); ?>">
          <p class="day">
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?>
            </time>

            <?php
            $cats = get_the_category();
            foreach ($cats as $cat) {
              echo '<span class="category">' . $cat->name . '</span>';
            }
            ?>
          </p>

          <p class="text20"><?php the_title(); ?></p>
        </a>

      <?php
      endforeach;
      wp_reset_postdata(); ?>
    </div>
    <div class="info-box">
      <?php
      $args = array(
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date',
        'offset'         => 1,
      );
      $postslist = get_posts($args);
      foreach ($postslist as $post) :
        setup_postdata($post); ?>

        <a href="<?php the_permalink(); ?>">
          <p class="day">
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?>
            </time>

            <?php
            $cats = get_the_category();
            foreach ($cats as $cat) {
              echo '<span class="category">' . $cat->name . '</span>';
            }
            ?>
          </p>

          <p class="text20"><?php the_title(); ?></p>
        </a>

      <?php
      endforeach;
      wp_reset_postdata(); ?>
    </div>
    <div class="info-box">
      <?php
      $args = array(
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date',
        'offset'         => 2,
      );
      $postslist = get_posts($args);
      foreach ($postslist as $post) :
        setup_postdata($post); ?>

        <a href="<?php the_permalink(); ?>">
          <p class="day">
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?>
            </time>

            <?php
            $cats = get_the_category();
            foreach ($cats as $cat) {
              echo '<span class="category">' . $cat->name . '</span>';
            }
            ?>
          </p>

          <p class="text20"><?php the_title(); ?></p>
        </a>

      <?php
      endforeach;
      wp_reset_postdata(); ?>
    </div>
  </div>

  <a href="<?php echo home_url(); ?>/top/archive/" class="more-btn">
    <div class="more">
      View More
    </div>
  </a>


</div>

<!-- access -->
<div id="access">
  <div class="access-title">
    <h2 class="text40">アクセス</h2>
    <div class="access-line">
      <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
    </div>
  </div>
  <div class="container">
    <div class="location">
      <ul>
        <li class="text20">会社名</li>
        <li class="text20">所在地</li>
        <li class="text20">電話番号</li>
        <li class="text20">営業時間</li>
      </ul>
      <p class="text20">Googleマップ</p>
      <a class="text16" aria-label="拡大地図を表示" target="_blank" jstcache="31" href="https://maps.google.com/maps?ll=35.760458,140.061538&amp;z=14&amp;t=m&amp;hl=ja&amp;gl=JP&amp;mapclient=embed&amp;cid=15334165452323813764" jsaction="mouseup:placeCard.largerMap">拡大地図を表示</a>
    </div>
    <div class="location-info">
      <address class="location-address">
        <p>株式会社自然の恵み農園</p>
        <p>
          〒123-4567 <br class="sp" />
          千葉県〇〇市××町<br class="sp" />
          1丁目23-45
        </p>
        <p>012-3456-7890</p>
        <p>
          10:00〜18:00<br class="sp" />
          （土日祝を除く）
        </p>
      </address>
    </div>
    <div class="location-map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21778.460319406986!2d140.0478957058432!3d35.765856699519894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60227e5329d23245%3A0xd4cde63c28d3f984!2z44G144Gq44Gw44GX44Ki44Oz44OH44Or44K744Oz5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1713698087440!5m2!1sja!2sjp" width="710" height="300" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</div>

<?php get_template_part('parts', 'contact'); ?>
<?php get_footer(); ?>