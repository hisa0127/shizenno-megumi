<?php
/*
Template Name: article
*/
?>
<?php get_header(); ?>
<!-- news -->
<div class="news">
    <div class="news-wapper" data-name="detail">
        <div class="bread">
            <?php breadcrumb(); ?>
        </div>
        <div class="post-title">
            <?php
            if (mb_strlen($post->post_title) > 20) {
                $title = mb_substr($post->post_title, 0, 20);
                echo $title;
            } else {
                echo $post->post_title;
            }
            ?>
        </div>
        <div class="post-data">
            <p class="post__time">
                <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>

                <?php
                $cats = get_the_category();
                foreach ($cats as $cat) {
                    echo '<span class="category">' . $cat->name . '</span>';
                }
                ?>
            </p>
        </div>
    </div>

    <div class="post-area">

        <div id="primary" class="content-area">
            <main id="main" class="site-main">

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <!-- 繰り返したい内容　ここから -->
                        <div class="post__item-inner">

                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                            <?php else : ?>
                                <!-- 代替の画像を表示させる -->
                                <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="">
                            <?php endif; ?>
                        </div><!-- /.post__item-inner -->
                        <!-- 繰り返したい内容　ここまで -->
                    <?php endwhile; ?>
                <?php endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <div class="contents-box">
            <p class="text20">目次</p>
            <ol class="contents-list">
                <a href="#h2-line-title1">
                    <li class="heading">
                        <h2 class="sub-title">
                            <?php the_field('h2-title'); ?>
                        </h2>
                        <ul>
                            <a href="#h3-title1">
                                <li class="lead">
                                    <h3 class="sub--title"><?php the_field('h3-title'); ?></h3>
                                </li>
                            </a>
                        </ul>
                    </li>
                </a>
                <a href="#h2-line-title2">
                    <li class="heading">
                        <h2 class="sub-title">
                            <?php the_field('h2-title'); ?>
                        </h2>
                        <ul>
                            <a href="#h3-title2">
                                <li class="lead">
                                    <h3 class="sub--title">
                                        <?php the_field('h3-title'); ?>
                                    </h3>
                                </li>
                            </a>
                        </ul>
                    </li>
                </a>
            </ol>
        </div>
        <div id="h2-line-title1">
            <?php the_field('h2-title'); ?>
        </div>
        <div class="text">
            <?php the_field('text'); ?>
        </div>
        <div id="h3-title1">
            <?php the_field('h3-title'); ?>
        </div>
        <ul class="h3-list">
            <li class="list"><?php the_field('list'); ?></li>
            <li class="list"><?php the_field('list'); ?></li>
            <li class="list"><?php the_field('list'); ?></li>
            <li class="list"><?php the_field('list'); ?></li>
            <li class="list"><?php the_field('list'); ?></li>
        </ul>
        <div class="text">
            <?php the_field('text'); ?>
        </div>
        <div id="h2-line-title2">
            <?php the_field('h2-title'); ?>
        </div>
        <div class="img-box">
            <div class="img-text">
                <?php the_field('text'); ?>
            </div>
            <img src="<?php the_field('img'); ?>" class="img">
        </div>
        <div id="h3-title2">
            <?php the_field('h3-title'); ?>
        </div>
        <div class="text">
            <?php the_field('text'); ?>
        </div>

        <span class="info-menu"><a href="<?php echo home_url("archive"); ?>" class="info-btn">
                一覧に戻る
            </a>
        </span>
    </div>
</div>

<?php get_template_part('parts', 'contact'); ?>

<?php get_footer(); ?>