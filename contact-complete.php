<?php
/*
Template Name: contact-complete
*/
?>
<?php get_header(); ?>

<div class="contact-form">
    <div class="bread">
        <?php breadcrumb(); ?>
    </div>
    <div class="contact-form-title">
        <h2 class="text40">お問い合わせ</h2>
        <div class="contact-form-line">
            <img src="<?php echo get_template_directory_uri(); ?>/images/title-line.png" alt="line" />
        </div>
    </div>

    <div class="thanks-wrapper">
        <div class="thanks-text">
            <p class="text20">お問い合わせ<br class="sp">ありがとうございました。</p>
        </div>
        <div class="reply">
            <p class="reply-text">担当者より<br class="sp">5営業日以内に返信いたします。<br>お急ぎの場合は、<br class="sp">お電話にてお問い合わせください。</p>
        </div>
        <div class="contact-tel">
            <p class="text20">問い合わせ電話：<br class="sp"><span class="text30">123-4567-8910</span></p>
            <p class="text20">【受付時間】<br class="sp">10:00 ~ 18:00（土日祝を除く）</p>
        </div>
        <div class="return-box">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <p>TOPに戻る</p>
            </a>
        </div>
    </div>
</div>
<?php get_footer(); ?>