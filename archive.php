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
      <div class="p-archive__breadcrumb">
        <?php breadcrumb(); ?>
      </div>
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
      echo '<button class="' . $all_tab_class . '" role="tab" aria-selected="' . $all_tab_aria . '" aria-controls="archive-posts"><a href="' . home_url("archive") . '">すべて</a></button>';
      ?>

      <?php
      // カテゴリータブ
      $categories = get_categories();
      foreach ($categories as $category) {
        $is_current_category = is_category($category->term_id);
        $tab_class = $is_current_category ? 'p-archive__tab p-archive__tab--active' : 'p-archive__tab';
        $tab_aria = $is_current_category ? 'true' : 'false';

        echo '<button class="' . $tab_class . '" role="tab" aria-selected="' . $tab_aria . '" aria-controls="archive-posts"><a href="' . get_category_link($category->term_id) . '">' . esc_html($category->name) . '</a></button>';
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
          'cat' => is_category() ? get_cat_ID(single_cat_title('', false)) : 0
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

                    <?php
                    $cats = get_the_category();
                    foreach ($cats as $cat) {
                      echo '<span class="p-archive__post-category pc">' . esc_html($cat->name) . '</span>';
                    }
                    ?>
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
                <?php
                $cats = get_the_category();
                foreach ($cats as $cat) {
                  echo '<span class="p-archive__post-category sp">' . esc_html($cat->name) . '</span>';
                }
                ?>
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
      <nav class="p-archive__pagination" aria-label="ページネーション">
        <?php
        $max_pages = $archive_query->max_num_pages;
        $total_posts = $archive_query->found_posts;

        if ($total_posts >= 10) {
          $big = 999999999;
          $paginate_links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, $paged),
            'total' => $max_pages,
            'prev_text' => '<img src="' . get_template_directory_uri() . '/images/left-single.png" alt="前へ">',
            'next_text' => '<img src="' . get_template_directory_uri() . '/images/right-single.png" alt="次へ">',
            'mid_size' => 1,
            'end_size' => 1,
            'type' => 'array'
          ));

          if ($paginate_links) {
            echo '<ul class="p-archive__pagination-list">';
            foreach ($paginate_links as $link) {
              // WordPressのクラスをBEM記法に置き換え
              $link = str_replace('page-numbers', 'p-archive__pagination-number', $link);
              $link = str_replace('current', 'p-archive__pagination-number--current', $link);
              $link = str_replace('prev', 'p-archive__pagination-arrow p-archive__pagination-arrow--prev', $link);
              $link = str_replace('next', 'p-archive__pagination-arrow p-archive__pagination-arrow--next', $link);
              $link = str_replace('dots', 'p-archive__pagination-dots', $link);

              echo '<li class="p-archive__pagination-item">' . $link . '</li>';
            }
            echo '</ul>';
          }
        }
        ?>
      </nav>
    </div>
  </div>
</section>

<?php get_template_part('parts', 'contact'); ?>

<?php get_footer(); ?>