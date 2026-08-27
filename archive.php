<?php
/*
Template Name: archive
*/
?>
<?php get_header(); ?>

<!-- アーカイブセクション -->
<section class="p-archive" aria-label="お知らせ一覧ページ">
  <div class="p-archive__container">
    <div class="p-archive__header">
      <nav class="p-archive__breadcrumb">
        <?php breadcrumb(); ?>
      </nav>
      <div class="p-archive__title">
        <h1 class="p-archive__heading heading">お知らせ一覧</h1>
      </div>
    </div>

    <!-- カテゴリータブナビゲーション -->
    <nav class="p-archive__tabs" role="tablist" aria-label="カテゴリーフィルター">
      <?php
      // すべてタブ
      $all_tab_class = is_category() ? 'p-archive__tab' : 'p-archive__tab p-archive__tab--active';
      $all_tab_aria = is_category() ? 'false' : 'true';
      echo '<button class="' . esc_attr($all_tab_class) . '" role="tab" aria-selected="' . esc_attr($all_tab_aria) . '" aria-controls="archive-posts"><a href="' . esc_url(home_url('archive')) . '">すべて</a></button>';
      ?>

      <?php
      // カテゴリータブ
      $categories = get_categories();
      foreach ($categories as $category) {
        $is_current_category = is_category($category->term_id);
        $tab_class = $is_current_category ? 'p-archive__tab p-archive__tab--active' : 'p-archive__tab';
        $tab_aria = $is_current_category ? 'true' : 'false';

        echo '<button class="' . esc_attr($tab_class) . '" role="tab" aria-selected="' . esc_attr($tab_aria) . '" aria-controls="archive-posts"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></button>';
      }
      ?>
    </nav>

    <!-- 投稿コンテンツ -->
    <div class="p-archive__content" id="archive-posts" role="tabpanel">
      <div class="p-archive__list">
        <?php
        // 固定ページテンプレートとして使用する場合のカスタムループ
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $archive_query = new WP_Query(array(
          'post_type' => 'post',
          'paged' => $paged,
          'posts_per_page' => 10,
          'cat' => is_category() ? get_queried_object_id() : 0
        ));
        ?>

        <?php if ($archive_query->have_posts()) : ?>
          <?php while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
            <article class="p-archive__post">
              <a href="<?php the_permalink(); ?>" class="p-archive__post-link">
                <!-- テキストコンテンツ -->
                <div class="p-archive__post-body">
                  <div class="p-archive__post-meta">
                    <time class="p-archive__post-date" datetime="<?php the_time('Y-m-d'); ?>">
                      <?php the_time('Y.m.d'); ?>
                    </time>

                    <?php /* カテゴリーバッジのspan出力はfunctions.phpのprint_post_category_badges()で定義 */ print_post_category_badges('pc'); ?>
                  </div>

                  <div class="p-archive__post-content">
                    <h2 class="p-archive__post-title">
                      <?php the_title(); ?>
                    </h2>
                    <div class="p-archive__post-excerpt">
                      <p>
                        <?php the_excerpt(); ?>
                      </p>
                    </div>
                  </div>
                </div>
                <?php /* カテゴリーバッジのspan出力はfunctions.phpのprint_post_category_badges()で定義 */ print_post_category_badges('sp'); ?>
                <!-- アイキャッチ画像 -->
                <figure class="p-archive__post-figure">
                  <?php if (has_post_thumbnail()) : ?>
                    <img
                      src="<?php echo get_the_post_thumbnail_url(); ?>"
                      alt="<?php the_title_attribute(); ?>"
                      loading="lazy"
                      decoding="async">
                  <?php else : ?>
                    <img
                      src="<?php echo get_template_directory_uri(); ?>/images/no-image.png"
                      alt="画像なし"
                      loading="lazy"
                      decoding="async">
                  <?php endif; ?>
                </figure>
              </a>
            </article>
          <?php endwhile; ?>
        <?php else : ?>
          <p class="p-archive__no-posts">投稿がありません。</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>

      <!-- ページネーション -->
      <?php
      get_template_part('template-parts/pagination-custom', null, array(
        'query' => $archive_query,
        'paged' => $paged,
        'class_prefix' => 'p-archive__pagination',
      ));
      ?>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/parts', 'contact'); ?>

<?php get_footer(); ?>