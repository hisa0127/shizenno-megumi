<?php
// function add_favicon()
// {
//     echo '<link rel="icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.ico" />';
//     echo '<link rel="apple-touch-icon" href="' . get_template_directory_uri() . '/images/apple-touch-icon.png" />';
// }
// add_action('wp_head', 'add_favicon');
// add_action('admin_head', 'add_favicon'); // WordPress管理画面用
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
    // GoogleFonts
    wp_enqueue_style('googlefonts', 'https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400..700;1,400..700&display=swap');
    // CSS
    wp_enqueue_style('my_style', get_theme_file_uri('css/style.css'));
    // JS
    wp_enqueue_script('my_script', get_theme_file_uri('js/main.js'), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'script_init');


// パンくずリスト
function breadcrumb()
{
    $home = '<li><a href="' . get_bloginfo('url') . '" >ホーム</a></li>';

    echo '<ul>';
    if (is_front_page()) {
        // トップページの場合は表示させない
    }
    // カテゴリページ
    else if (is_category()) {
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0) {
            $cat = get_category($cat_id);
            $cat_link = get_category_link($cat_id);
            array_unshift($cat_list, '<li><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
            $cat_id = $cat->parent;
        }
        echo $home; //ホームのリンクを表示
        echo '<li><a href="' . get_post_type_archive_link('post') . '">お知らせ一覧</a></li>'; // お知らせ一覧のリンクを表示
        foreach ($cat_list as $value) {
            echo $value;
        }
        the_archive_title('<li>', '</li>');
    }
    // アーカイブ・タグページ
    else if (is_home()) {
        echo $home;
        echo '<li>お知らせ一覧</li>';
    }
    // 投稿ページ
    else if (is_single()) {
        $cat = get_the_category();
        if (isset($cat[0]->cat_ID)) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0) {
            $cat = get_category($cat_id);
            $cat_link = get_category_link($cat_id);
            array_unshift($cat_list, '<li><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
            $cat_id = $cat->parent;
        }
        echo $home; //ホームのリンクを表示
        echo '<li><a href="' . get_post_type_archive_link('post') . '">お知らせ一覧</a></li>'; // お知らせ一覧のリンクを表示
        foreach ($cat_list as $value) {
            echo $value;
        }
        the_title('<li>', '</li>');
    }
    // 固定ページ
    else if (is_page()) {
        echo $home;
        the_title('<li>', '</li>');
    }
    // 404ページの場合
    else if (is_404()) {
        echo $home;
        echo '<li>ページが見つかりません</li>';
    }
    echo "</ul>";
}
// アーカイブのタイトルを削除
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_month()) {
        $title = single_month_title('', false);
    }
    return $title;
});

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
