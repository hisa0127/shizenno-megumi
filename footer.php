    <!-- footer -->
    <footer class="footer" role="contentinfo">
      <div class="footer__container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo" aria-label="自然の恵み農園ホーム">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg"
            alt="自然の恵み農園"
            loading="lazy"
            decoding="async"
            width="202"
            height="37">
        </a>
        <div class="footer__info">
          <address class="footer__address">
            〒123-4567 <br />
            千葉県〇〇市××町1丁目23-45
          </address>
          <p class="footer__contact">
            TEL:<a href="tel:123-4567-8910" class="footer__phone">123-4567-8910</a> <br />FAX:12-345-6789
          </p>
        </div>
        <nav class="footer__nav" aria-label="フッターメニュー">
          <ul class="footer__nav-list">
            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__nav-link">ホーム</a>
            </li>

            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>#about" class="footer__nav-link">私たちについて</a>
            </li>

            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>#work" class="footer__nav-link">活動紹介</a>
            </li>

            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>#faq" class="footer__nav-link">よくあるご質問</a>
            </li>

            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/archive/')); ?>" class="footer__nav-link">お知らせ</a>
            </li>

            <li class="footer__nav-item">
              <a href="<?php echo esc_url(home_url('/')); ?>#access" class="footer__nav-link">アクセス</a>
            </li>

          </ul>
        </nav>
        <div class="footer__sns" aria-label="ソーシャルメディアリンク">
          <a href="https://twitter.com/?lang=ja" target="_blank" rel="noopener noreferrer" class="footer__sns-link" aria-label="X（旧Twitter）">
            <img src="<?php echo get_template_directory_uri(); ?>/images/x-icon.png" alt="" class="footer__sns-icon" />
          </a>
          <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="footer__sns-link" aria-label="Instagram">
            <img src="<?php echo get_template_directory_uri(); ?>/images/insta-icon.png" alt="" class="footer__sns-icon" />
          </a>
          <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" class="footer__sns-link" aria-label="YouTube">
            <img src="<?php echo get_template_directory_uri(); ?>/images/youtube-icon.png" alt="" class="footer__sns-icon" />
          </a>
        </div>
      </div>
      <p class="footer__copy">&copy; shizen-no-megumi-nouen Inc .2023</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>
    <?php wp_footer(); ?>
    </body>

    </html>