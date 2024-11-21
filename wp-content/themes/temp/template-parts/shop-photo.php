<?php
  require(__DIR__ . '/../setting.php');

  $shop_photos_sql = "SELECT `image_url` FROM `shop_images` WHERE `shop_id` = " . $shop_id . " AND `images_subject` = 'TOP' ORDER BY `image_number` ASC LIMIT 4";
  $shop_photos        = $pdo->prepare($shop_photos_sql);
  $shop_photos->execute();
  $shop_photos = $shop_photos->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (count($shop_photos) > 0 || $for_count_photos > 0) { ?>

  <section class="shop-photo">
    <div class="shop-photo__inner--<?php echo $shop_photo_thema_type; ?>">
      <h2 class="shop-photo__title-main--<?php echo $shop_photo_thema_type; ?> title_style">S H O P&nbsp;&nbsp;P H O T O</h2>
      <h3 class="shop-photo__title-sub--<?php echo $shop_photo_thema_type; ?> sub_title_style">店内写真</h3>

      <?php
        switch ($shop_photo_thema_type):
          case 'pop':
      ?>
          <div class="swiper-container-shop-photo-wrap">
            <div class="swiper-container-shop-photo">
              <ul class="shop-photo__list--<?php echo $shop_photo_thema_type; ?> swiper-wrapper spotlight-group">
                <?php
                $count = 1;
                foreach ($shop_photos as $photo) {
                  if (!empty($photo['image_url'])) {
                    $photo['image_url'] = str_replace('http://', 'https://', $photo['image_url']);
                ?>
                    <li class="shop-photo__list-item--<?php echo $shop_photo_thema_type; ?> swiper-slide border_color">
                      <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                        <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $count; ?>番目の店内写真">
                      </a>
                    </li>
                <?php
                  }
                  $count++;
                }
                ?>
              </ul>
            </div>
            <div class="swiper-button-shop-photo-pop-prev schedule_period_arrow_color"><svg xmlns="https://www.w3.org/2000/svg" width="22.112" height="37.108" viewBox="0 0 22.112 37.108">
                <path d="M21.236,0,0,18.554,21.236,37.108l.875-.765L1.752,18.554,22.112.766Z" transform="translate(0 0)" />
              </svg></div>
            <div class="swiper-button-shop-photo-pop-next schedule_period_arrow_color"><svg xmlns="https://www.w3.org/2000/svg" width="22.112" height="37.108" viewBox="0 0 22.112 37.108">
                <path d="M.876,0,0,.766,20.36,18.554,0,36.344l.876.765L22.112,18.554Z" transform="translate(0 0)" />
              </svg></div>
          </div> <!-- /swiper-container-shop-photo-wrap -->

          <script type="text/javascript">
            var mySwiper = new Swiper('.swiper-container-shop-photo', {
              effect: "slide",
              fadeEffect: {
                crossFade: true
              },
              slidesPerView: 3,
              spaceBetween: 12,
              loop: false,
              navigation: {
                nextEl: '.swiper-button-shop-photo-pop-next', //「次へ」ボタンの要素のセレクタ
                prevEl: '.swiper-button-shop-photo-pop-prev', //「前へ」ボタンの要素のセレクタ
              },
            })
          </script>

          <?php break; ?>
        <?php case 'stylish': ?>
          <div class="swiper-container-shop-photo-wrap">
            <div class="swiper-container-shop-photo">
              <ul class="shop-photo__list--<?php echo $shop_photo_thema_type; ?> swiper-wrapper spotlight-group">
                <?php
                $count = 1;
                foreach ($shop_photos as $photo) {
                  if (!empty($photo['image_url'])) {
                    $photo['image_url'] = str_replace('http://', 'https://', $photo['image_url']);
                ?>
                    <li class="shop-photo__list-item--<?php echo $shop_photo_thema_type; ?> swiper-slide border_color">
                      <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                        <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $count; ?>番目の<?php echo $store_name; ?>のピックアップ店内写真">
                      </a>
                    </li>
                <?php
                  }
                  $count++;
                }
                ?>
              </ul>
            </div>
          </div>
          <script type="text/javascript">
            var w = $(window).width();
            if (w <= 767.9) {
              var mySwiper = new Swiper('.swiper-container-shop-photo', {
                effect: "slide",
                fadeEffect: {
                  crossFade: true
                },
                slidesPerView: 1.57,
                spaceBetween: 12,
                loop: false,
              });
            }
          </script>
          <?php break; ?>
        <?php case 'luxury': ?>
          <div class="swiper-container-shop-photo-wrap">
            <div class="swiper-container-shop-photo">
              <ul class="shop-photo__list--<?php echo $shop_photo_thema_type; ?> swiper-wrapper spotlight-group">
                <?php
                $count = 1;
                foreach ($shop_photos as $photo) {
                  if (!empty($photo['image_url'])) {
                    $photo['image_url'] = str_replace('http://', 'https://', $photo['image_url']);
                ?>
                    <li class="shop-photo__list-item--<?php echo $shop_photo_thema_type; ?> swiper-slide border_color">
                      <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                        <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $count; ?>番目の店内写真">
                      </a>
                    </li>
                <?php
                  }
                  $count++;
                }
                ?>
              </ul>
            </div>
          </div> <!-- /swiper-container-shop-photo-wrap -->

          <script type="text/javascript">
            var w = $(window).width();
            if (w >= 768) {
              var mySwiper = new Swiper('.swiper-container-shop-photo', {
                effect: "slide",
                fadeEffect: {
                  crossFade: true
                },
                slidesPerView: 2.9,
                spaceBetween: 12,
                loop: false,

              });
            }
          </script>
          <?php break; ?>
      <?php endswitch; ?>
      <?php if ($for_count_photos > 0) { ?>
        <a class="shop-photo__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('shop-photo'); ?>/"><span><?php echo $shop_photo_link_button_text; ?></span></a>
      <?php } ?>
    </div> <!-- /shop-photo__inner -->
  </section> <!-- /shop-photo -->

<?php
  }
?>
