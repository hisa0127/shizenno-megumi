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
 * 投稿スラッグを投稿IDに自動変換（固定ページを除く）
 */
function auto_post_slug_to_id($slug, $post_ID, $post_status, $post_type)
{
    // 固定ページとサービス投稿タイプは除外する
    if ($post_type === 'page' || $post_type === 'service') {
        return $slug;
    }

    // パブリックな投稿タイプのみ対象とする場合
    $post_type_object = get_post_type_object($post_type);
    if ($post_type_object && $post_type_object->public) {
        // スラッグを投稿IDに置き換える
        $slug = (string) $post_ID;
    }
    return $slug;
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
