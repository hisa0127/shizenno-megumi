<?php
/*
Template Name: contact-confirm
*/
?>
<?php get_header(); ?>

<div class="contact-form">
    <nav class="bread">
        <?php breadcrumb(); ?>
    </nav>
    <div class="contact-form-title">
        <h2 class="text40">お問い合わせ</h2>
        <div class="contact-form-line">
            <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
        </div>
    </div>

    <div class="confirm-wrapper">
        <?php echo do_shortcode('[contact-form-7 id="9c52e78" title="お問い合わせ（確認画面）"]'); ?>

    </div>
</div>
<?php get_footer(); ?>