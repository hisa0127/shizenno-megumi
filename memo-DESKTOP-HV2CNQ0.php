<div class="pagination">
    <div class="list-box">
        <ul>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $the_query = new WP_Query(array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'paged' => $paged,
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            // ページ数の算出
            $total_posts = $the_query->found_posts;
            $max_pages = ceil($total_posts / 10); // 1ページあたりの投稿数に合わせて変更
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
            ?>
                    <?php
                    /*　ここにループさせるコンテンツを入れてください　*/
                    ?>
            <?php
                endwhile;
            else :
                echo '<div><p>記事がありません。</p></div>';
            endif;
            ?>
        </ul>
    </div>

    <div class="pnavi">
        <?php
        global $wp_rewrite;
        $paginate_base = get_pagenum_link(1);
        if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
            $paginate_format = '';
            $paginate_base = add_query_arg('paged', '%#%');
        } else {
            $paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') .
                user_trailingslashit('page/%#%/', 'paged');
            $paginate_base .= '%_%';
        }
        echo paginate_links(array(
            'base' => $paginate_base,
            'format' => $paginate_format,
            'total' => $max_pages,
            'mid_size' => 1,
            'current' => ($paged ? $paged : 1),
            'prev_text' => '<img src="' . get_template_directory_uri() . '/images/left-single.png">',
            'next_text' => '<img src="' . get_template_directory_uri() . '/images/right-single.png">',
        ));
        ?>
    </div>
</div>

<article class="s-info__article fadein fadein-up">
    <div class="s-info__inner">
        <time datetime="the_time( 'Y-m-d' )">
            <?php the_time('Yねんmがつdにち'); ?>
        </time>
        <h1 class="fadein fadein-up"><?php the_title(); ?>
        </h1>
        <?php if (get_the_post_thumbnail_url()) : ?>
            <img width="640" height="320" src="<?php echo get_the_post_thumbnail_url(); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image s-info__img fadein fadein-up" alt="">
        <?php else : ?>
            <img width="640" height="320" src="<?php echo get_template_directory_uri(); ?>/img/wp/no-image.webp" class="attachment-post-thumbnail size-post-thumbnail wp-post-image s-info__img fadein fadein-up" alt="">
        <?php endif; ?>
        <?php the_content(); ?>
    </div>
    <a href="<?php echo home_url("news"); ?>" class="s-info__button c-button fadein fadein-up">
        <span>お知らせ一覧へ</span>
        <i class="fa-solid fa-angle-right"></i>
    </a>
</article>


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$the_query = new WP_Query(
    array(
        'paged' => $paged,
        'posts_per_page' => 5
    )
);

$total_posts = $the_query->found_posts;

if ($total_posts >= 5) {
    $max_pages = $the_query->max_num_pages;

    $paginate_args = array(
        'total' => $max_pages,
        'current' => max(1, $paged),
        'prev_text' => __('<img src="' . get_template_directory_uri() . '/images/left-single.png">'),
        'next_text' => __('<img src="' . get_template_directory_uri() . '/images/right-single.png">'),
        'type' => 'array', // リンクを配列で取得
        'end_size' => 1, // 最初と最後のページの表示数
        'mid_size' => 1, // 現在のページの前後の表示数
    );

    $paginate_links = paginate_links($paginate_args);

    if ($paginate_links) {
        // 最初のページへのリンクを追加
        if ($paged > 1) {
            array_unshift($paginate_links, '<a class="page-numbers first" href="' . get_pagenum_link(1) . '"><img src="' . get_template_directory_uri() . '/images/left.png"></a>');
        }

        // 最後のページへのリンクを追加
        if ($paged < $max_pages) {
            array_push($paginate_links, '<a class="page-numbers last" href="' . get_pagenum_link($max_pages) . '"><img src="' . get_template_directory_uri() . '/images/right.png"></a>');
        }

        echo '<nav class="pagination">';
        foreach ($paginate_links as $link) {
            echo $link;
        }
        echo '</nav>';
    } else {
        echo '<span class="page-numbers current">' . $paginate_args['current'] . '</span>';
    }
}
?>

<input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required wpcf7-not-valid" aria-required="true" aria-invalid="true" placeholder="" value="" type="text" name="your-name" aria-describedby="wpcf7-f65-o1-ve-your-name">

<input size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email wpcf7-not-valid" autocomplete="email" aria-required="true" aria-invalid="true" value="" type="email" name="your-email" aria-describedby="wpcf7-f65-o1-ve-your-email">

<input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="" value="" type="text" name="your-name">

<input size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" autocomplete="email" aria-required="true" aria-invalid="false" value="" type="email" name="your-email">