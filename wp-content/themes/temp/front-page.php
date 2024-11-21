<?php
/*
Template Name:front-page
*/ query_posts('post');
require("setting.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <?php
  echo $analytics_tag;
  echo PHP_EOL;
  ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  $page_title = scf::get('ページタイトル', 34);
  $page_description = scf::get('ページ説明文', 34);
  $eyecatch_thema_type = scf::get('アイキャッチのテーマタイプ', 34);
  ?>
  <title><?php echo $page_title; ?></title>
  <meta name="description" content="<?php echo $page_description; ?>">
  <link rel="canonical" href="<?= site_url(); ?>/">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/front-page_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/front-page_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sns-modal_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sns-modal_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/staff_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/staff_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/add.css" />
  <link rel="icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="shortcut icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <!-- jquery読込 -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
  <!-- スワイパー -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/swiper/swiper.min.css" />
  <?php if ($eyecatch_thema_type === '■モーション01--flash' || $eyecatch_thema_type === '■モーション02--blur' || $eyecatch_thema_type === '■モーション03--zoom-out') { ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vegas/vegas.min.js"></script>
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/vegas/vegas.min.css" />
  <?php } ?>
  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
  <!-- og関連 -->
  <meta property="og:url" content="<?= site_url(); ?>/" />
  <meta property="og:type" content="website" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?php echo $page_title; ?>" />
  <meta property="og:description" content="<?php echo $page_description; ?>" />
  <meta property="og:site_name" content="<?php echo $store_name; ?>のWebサイト" />
  <meta property="og:image" content="<?php echo wp_get_attachment_url($ogp_img); ?>" />
  <?php
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />';
  } else {
    echo '<meta name="viewport" content="width=1180" />';
  }
  ?>

  <?php
  wp_deregister_style('wp-block-library');
  wp_head();
  ?>

  <?php
  echo $search_consol_tag;
  echo PHP_EOL;
  ?>
</head>
<?php
  // トップページカスタムフィールドセット
  $eyecatch_imgs_single = scf::get('◆アイキャッチ１枚画像PC版', 34);
  $sp_eyecatch_imgs_single = scf::get('◆アイキャッチ１枚画像スマホ版', 34);
  $eyecatch_url_single = scf::get('◆アイキャッチ１枚画像につけるリンクURL', 34);
  $eyecatch_movie = scf::get('◎アイキャッチ動画', 34);
  $eyecatch_movie_sp = scf::get('◎アイキャッチ動画（SP用）', 34);
  $eyecatch_movie_sp_aspect_retio = scf::get('◎アイキャッチ動画■モーション画像比率（SP用）', 34);
  $eyecatch_imgs_motion01 = scf::get('■モーション画像①', 34);
  $eyecatch_imgs_motion02 = scf::get('■モーション画像②', 34);
  $eyecatch_imgs_motion03 = scf::get('■モーション画像③', 34);
  $eyecatch_imgs_motion04 = scf::get('■モーション画像④', 34);
  $eyecatch_imgs_motion05 = scf::get('■モーション画像⑤', 34);
  $eyecatch_imgs_motion06 = scf::get('■モーション画像⑥', 34);
  $eyecatch_imgs_motion07 = scf::get('■モーション画像⑦', 34);
  $eyecatch_imgs_motion08 = scf::get('■モーション画像⑧', 34);
  $eyecatch_imgs_motion09 = scf::get('■モーション画像⑨', 34);
  $eyecatch_imgs_motion10 = scf::get('■モーション画像⑩', 34);
  $eyecatch_imgs_over_motion = scf::get('◎動画■モーションの上にのるロゴ画像', 34);
  $eyecatch_imgs_over_motion_width = scf::get('◎動画■モーションの上にのる画像の横幅', 34);
  $sp_eyecatch_imgs_over_motion_width = scf::get('◎動画■モーションの上にのるロゴ画像の横幅（SP用）', 34);
  $eyecatch_imgs_over_motion_link_url = scf::get('◎動画■モーションの上のロゴにつけるリンクURL', 34);
  $eyecatch_display_link = scf::get('◎動画■モーションの上のリンクボタン', 34);
  $eyecatch_fv_link = scf::get('◎動画■モーションの上のリンクボタンURL', 34);
  $eyecatch_fv_link_txt = scf::get('◎動画■モーションの上のリンクボタンの文章', 34);
  $eyecatch_btn_text_color = scf::get('スライダー画像上のリンクボタンの文字色', 34);
  $eyecatch_btn_title_bg_color = scf::get('スライダー画像上のリンクボタンの背景色', 34);
  $eyecatch_fv_link_width = scf::get('◎動画■モーションの上のリンクボタンの横幅', 34);
  $eyecatch_fv_link_width_sp = scf::get('◎動画■モーションの上のリンクボタンの横幅（SP用）', 34);
  $eyecatch_fv_link_top = scf::get('◎動画■モーションの上のリンクボタンの位置', 34);
  $eyecatch_fv_link_top_sp = scf::get('◎動画■モーションの上のリンクボタンの位置（SP用）', 34);
  $overlay = scf::get('オーバレイ', 34);
?>
<?php get_template_part('common-styles'); ?>
<style type="text/css">
  .eyecatch--motion img.pc,
  .eyecatch--luxury img.pc {
    width: <?php echo $eyecatch_imgs_over_motion_width; ?>px;
  }

  .eyecatch--motion img.sp,
  .eyecatch--luxury img.sp {
    width: <?php echo $sp_eyecatch_imgs_over_motion_width; ?>px;
  }

  .eyecatch_link_style {
    color: <?php echo $eyecatch_btn_text_color; ?>;
    background-color: <?php echo $eyecatch_btn_title_bg_color; ?>;
  }

  .eyecatch_link_style:hover {
    background-color: <?php echo $eyecatch_btn_text_color; ?>;
    color: <?php echo $eyecatch_btn_title_bg_color; ?>;
  }

  .eyecatch--stylish .swiper-pagination-bullet-active {
    background-color: <?php echo $thema_color; ?> !important;
  }

  .eyecatch--motion a.eyecatch_link_btn_style,
  .eyecatch--luxury a.eyecatch_link_btn_style {
    top: <?= $eyecatch_fv_link_top; ?>%;
  }

  .eyecatch_link_style {
    color: <?= $eyecatch_btn_text_color; ?>;
    background-color: <?= $eyecatch_btn_title_bg_color; ?>;
    display: inline-block;
    vertical-align: middle;
  }

  .eyecatch_link_btn_style {
    color: <?= $eyecatch_btn_text_color ?>;
    background-color: <?= $eyecatch_btn_title_bg_color; ?>;
    border: 1px solid <?= $eyecatch_btn_text_color ?>;
    width: <?= $eyecatch_fv_link_width; ?>px;
  }

  @media only screen and (max-width: 767.9px) {
    div.eyecatch--luxury.aspect-ratio2vs3,
    div.eyecatch--luxury.aspect-ratio2vs3 video,
    .eyecatch--motion.aspect-ratio2vs3 {
      aspect-ratio: 2 / 3 !important;
      height: auto;
      width: 100%;
      object-fit: cover;
    }

    div.eyecatch--luxury.aspect-ratio4vs5,
    div.eyecatch--luxury.aspect-ratio4vs5 video,
    .eyecatch--motion.aspect-ratio4vs5 {
      aspect-ratio: 4 / 5 !important;
      height: auto;
      width: 100%;
      object-fit: cover;
    }

    .eyecatch--motion a.eyecatch_link_btn_style,
    .eyecatch--luxury a.eyecatch_link_btn_style {
      top: <?= $eyecatch_fv_link_top_sp; ?>%;
    }

    .eyecatch_link_btn_style {
      width: <?= $eyecatch_fv_link_width_sp; ?>px;
    }
  }
</style>

<?php get_header(); ?>

<?php
switch ($eyecatch_thema_type):
  case '◆１枚画像--pop':
    $eyecatch_thema_type_meta = "pop"
?>
    <div class="eyecatch--<?php echo $eyecatch_thema_type_meta; ?> pc">
      <?php if ($eyecatch_url_single) { ?>
        <a href="<?php echo $eyecatch_url_single; ?>">
        <?php } ?>
        <img src="<?php echo wp_get_attachment_url($eyecatch_imgs_single); ?>" alt="アイキャッチ画像">
        <?php if ($eyecatch_url_single) { ?>
        </a>
      <?php } ?>
    </div> <!-- /eyecatch -->
    <div class="eyecatch--<?php echo $eyecatch_thema_type_meta; ?> sp">
      <?php if ($eyecatch_url_single) { ?>
        <a href="<?php echo $eyecatch_url_single; ?>">
      <?php } ?>
        <img src="<?php echo wp_get_attachment_url($sp_eyecatch_imgs_single); ?>" alt="スマホ版アイキャッチ画像">
      <?php if ($eyecatch_url_single) { ?>
        </a>
      <?php } ?>
    </div> <!-- /eyecatch -->
    <?php break; ?>
  <?php
  case '☆スライダー01--stylish':
    $eyecatch_thema_type_meta = "stylish"
  ?>
    <div class="eyecatch--<?php echo $eyecatch_thema_type_meta; ?>">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <?php
            $now = Date("Y-m-d\TH:i");
            $sliders_sql = "SELECT `image_url`,`link`,`install_button`,`button_text`,`expired_at` FROM `sliders` WHERE `subject_id` = " . $shop_id . " AND `subject_name` = 'shop' AND (`expired_at` >= '" . $now . "' OR `expired_at` IS NULL) AND (`expired_at` IS NULL OR `expired_at` > '" .$now . "') ORDER BY `priority` ASC";
            $sliders = $pdo->prepare($sliders_sql);
            $sliders->execute();
            $sliders = $sliders->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <?php
          foreach ($sliders as $slider) {
            $count = 1;
          ?>
            <div class="swiper-slide">
              <div class="wrap">
                <?php if ($slider['link'] && ($slider['install_button'])) { ?>
                  <?php
                  if (!empty($slider['image_url'])) {
                    $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                  ?>
                    <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                  <?php
                  } else {
                  ?>
                    <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                  <?php
                  }
                  ?>
                  <a class="eyecatch_link_style" href="<?php echo $slider['link']; ?>">
                    <span><?php echo $slider['button_text']; ?></span>
                  </a>
                <?php } elseif ($slider['link'] && (!$slider['install_button'])) { ?>
                  <a class="eyecatch_wrap_link" href="<?php echo $slider['link']; ?>">
                    <?php
                    if (!empty($slider['image_url'])) {
                      $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                    ?>
                      <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                    <?php
                    } else {
                    ?>
                      <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                    <?php
                    }
                    ?>
                  </a>
                <?php } elseif (!$slider['link']) { ?>
                  <?php
                  if (!empty($slider['image_url'])) {
                    $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                  ?>
                    <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                  <?php
                  } else {
                  ?>
                    <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                  <?php
                  }
                  ?>
                <?php } ?>

              </div>
            </div>
            <?php $count++; ?>
          <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <script>
      var swiper = new Swiper('.swiper-container', {
        effect: "coverflow", //"slide", "fade", "cube", "coverflow" or "flip"
        slidesPerView: 1,
        slidesPerGroup: 1,
        loop: true,
        loopAdditionalSlides: 1,
        speed: 500,
        autoHeight: true,
        spaceBetween: 40,
        followFinger: false,
        centeredSlides: true,
        grabCursor: true,
        breakpoints: {
          767: {
            loop: true,
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 40
          },
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });
    </script>

    <?php break; ?>
  <?php
  case '☆スライダー02--stylish':
    $eyecatch_thema_type_meta = "stylish"
  ?>
    <div class="eyecatch--<?php echo $eyecatch_thema_type_meta; ?>">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <?php
          $now = Date("Y-m-d\TH:i");
          $sliders_sql = "SELECT `image_url`,`link`,`install_button`,`button_text`,`expired_at`
                FROM `sliders`
                WHERE `subject_id` = " . $shop_id . "
                AND `subject_name` = 'shop'
                AND (`expired_at` >= '" . $now . "' OR `expired_at` IS NULL)
                AND (`expired_at` IS NULL OR `expired_at` > '" . $now . "')
                ORDER BY `priority` ASC";
          $sliders = $pdo->prepare($sliders_sql);
          $sliders->execute();
          $sliders = $sliders->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <?php
          foreach ($sliders as $slider) {
            $count = 1;
          ?>
            <div class="swiper-slide">
              <div class="wrap">
                <?php if ($slider['link'] && ($slider['install_button'])) { ?>
                  <?php
                  if (!empty($slider['image_url'])) {
                    $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                  ?>
                    <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                  <?php
                  } else {
                  ?>
                    <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                  <?php
                  }
                  ?>
                  <a class="eyecatch_link_style" href="<?php echo $slider['link']; ?>">
                    <span><?php echo $slider['button_text']; ?></span>
                  </a>
                <?php } elseif ($slider['link'] && (!$slider['install_button'])) { ?>
                  <a class="eyecatch_wrap_link" href="<?php echo $slider['link']; ?>">
                    <?php
                    if (!empty($slider['image_url'])) {
                      $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                    ?>
                      <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                    <?php
                    } else {
                    ?>
                      <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                    <?php
                    }
                    ?>
                  </a>
                <?php } elseif (!$slider['link']) { ?>
                  <?php
                  if (!empty($slider['image_url'])) {
                    $slider['image_url'] = str_replace('http://', 'https://', $slider['image_url']);
                  ?>
                    <img src="<?php echo $slider['image_url']; ?>" alt="<?php echo $count; ?>番目のスライダー画像" />
                  <?php
                  } else {
                  ?>
                    <img src="<?php echo wp_get_attachment_url($no_img);  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                  <?php
                  }
                  ?>
                <?php } ?>
              </div>
            </div>
            <?php $count++; ?>
          <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <script>
      var swiper = new Swiper('.swiper-container', {
        effect: "slide", //"slide", "fade", "cube", "coverflow" or "flip"
        loop: true,
        loopAdditionalSlides: 1,
        speed: 500,
        autoHeight: true,
        slidesPerView: 1,
        spaceBetween: 40,
        followFinger: false,
        centeredSlides: true,
        grabCursor: true,
        breakpoints: {
          767: {
            slidesPerView: 3,
            spaceBetween: 10
          },
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });
    </script>
    <?php break; ?>
  <?php
  case '◎動画--luxury':
    $eyecatch_thema_type_meta = "luxury"
  ?>
    <div class="eyecatch--<?php echo $eyecatch_thema_type_meta; ?> eyecatch_border_color <?= $eyecatch_movie_sp_aspect_retio; ?>">
      <video class="pc" src="<?php echo wp_get_attachment_url($eyecatch_movie); ?>" autoplay muted loop playsinline webkit-playsinline></video>
      <?php if ($eyecatch_movie_sp) { ?>
        <video class="sp" src="<?php echo wp_get_attachment_url($eyecatch_movie_sp); ?>" autoplay muted loop playsinline webkit-playsinline></video>
      <?php } else { ?>
        <video class="sp" src="<?php echo wp_get_attachment_url($eyecatch_movie); ?>" autoplay muted loop playsinline webkit-playsinline></video>
      <?php } ?>
      <?php if ($eyecatch_imgs_over_motion_link_url) { ?>
        <a href="<?php echo $eyecatch_imgs_over_motion_link_url; ?>">
      <?php } ?>
      <?php if ($eyecatch_imgs_over_motion) { ?>
        <img class="pc" src="<?php echo wp_get_attachment_url($eyecatch_imgs_over_motion); ?>" alt="動画の上にのる<?php echo $group_name; ?>のロゴ" />
        <img class="sp" src="<?php echo wp_get_attachment_url($eyecatch_imgs_over_motion); ?>" alt="スマホ版動画の上にのる<?php echo $group_name; ?>のロゴ" />
      <?php } ?>
      <?php if ($eyecatch_imgs_over_motion_link_url) { ?>
        </a>
      <?php } ?>
      <?php if ($eyecatch_display_link == true) { ?>
        <a href="<?php echo $eyecatch_fv_link; ?>" class="eyecatch_link_btn_style">
          <?= $eyecatch_fv_link_txt; ?>
        </a>
      <?php } ?>
    </div>
    <?php break; ?>


  <?php
  case '■モーション01--flash':
  case '■モーション02--blur':
  case '■モーション03--zoom-out':
    $eyecatch_thema_type_meta = "motion"
  ?>

    <div class="eyecatch--<?= $eyecatch_thema_type_meta; ?> eyecatch_border_color <?= $eyecatch_movie_sp_aspect_retio; ?>">
      <?php if ($eyecatch_imgs_over_motion_link_url) { ?>
        <a href="<?= $eyecatch_imgs_over_motion_link_url; ?>">
      <?php } ?>
      <?php if ($eyecatch_imgs_over_motion) { ?>
        <img class="pc" src="<?= wp_get_attachment_url($eyecatch_imgs_over_motion); ?>" alt="<?= $store_name; ?>のロゴ" />
        <img class="sp" src="<?= wp_get_attachment_url($eyecatch_imgs_over_motion); ?>" alt="<?= $store_name; ?>のロゴ" />
      <?php } ?>
      <?php if ($eyecatch_imgs_over_motion_link_url) { ?>
        </a>
      <?php } ?>
      <?php if ($eyecatch_display_link == true) { ?>
        <a href="<?= $eyecatch_fv_link; ?>" class="eyecatch_link_btn_style">
          <?= $eyecatch_fv_link_txt; ?>
        </a>
      <?php } ?>
    </div>
    <?php break; ?>
<?php endswitch; ?>

<div class="wraper">
  <div class="container">
    <article class="main">

    <?php
      $order = [
        'concept' => (int) scf::get('コンセプトの配置', get_the_ID()),
        'news' => (int) scf::get('ニュースの配置', get_the_ID()),
        'ranking' => (int) scf::get('ランキング（スタッフ一覧）の配置', get_the_ID()),
        'sns' => (int) scf::get('SNSの配置', get_the_ID()),
        'shop-photo' => (int) scf::get('店内写真の配置', get_the_ID()),
        'about' => (int) scf::get('アバウトの配置', get_the_ID()),
      ];

      $order = array_filter($order, function($value) {
        return $value > 0;
      });
      asort($order);

      foreach ($order as $key => $value) {
        switch ($key) {
          case 'concept':
            get_template_part('template-parts/concept');
            break;
          case 'news':
            get_template_part('template-parts/news');
            break;
          case 'ranking':
            get_template_part('template-parts/staff-ranking');
            get_template_part('template-parts/access-ranking');
            get_template_part('template-parts/staff');
            break;
          case 'sns':
            get_template_part('template-parts/sns');
            break;
          case 'shop-photo':
            get_template_part('template-parts/shop-photo');
            break;
          case 'about':
            get_template_part('template-parts/about');
            break;
        }
      }
    ?>

    <?php get_footer(); ?>

<script type="application/ld+json">
  [{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "<?php echo $store_name; ?>",
    "description": "<?php echo $page_description; ?>",
    "url": "<?= site_url(); ?>/",
    "@id": "<?= site_url(); ?>/",
    "inLanguage": "ja",
    "author": {
      "@type": "Organization",
      "@id": "<?= site_url(); ?>/",
      "name": "<?php echo $store_name; ?>",
      "url": "<?= site_url(); ?>/",
      "image": "<?php echo wp_get_attachment_url($logo);  ?>"
    },
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?= site_url(); ?>/?s={search_term}",
      "query-input": "required name=search_term"
    }
  },
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?php echo $store_name; ?>",
    "url": "<?= site_url(); ?>/",
    "logo": "<?php echo wp_get_attachment_url($logo);  ?>",
    "contactPoint": [{
      "@type": "ContactPoint",
      "telephone": "<?php echo $mono_international_tel; ?>",
      "contactType": "customer support"
    }],
    //snsのURL出力
    "sameAs": [
      <?php
      if ($mono_sns01) {
        echo '"' . $mono_sns01 . '"';
      }
      if ($mono_sns02) {
        echo ',' . "\n" . '"' . $mono_sns02 . '"';
      }
      if ($mono_sns03) {
        echo ',' . "\n" . '"' . $mono_sns03 . '"';
      }
      if ($mono_sns04) {
        echo ',' . "\n" . '"' . $mono_sns04 . '"';
      }
      if ($mono_sns05) {
        echo ',' . "\n" . '"' . $mono_sns05 . '"';
      }
      echo "\n";
      ?>
    ]
  },
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?php echo $store_name; ?>",
    "image": "<?php echo wp_get_attachment_url($logo);  ?>",
    "url": "<?= site_url(); ?>/",
    "priceRange": "<?php echo $mono_priceRange; ?>",
    "telephone": "<?php echo $mono_international_tel; ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?php echo $mono_streetAddress; ?>",
      "addressLocality": "<?php echo $mono_addressLocality; ?>",
      "addressRegion": "<?php echo $mono_addressRegion; ?>",
      "postalCode": "<?php echo $mono_postalCode; ?>",
      "addressCountry": "JP"
    },
    "hasMap": "<?php echo $mono_hasMap; ?>",
    "openingHours": "<?php echo $mono_openingHours; ?>",
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "<?php echo $mono_latitude; ?>",
      "longitude": "<?php echo $mono_longitude; ?>"
    }
  },
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
      "@type": "ListItem",
      "position": 1,
      "item": {
        "name": "TOP",
        "@id": "<?= site_url(); ?>/"
      }
    }]
  }]
</script>
