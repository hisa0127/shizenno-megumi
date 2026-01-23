<?php
/*
Template Name: article
*/
?>
<?php get_header(); ?>

<!-- 記事詳細セクション -->
<section class="p-single" aria-label="記事詳細">
    <div class="p-single__container">
        <!-- ブレッドクラムと記事タイトル -->
        <div class="p-single__header">
            <nav class="p-single__breadcrumb">
                <?php breadcrumb(); ?>
            </nav>

            <div class="p-single__title-wrapper">
                <h1 class="p-single__title">
                    <?php
                    if (mb_strlen($post->post_title) > 20) {
                        $title = mb_substr($post->post_title, 0, 20);
                        echo esc_html($title);
                    } else {
                        echo esc_html($post->post_title);
                    }
                    ?>
                </h1>
            </div>

            <div class="p-single__meta">
                <time class="p-single__date" datetime="<?php the_time('Y-m-d'); ?>">
                    <?php the_time('Y.m.d'); ?>
                </time>

                <?php
                $cats = get_the_category();
                if ($cats) {
                    echo '<div class="p-single__categories" role="list">';
                    foreach ($cats as $cat) {
                        echo '<span class="p-single__category" role="listitem">' . esc_html($cat->name) . '</span>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="p-single__content">
            <main id="main" class="p-single__main" role="main">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <!-- 記事アイキャッチ画像 -->
                        <figure class="p-single__featured-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <img
                                    src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                                    alt="<?php the_title_attribute(); ?>"
                                    loading="lazy"
                                    decoding="async">
                            <?php else : ?>
                                <img
                                    src="<?php echo esc_url(get_template_directory_uri()); ?>/images/no-image.png"
                                    alt="画像なし"
                                    loading="lazy"
                                    decoding="async">
                            <?php endif; ?>
                        </figure>

                        <?php
                        // コンテンツから見出しを取得
                        ob_start();
                        the_content();
                        $content = ob_get_clean();

                        // h2 と h3 タグを抽出
                        $toc_items = array();
                        $h2_pattern = '/<h2[^>]*>([^<]+)<\/h2>/i';
                        $h3_pattern = '/<h3[^>]*>([^<]+)<\/h3>/i';

                        // h2 を抽出
                        preg_match_all($h2_pattern, $content, $h2_matches);

                        if (!empty($h2_matches[1])) {
                            foreach ($h2_matches[1] as $index => $h2_text) {
                                $h2_id = 'p-single__section-' . ($index + 1);
                                $toc_items[$index] = array(
                                    'id' => $h2_id,
                                    'text' => $h2_text,
                                    'children' => array()
                                );
                            }

                            // h3 を抽出して h2 に紐付ける
                            preg_match_all($h3_pattern, $content, $h3_matches);
                            if (!empty($h3_matches[1])) {
                                $current_h2 = 0;
                                foreach ($h3_matches[1] as $h3_index => $h3_text) {
                                    if (isset($toc_items[$current_h2])) {
                                        $h3_id = 'p-single__subsection-' . ($h3_index + 1);
                                        $toc_items[$current_h2]['children'][] = array(
                                            'id' => $h3_id,
                                            'text' => $h3_text
                                        );
                                        $current_h2++;
                                    }
                                }
                            }
                        }
                        ?>

                        <!-- 目次 -->
                        <?php if (!empty($toc_items)) : ?>
                            <nav class="p-single__toc" aria-label="目次">
                                <h2 class="p-single__toc-title">目次</h2>
                                <ol class="p-single__toc-list">
                                    <?php foreach ($toc_items as $toc_item) : ?>
                                        <li class="p-single__toc-item">
                                            <a href="#<?php echo esc_attr($toc_item['id']); ?>" class="p-single__toc-link">
                                                <?php echo esc_html($toc_item['text']); ?>
                                            </a>
                                            <?php if (!empty($toc_item['children'])) : ?>
                                                <ol class="p-single__toc-sublist">
                                                    <?php foreach ($toc_item['children'] as $child) : ?>
                                                        <li class="p-single__toc-subitem">
                                                            <a href="#<?php echo esc_attr($child['id']); ?>" class="p-single__toc-sublink">
                                                                <?php echo esc_html($child['text']); ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ol>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </nav>
                        <?php endif; ?>

                        <!-- 記事コンテンツ -->
                        <div class="p-single__article">
                            <?php
                            // コンテンツを ID を付与した形式で出力
                            echo preg_replace_callback(
                                '/<h2[^>]*>([^<]+)<\/h2>/i',
                                function ($matches) {
                                    static $h2_count = 0;
                                    $h2_id = 'p-single__section-' . (++$h2_count);
                                    return '<h2 id="' . esc_attr($h2_id) . '" class="p-single__section-title">' . $matches[1] . '</h2>';
                                },
                                $content
                            );
                            ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </main>

            <div class="p-single__footer">
                <a href="<?php echo esc_url(home_url('archive')); ?>" class="p-single__back-link">
                    一覧に戻る
                </a>
            </div>
        </div>

    </div>
</section>

<?php get_template_part('parts', 'contact'); ?>

<?php get_footer(); ?>