<?php
/*
Template Name: contact
*/
?>
<?php get_header(); ?>

<!-- お問い合わせセクション -->
<section class="p-contact" aria-label="お問い合わせ">
    <div class="p-contact__container">
        <!-- ブレッドクラム -->
        <nav class="p-contact__breadcrumb">
            <?php breadcrumb(); ?>
        </nav>

        <!-- ページタイトル -->
        <div class="p-contact__title">
            <h1 class="p-contact__heading heading"><?php the_title(); ?></h1>
        </div>

        <p class="p-contact__intro">
            お仕事のご相談、農園体験、牧場の見学、<br class="sp">その他ご質問など、お気軽にお問い合わせください。
        </p>

        <!-- コンタクトフォーム -->
        <div class="p-contact__form-wrapper">
            <?php echo do_shortcode('[contact-form-7 id="4734990" title="コンタクトフォーム"]'); ?>
        </div>
    </div>
</section>

<?php get_template_part('parts', 'contact'); ?>

<?php get_footer(); ?>