<?php
/*
Template Name:coupon
*/ query_posts('post');
require("setting.php");
$now = date("Y-m-d\TH:i");
$coupons_sql = "SELECT `priority`, `sub_title`, `main_title`, `expired_at`, `remarks` FROM `coupons` WHERE `subject_id` = " . $shop_id . " AND (`expired_at` >= '" . $now . "' OR `expired_at` IS NULL) ORDER BY `priority` ASC";
$coupons = $pdo->prepare($coupons_sql);
$coupons->execute();
$coupons = $coupons->fetchAll(PDO::FETCH_ASSOC);
$sort_key_priority = array_column($coupons, 'priority');
array_multisort(
  $sort_key_priority,
  SORT_ASC,
  SORT_NUMERIC,
  $coupons
);
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
  $page_title = scf::get('ページタイトル');
  $page_description = scf::get('ページ説明文');
  ?>
  <title><?php echo $page_title; ?></title>
  <meta name="description" content="<?php echo $page_description; ?>">
  <link rel="canonical" href="<?= site_url('coupon'); ?>/">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/coupon_pc.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/coupon_sp.css" />
  <link rel="icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="shortcut icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <!-- jquery読込 -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
  <!-- og関連 -->
  <meta property="og:url" content="<?= site_url('coupon'); ?>/" />
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
  <!-- <script type="text/javascript">
var ua = navigator.userAgent;
var bloginfo = $("#Bloginfo").attr('name');
if(ua.indexOf('iPhone') > 0 ||
   ua.indexOf('iPod') > 0 ||
   (ua.indexOf('Android') > 0 &&
   ua.indexOf('Mobile') > 0)){
  $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />');
}
else if (('orientation' in window)) {
  $('head').prepend('<meta name="viewport" content="width=1350" />');
  $('head').prepend('<link rel="stylesheet" media="all" type="text/css" href="' + bloginfo + '/css/admin_tab.css" />');
} else {
  $('head').prepend('<meta name="viewport" content="width=1350" />');
}
</script>
 -->
  <?php
  wp_deregister_style('wp-block-library');
  wp_head();
  ?>
</head>
<?php
// クーポンページカスタムフィールドセット
$coupon_thema_type = scf::get('COUPONのテーマタイプ');
$coupon_wrap_bg_color = scf::get('COUPONの大外背景の色');
$coupon_box_bg_color = scf::get('COUPONの内側背景の色');
$coupon_box_border_color = scf::get('COUPONの枠線の色');
$coupon_expiration_date_text_color = scf::get('COUPONの有効期限の文字色');
$coupon_expiration_date_bg_color = scf::get('COUPONの有効期限の背景色');
$coupon_basic_text_color = scf::get('COUPONのその他の文字色');
$coupon_ribbon_decoration_color = scf::get('COUPONのリボン装飾の色');
if ($coupon_ribbon_decoration_color) {
  $coupon_ribbon_flg = 1;
} else {
  $coupon_ribbon_flg = 0;
}
?>

<?php get_template_part('common-styles'); ?>

<style type="text/css">
  .coupon_wrap_style {
    background-color: <?php echo $coupon_wrap_bg_color; ?>;
    fill: <?php echo $coupon_ribbon_decoration_color; ?>;
  }

  .coupon_wrap_style svg {
    <?php if (!$coupon_ribbon_decoration_color) : ?>display: none;
    <?php endif ?>
  }

  .coupon_ribbon_display {
    opacity: <?php echo $coupon_ribbon_flg; ?>;
  }

  .coupon_box_style {
    background-color: <?php echo $coupon_box_bg_color; ?>;
    border-color: <?php echo $coupon_box_border_color; ?>;
  }

  .coupon_title_style {
    font-family: <?php echo $coupon_title_font; ?>;
    color: <?php echo $coupon_title_text_color; ?>;
    background-color: <?php echo $coupon_title_bg_color; ?>;
  }

  .coupon_basic_text_color {
    color: <?php echo $coupon_basic_text_color; ?>;
  }

  .coupon_discounted_price_style {
    font-family: <?php echo $coupon_discounted_price_font; ?>;
    color: <?php echo $coupon_discounted_price_text_color; ?>;
  }

  .coupon_expiration_date_style {
    color: <?php echo $coupon_expiration_date_text_color; ?>;
    background-color: <?php echo $coupon_expiration_date_bg_color; ?>;
  }
</style>

<?php get_header(); ?>

<div id="breadcrumbs">
  <ol itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url(); ?>/">
        <span class="text_style" itemprop="name">TOP</span></a>
      <meta itemprop="position" content="1" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url('coupon'); ?>/">
        <span class="text_style" itemprop="name">COUPON</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">

  <div class="container">

    <article class="main">

      <section class="coupon">
        <div class="coupon__inner--<?php echo $coupon_thema_type; ?>">
          <h2 class="title_style">C O U P O N</h2>
          <h3 class="sub_title_style">クーポン</h3>
          <?php
          foreach ($coupons as $coupon) {
          ?>
            <div class="wrap coupon_wrap_style">
              <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="100" height="100" viewBox="0 0 100 100">
                <defs>
                  <clipPath id="a">
                    <rect class="a" width="100" height="100" transform="translate(702 279)" />
                  </clipPath>
                </defs>
                <g class="b" transform="translate(-702 -279)">
                  <rect class="c" width="164" height="23" transform="translate(677.886 370.351) rotate(-45)" />
                </g>
              </svg>
              <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="100" height="100" viewBox="0 0 100 100">
                <defs>
                  <clipPath id="a">
                    <rect class="a" width="100" height="100" transform="translate(1118 695)" />
                  </clipPath>
                </defs>
                <g class="b" transform="translate(-1118 -695)">
                  <rect class="c" width="164" height="23" transform="translate(1242.114 703.649) rotate(135)" />
                </g>
              </svg>
              <div class="box coupon_box_style">
                <p class="coupon_basic_text_color"><?php echo nl2br($coupon['main_title']); ?></p>
                <dl class="coupon_expiration_date_style">
                  <dt>有効期限：</dt>
                  <?php
                  if ($coupon['expired_at'] != "") {
                  ?>
                    <dd><?php echo Date("Y年m月d日", strtotime($coupon['expired_at'])) ?></dd>
                  <?php } else { ?>
                    <dd>無期限</dd>
                  <?php } ?>
                </dl>
                <ul class="coupon_basic_text_color">
                  <?php
                  $list = get_text($coupon['remarks']);
                  foreach ($list as $text) {
                  ?>
                    <li><?php echo nl2br($text); ?></li>
                  <?php
                  }
                  ?>
                </ul>
              </div> <!-- /box -->
            </div> <!-- /wrap -->
          <?php
          }
          ?>

        </div> <!-- /coupon__inner-- -->
      </section> <!-- /coupon-- -->

      <?php get_footer(); ?>

      <script type="application/ld+json">
        [{
            "@context": "https://schema.org",
            "@type": "WebSite",
            "mainEntityOfPage": {
              "@type": "WebPage",
              "@id": "<?= site_url('coupon'); ?>/"
            },
            "inLanguage": "ja",
            "author": {
              "@type": "Organization",
              "@id": "<?= site_url(); ?>/",
              "name": "<?php echo $store_name; ?>",
              "url": "<?= site_url(); ?>/",
              "image": "<?php echo wp_get_attachment_url($logo);  ?>"
            },
            "headline": "クーポン",
            "description": "<?php echo $page_description; ?>"
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
            "name": "パンくずリスト",
            "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                  "name": "TOP",
                  "@id": "<?= site_url(); ?>/"
                }
              },
              {
                "@type": "ListItem",
                "position": 2,
                "item": {
                  "name": "COUPON",
                  "@id": "<?= site_url('coupon'); ?>/"
                }
              }
            ]
          }
        ]
      </script>
