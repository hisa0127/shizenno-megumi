<?php
/*
Template Name: contact
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
  <p class="text">お仕事のご相談、農園体験、牧場の見学、<br class="sp">その他ご質問など、お気軽にお問い合わせください。</p>
  <div class="form-wrapper">

    <?php echo do_shortcode('[contact-form-7 id="937f95f" title="お問い合わせ"]'); ?>

  </div>
</div>

<?php get_footer(); ?>