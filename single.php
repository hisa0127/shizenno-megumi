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
                        $full_content    = '';
                        $toc_items       = array();
                        $h2_count        = 0;
                        $h3_count        = 0;
                        $current_h2_index = -1;

                        if (class_exists('SCF')) :
                            $blocks = SCF::get('content_blocks');

                            if (!empty($blocks)) :
                                foreach ($blocks as $block) :
                                    $block_type    = isset($block['block_type'])    ? $block['block_type']    : '';
                                    $heading_text  = isset($block['heading_text'])  ? $block['heading_text']  : '';
                                    $heading_level = isset($block['heading_level']) ? $block['heading_level'] : 'h2';
                                    $body_text     = isset($block['body_text'])     ? $block['body_text']     : '';
                                    $image         = isset($block['image'])         ? $block['image']         : '';
                                    $list_items    = isset($block['list_items'])    ? $block['list_items']    : '';

                                    switch ($block_type) :

                                        case 'heading':
                                            if ($heading_text) :
                                                if ($heading_level === 'h3') :
                                                    $h3_count++;
                                                    $h3_id = 'p-single__subsection-' . $h3_count;
                                                    if ($current_h2_index >= 0) :
                                                        $toc_items[$current_h2_index]['children'][] = array(
                                                            'id'   => $h3_id,
                                                            'text' => $heading_text,
                                                        );
                                                    endif;
                                                    $full_content .= '<h3 id="' . esc_attr($h3_id) . '">' . esc_html($heading_text) . '</h3>';
                                                else :
                                                    $h2_count++;
                                                    $h2_id = 'p-single__section-' . $h2_count;
                                                    $toc_items[] = array(
                                                        'id'       => $h2_id,
                                                        'text'     => $heading_text,
                                                        'children' => array(),
                                                    );
                                                    $current_h2_index = count($toc_items) - 1;
                                                    $full_content .= '<h2 id="' . esc_attr($h2_id) . '">' . esc_html($heading_text) . '</h2>';
                                                endif;
                                            endif;
                                            break;

                                        case 'text':
                                            if ($image) :
                                                $full_content .= '<div class="is-layout-flex">';
                                                $full_content .= '<div class="is-layout-flex__text">';
                                                if ($body_text) :
                                                    $full_content .= '<p>' . nl2br(esc_html($body_text)) . '</p>';
                                                endif;
                                                $full_content .= '</div>';
                                                $full_content .= '<div class="wp-block-image">';
                                                $full_content .= wp_get_attachment_image($image, 'large');
                                                $full_content .= '</div>';
                                                $full_content .= '</div>';
                                            else :
                                                if ($body_text) :
                                                    $full_content .= '<p>' . nl2br(esc_html($body_text)) . '</p>';
                                                endif;
                                            endif;
                                            break;

                                        case 'list':
                                            if ($list_items) :
                                                $full_content .= '<ul>';
                                                $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", $list_items));
                                                foreach ($lines as $line) :
                                                    if (trim($line)) :
                                                        $full_content .= '<li>' . esc_html(trim($line)) . '</li>';
                                                    endif;
                                                endforeach;
                                                $full_content .= '</ul>';
                                            endif;
                                            break;

                                    endswitch;
                                endforeach;
                            endif;
                        endif;
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
                            <?php echo $full_content; ?>
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
