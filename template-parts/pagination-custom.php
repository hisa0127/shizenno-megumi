<?php
/**
 * カスタムクエリ用ページネーション
 *
 * メインクエリではなく、呼び出し側で独自に組み立てた WP_Query に対応する
 * ページネーション部品。通常投稿・カスタム投稿タイプどちらの WP_Query でも
 * 使い回せる。呼び出し側のローカル変数はここに自動で渡らないため、
 * $args で明示的に query / paged を渡す。
 *
 * 使い方:
 * get_template_part('template-parts/pagination-custom', null, array(
 *     'query'        => $archive_query, // ページネーション対象の WP_Query（必須）
 *     'paged'        => $paged,         // 現在のページ番号（必須）
 *     'class_prefix' => 'p-archive__pagination', // BEMのブロック名（省略可）
 * ));
 */

$query        = $args['query'] ?? null;
$paged        = $args['paged'] ?? 1;
$class_prefix = $args['class_prefix'] ?? 'p-pagination';

if (! $query instanceof WP_Query) {
    return;
}

$max_pages = $query->max_num_pages;

if ($max_pages <= 1) {
    return;
}

$big = 999999999;
$paginate_links = paginate_links(array(
    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'    => '?paged=%#%',
    'current'   => max(1, $paged),
    'total'     => $max_pages,
    'prev_text' => '<img src="' . get_template_directory_uri() . '/images/left-single.png" alt="前へ">',
    'next_text' => '<img src="' . get_template_directory_uri() . '/images/right-single.png" alt="次へ">',
    'mid_size'  => 1,
    'end_size'  => 1,
    'type'      => 'array',
));

if (! $paginate_links) {
    return;
}
?>
<nav class="<?php echo esc_attr($class_prefix); ?>" aria-label="ページネーション">
    <ul class="<?php echo esc_attr($class_prefix); ?>-list">
        <?php foreach ($paginate_links as $link) :
            $link = str_replace('page-numbers', $class_prefix . '-number', $link);
            $link = str_replace('current', $class_prefix . '-number--current', $link);
            $link = str_replace('prev', $class_prefix . '-arrow ' . $class_prefix . '-arrow--prev', $link);
            $link = str_replace('next', $class_prefix . '-arrow ' . $class_prefix . '-arrow--next', $link);
            $link = str_replace('dots', $class_prefix . '-dots', $link);
        ?>
            <li class="<?php echo esc_attr($class_prefix); ?>-item"><?php echo $link; ?></li>
        <?php endforeach; ?>
    </ul>
</nav>
