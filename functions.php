<?php
// favicon
function add_favicon()
{
    $template_uri = get_template_directory_uri();
    echo '<link rel="icon" type="image/x-icon" href="' . $template_uri . '/images/favicon.ico" />' . "\n";
    echo '<link rel="apple-touch-icon" href="' . $template_uri . '/images/apple-touch-icon.png" />' . "\n";
}
add_action('wp_head', 'add_favicon');
add_action('admin_head', 'add_favicon'); // WordPress管理画面用
function theme_setup()
{
    // アイキャッチ有効化
    add_theme_support('post-thumbnails');
    // RSSフィードリンクを自動生成する
    add_theme_support('automatic-feed-links');
    // titleタグを自動生成する
    add_theme_support('title-tag');
    // HTML5によるマークアップを行う
    add_theme_support(
        'html5',
        array(
            'search-form',
            'gallery',
            'caption',
        )
    );
}
add_action('after_setup_theme', 'theme_setup');

add_post_type_support('page', 'excerpt');

function script_init()
{
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    // GoogleFonts
    wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&display=swap');
    // CSS
    wp_enqueue_style('my_style', get_theme_file_uri('css/style.css'), array(), filemtime(get_theme_file_path('css/style.css')), 'all');
    // JS
    wp_enqueue_script('my_script', get_theme_file_uri('js/main.js'), array('jquery'), filemtime(get_theme_file_path('js/main.js')), true);
}
add_action('wp_enqueue_scripts', 'script_init');

/**
 * 投稿編集画面（投稿の新規追加・編集）でのみ、
 * SCFのcontent_blocksリピーターをblock_typeに応じて出しわけるJSを読み込む。
 *
 * @param string $hook_suffix 現在の管理画面のスクリーンID
 */
function admin_content_blocks_script($hook_suffix)
{
    if (!in_array($hook_suffix, ['post.php', 'post-new.php'], true)) {
        return;
    }

    wp_enqueue_script(
        'admin-content-blocks',
        get_theme_file_uri('js/admin-content-blocks.js'),
        array('jquery'),
        filemtime(get_theme_file_path('js/admin-content-blocks.js')),
        true
    );
}
add_action('admin_enqueue_scripts', 'admin_content_blocks_script');

/**
 * 投稿スラッグを投稿IDに自動変換（固定ページは除く）
 */
function auto_post_slug_to_id($slug, $post_ID, $post_status, $post_type)
{
    // 固定ページは除外
    if ($post_type === 'page') {
        return $slug;
    }

    return (string) $post_ID;
}
add_filter('wp_unique_post_slug', 'auto_post_slug_to_id', 10, 4);

/**
 * パンくずリスト
 * Yoast SEO が有効な場合はYoastのデータを活用しつつ、
 * 自前のHTML構造（ul/li）で出力する。
 * Yoast SEO が無効な場合はフォールバックで自前処理。
 */
function breadcrumb() {
    if ( is_front_page() ) return;

    echo '<ul class="breadcrumb__list">';

    if ( function_exists( 'yoast_breadcrumb' ) ) {
        breadcrumb_yoast();
    } else {
        breadcrumb_fallback();
    }

    echo '</ul>';
}


/**
 * Yoast SEO 版
 * Yoastのパンくずデータを取得して自前のli構造で出力する
 */
function breadcrumb_yoast() {
    $breadcrumbs = YoastSEO()->meta->for_current_page()->breadcrumbs;

    if ( empty( $breadcrumbs ) ) {
        breadcrumb_fallback();
        return;
    }

    $last_index = count( $breadcrumbs ) - 1;

    foreach ( $breadcrumbs as $index => $crumb ) {
        $is_last = ( $index === $last_index );
        $text    = esc_html( $crumb['text'] );
        $url     = isset( $crumb['url'] ) ? esc_url( $crumb['url'] ) : '';

        if ( $is_last || empty( $url ) ) {
            echo '<li class="breadcrumb__item breadcrumb__item--current">' . $text . '</li>';
        } else {
            echo '<li class="breadcrumb__item"><a class="breadcrumb__link" href="' . $url . '">' . $text . '</a></li>';
        }
    }
}


/**
 * フォールバック版（Yoast SEO なし）
 * 自前でパンくずを組み立てて出力する
 */
function breadcrumb_fallback() {
    $home  = esc_url( home_url('/') );
    $items = [];
    $items[] = '<li class="breadcrumb__item"><a class="breadcrumb__link" href="' . $home . '">ホーム</a></li>';

    if ( is_category() ) {
        $items[] = '<li class="breadcrumb__item"><a class="breadcrumb__link" href="' . esc_url( home_url('archive') ) . '">お知らせ一覧</a></li>';
        $items   = array_merge( $items, breadcrumb_cat_ancestors() );
        $items[] = '<li class="breadcrumb__item breadcrumb__item--current">' . esc_html( single_cat_title( '', false ) ) . '</li>';

    } elseif ( is_home() ) {
        $items[] = '<li class="breadcrumb__item breadcrumb__item--current">お知らせ一覧</li>';

    } elseif ( is_single() ) {
        $items[] = '<li class="breadcrumb__item"><a class="breadcrumb__link" href="' . esc_url( home_url('archive') ) . '">お知らせ一覧</a></li>';
        $items   = array_merge( $items, breadcrumb_cat_ancestors_for_post() );
        $items[] = '<li class="breadcrumb__item breadcrumb__item--current">' . esc_html( get_the_title() ) . '</li>';

    } elseif ( is_page() ) {
        $items[] = '<li class="breadcrumb__item breadcrumb__item--current">' . esc_html( get_the_title() ) . '</li>';

    } elseif ( is_404() ) {
        $items[] = '<li class="breadcrumb__item breadcrumb__item--current">ページが見つかりません</li>';
    }

    echo implode( '', $items );
}


/**
 * カテゴリページ用：親カテゴリのli一覧を返す
 */
function breadcrumb_cat_ancestors() {
    $cat    = get_queried_object();
    $cat_id = $cat ? $cat->parent : 0;
    return breadcrumb_build_cat_list( $cat_id );
}


/**
 * 投稿ページ用：親カテゴリのli一覧を返す
 */
function breadcrumb_cat_ancestors_for_post() {
    $cats = get_the_category();
    if ( empty( $cats ) ) return [];
    return breadcrumb_build_cat_list( $cats[0]->parent );
}


/**
 * カテゴリIDを起点に祖先カテゴリのli配列を組み立てる（共通処理）
 */
function breadcrumb_build_cat_list( $cat_id ) {
    $list = [];
    while ( $cat_id != 0 ) {
        $cat    = get_category( $cat_id );
        $list[] = '<li class="breadcrumb__item"><a class="breadcrumb__link" href="' . esc_url( get_category_link( $cat_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
        $cat_id = $cat->parent;
    }
    return array_reverse( $list );
}


/**
 * アーカイブタイトルのプレフィックスを削除
 */
add_filter( 'get_the_archive_title', function ( $title ) {
    if ( is_category() )     return single_cat_title( '', false );
    if ( is_tag() )          return single_tag_title( '', false );
    if ( is_month() )        return get_the_date( 'Y年n月' );
    return $title;
} );

/**
 * SCFの繰り返しフィールド「content_blocks」を、記事本文のHTML文字列と
 * 目次（TOC）データに変換する。
 *
 * single.php 側はこの関数を1回呼ぶだけでよく、ブロックの種類ごとの
 * 変換ロジックはテンプレートファイルから完全に切り離されている。
 *
 * @param array $blocks SCF::get('content_blocks') の返り値
 * @return array{html: string, toc: array} 本文HTML と 目次データ
 */
function render_content_blocks(array $blocks): array {
    if (empty($blocks)) {
        return ['html' => '', 'toc' => []];
    }

    // ブロックの種類（block_type）ごとの担当関数の対応表。
    // ブロックの種類を増やしたいときは、SCF側にサブフィールドを追加した上で
    // ここに1行追加するだけでよく、single.php を触る必要はない。
    $renderers = [
        'heading' => 'render_content_block_heading',
        'text'    => 'render_content_block_text',
        'list'    => 'render_content_block_list',
    ];

    $html_parts = [];
    $context = [
        'toc'              => [],
        'h2_count'         => 0,
        'h3_count'         => 0,
        'current_h2_index' => -1,
    ];

    foreach ($blocks as $block) {
        $type = $block['block_type'] ?? '';

        if (!isset($renderers[$type])) {
            continue; // 未対応のブロックタイプは無視する
        }

        $html_parts[] = $renderers[$type]($block, $context);
    }

    return [
        'html' => implode('', $html_parts),
        'toc'  => $context['toc'],
    ];
}

/**
 * heading ブロックを <h2>/<h3> に変換し、目次データ（$context['toc']）も同時に育てる。
 *
 * $context は参照渡し。h2が出てくるたびに toc に新しい項目を追加して
 * current_h2_index を更新し、直後に出てくるh3はその項目の children にぶら下げる。
 */
function render_content_block_heading(array $block, array &$context): string {
    $text  = $block['heading_text']  ?? '';
    $level = $block['heading_level'] ?? 'h2';

    if ($text === '') {
        return '';
    }

    if ($level === 'h3') {
        $context['h3_count']++;
        $id = 'p-single__subsection-' . $context['h3_count'];

        // h2が1つも無いままh3が出てきた場合は、目次には追加せず本文にのみ出力する
        if ($context['current_h2_index'] >= 0) {
            $context['toc'][$context['current_h2_index']]['children'][] = [
                'id'   => $id,
                'text' => $text,
            ];
        }

        return '<h3 id="' . esc_attr($id) . '">' . esc_html($text) . '</h3>';
    }

    $context['h2_count']++;
    $id = 'p-single__section-' . $context['h2_count'];

    $context['toc'][] = [
        'id'       => $id,
        'text'     => $text,
        'children' => [],
    ];
    $context['current_h2_index'] = count($context['toc']) - 1;

    return '<h2 id="' . esc_attr($id) . '">' . esc_html($text) . '</h2>';
}

/**
 * text ブロックを <p> に変換する。画像フィールドが入力されていれば
 * 本文と画像を横並びにする is-layout-flex 構造で出力する。
 */
function render_content_block_text(array $block): string {
    $body  = $block['body_text'] ?? '';
    $image = $block['image']     ?? '';

    $paragraph = $body !== '' ? '<p>' . nl2br(esc_html($body)) . '</p>' : '';

    if (!$image) {
        return $paragraph;
    }

    return '<div class="is-layout-flex">'
         . '<div class="is-layout-flex__text">' . $paragraph . '</div>'
         . '<div class="wp-block-image">' . wp_get_attachment_image($image, 'large') . '</div>'
         . '</div>';
}

/**
 * list ブロックを <ul><li>...</li></ul> に変換する。
 * list_items は1行1項目のテキストエリアなので、改行で分割して箇条書きにする。
 */
function render_content_block_list(array $block): string {
    $list_items = $block['list_items'] ?? '';

    if ($list_items === '') {
        return '';
    }

    $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", $list_items));
    $items = [];

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line !== '') {
            $items[] = '<li>' . esc_html($line) . '</li>';
        }
    }

    return $items ? '<ul>' . implode('', $items) . '</ul>' : '';
}

/**
 * 現在のThe Loop内の投稿のカテゴリーバッジ（<span>）をまとめて出力する。
 * PC表示用・SP表示用でCSSクラス名の末尾（pc/sp）だけを変えて使う
 * （archive.phpでは同じ内容をPC/SPで別要素として出し分けている）。
 *
 * @param string $variant 'pc' または 'sp'
 */
function print_post_category_badges($variant)
{
    $cats = get_the_category();
    foreach ($cats as $cat) {
        echo '<span class="p-archive__post-category ' . esc_attr($variant) . '">' . esc_html($cat->name) . '</span>';
    }
}

// コンタクトフォーム７カスタム
function my_wpcf7_validation_error_message_kana($result, $tag)
{
    if ('your-email' == $tag->name) {
        if (empty($_POST[$tag->name])) {
            $result->invalidate($tag, '正しいメールアドレスを入力してください');
        }
    }
    return $result;
}
add_filter('wpcf7_validate_text', 'my_wpcf7_validation_error_message_kana', 10, 2);
