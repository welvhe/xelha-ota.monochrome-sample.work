<?php
  require(__DIR__ . '/../database.php');

  $button_shape_thema_type = scf::get('共通リンクボタン形状のテーマタイプ', 34);
  $news_thema_type = scf::get('ニュースのテーマタイプ', 34);
  $news_bg_color = scf::get('ニュース背景色', 34);
  $news_title_color = scf::get('ニュースタイトル文字色', 34);
  $news_article_title_text_color = scf::get('ニュースの記事タイトルの文字色', 34);
  $news_article_text_color = scf::get('ニュースの記事文章の文字色', 34);
  $news_article_title_bg_color = scf::get('ニュースの記事タイトル帯の背景色', 34);
  $news_link_icon_color = scf::get('ニュースのリンクアイコン色', 34);
  $news_link_icon_bg_color = scf::get('ニュースのリンクアイコン背景色', 34);
  $news_link_button_text = scf::get('ニュースボタンのテキスト', 34);
  $news_btn_color = scf::get('ニュースボタンの文字色', 34);
  $news_btn_bg_color = scf::get('ニュースボタンの背景色', 34);
  $news_btn_border_color = scf::get('ニュースボタンの枠線色', 34);

  $ua = $_SERVER['HTTP_USER_AGENT'];
  if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
    $news_title_length = 12;
    $news_content_length = 62;
  } else {
    $news_title_length = 16;
    $news_content_length = 127;
  }
?>

<style type="text/css">
  .news {
    background-color: <?= $news_bg_color; ?>;
  }

  .news h2,
  .news h3 {
    color: <?= $news_title_color; ?>;
  }

  .news__arcives-link--pop,
  .news__arcives-link--stylish,
  .news__arcives-link--luxury {
    color: <?= $news_btn_color; ?>;
    background-color: <?= $news_btn_bg_color; ?>;
    border-color: <?= $news_btn_border_color; ?>;
  }

  .news_link_icon_style {
    fill: <?php echo $news_link_icon_color; ?>;
    background-color: <?php echo $news_link_icon_bg_color; ?>;
  }

  .news_article_title_text_color {
    color: <?php echo $news_article_title_text_color; ?>;
  }

  .news_article_title_bg_color,
  .news_article_title_bg_color h4:after {
    background-color: <?php echo $news_article_title_bg_color; ?>;
  }

  .news_article_text_color {
    color: <?php echo $news_article_text_color; ?>;
  }
</style>

<!-- ニュースここから -->
<section class="news swiper-container-news-wrap">
  <div class="news__inner--<?php echo $news_thema_type; ?> swiper-container-news">
    <h2 class="news__title-main--<?php echo $news_thema_type; ?> title_style">N E W S</h2>
    <h3 class="news__title-sub--<?php echo $news_thema_type; ?> sub_title_style">最新ニュース</h3>
    <ul class="news__list--<?php echo $news_thema_type; ?>  swiper-wrapper">
      <?php
      $shop_news_sql = "SELECT `id`,`image_url`,`title`,`text`,`link` FROM `shop_news` where `shop_id` = " . $shop_id . " AND (`expired_at` >= now() OR `expired_at` IS NULL) ORDER BY `priority` ASC limit 4";
      $shop_news = $pdo->prepare($shop_news_sql);
      $shop_news->execute();
      $shop_news = $shop_news->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php
      $count = 1;
      foreach ($shop_news as $news) {
        // ニュース記事を最大4件出力。5回転目でブレイク
      ?>
        <li class="news__list-item--<?php echo $news_thema_type; ?> swiper-slide border_color">
          <a href="<?= site_url('news'); ?>/#news_<?php echo $news['id']; ?>">
            <div class="news_list-item-imgwrap">
              <?php if ($news['image_url']) {
                $news['image_url'] = str_replace('http://', 'https://', $news['image_url']);
              ?>
                <img class="news__list-item-img--<?php echo $news_thema_type; ?>" src="<?php echo $news['image_url']; ?>" alt="<?php echo $count; ?>番目のニュース記事「<?php echo $news['title']; ?>の画像" />
              <?php } else { ?>
                <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
              <?php } ?>
            </div>
            <div class="news__list-item-content--<?php echo $news_thema_type; ?> news_article_title_bg_color">
              <h4 class="news__list-item-content-title--<?php echo $news_thema_type; ?> news_article_title_text_color"><i><?php if (mb_strlen($news['title']) > $news_title_length) {
                                                                                                                              $title = mb_substr($news['title'], 0, $news_title_length);
                                                                                                                              echo $title . "…";
                                                                                                                            } else {
                                                                                                                              echo $news['title'];
                                                                                                                            } ?></i></h4>
              <p class="news__list-item-content-text--<?php echo $news_thema_type; ?> news_article_text_color"><?php if (mb_strlen($news['text']) > $news_content_length) {
                                                                                                                    $title = mb_substr($news['text'], 0, $news_content_length);
                                                                                                                    echo $title . "…";
                                                                                                                  } else {
                                                                                                                    echo nl2br($news['text']);
                                                                                                                  } ?></p>
              <?php
                switch ($news_thema_type):
                  case 'stylish':
              ?>
                  <div class="news__list-item-content-linkmark--stylish news_link_icon_style">
                    <svg xmlns="https://www.w3.org/2000/svg" width="7.337" height="8.68" viewBox="0 0 7.337 8.68">
                      <path d="M0,0v8.68L7.337,4.34Z" transform="translate(0 0)" />
                    </svg>
                  </div> <!-- /news__list-item-linkmark--stylish -->
                <?php break; ?>
               <?php case 'luxury': ?>
                  <div class="news__list-item-content-linkmark--luxury news_link_icon_style">
                    <svg xmlns="https://www.w3.org/2000/svg" width="7.248" height="12" viewBox="0 0 7.248 12">
                      <defs></defs>
                      <path class="a" d="M.542,0,0,.485,6.164,6,0,11.515.542,12,7.248,6Z" transform="translate(0 0)" />
                    </svg>
                  </div> <!-- /news__list-item-linkmark--luxury -->
                  <?php break; ?>
              <?php endswitch; ?>
            </div> <!-- /news__list-item-content -->
          </a>
        </li>
        <?php
          $count++;
        }
      ?>
    </ul>
    <a class="news__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('news'); ?>/"><span><?php echo $news_link_button_text; ?></span></a>
  </div> <!-- /news__inner -->
</section> <!-- /news -->

<?php
  switch ($news_thema_type):
    case 'pop':
?>
    <!-- 今のところ何もも出さない -->
    <?php break; ?>
  <?php case 'stylish': ?>

    <script type="text/javascript">
      var w = $(window).width();
      if (w <= 767.9) {
        var mySwiper = new Swiper('.swiper-container-news', {
          effect: "slide",
          fadeEffect: {
            crossFade: true
          },
          slidesPerView: 1.335,
          spaceBetween: 15,
          loop: false,
        });
      }
    </script>

    <?php break; ?>
  <?php case 'luxury': ?>
    <!-- 今のところ何もも出さない -->

<?php endswitch; ?>
<!-- newsここまで -->
