<?php
/*
Template Name:shop-photo
*/ query_posts( 'post' );
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
  $page_title = scf::get('ページタイトル');
  $page_description = scf::get('ページ説明文');
?>
<title><?php echo $page_title; ?></title>
<meta name="description" content="<?php echo $page_description; ?>">
<link rel="canonical" href="<?= site_url('shop-photo');?>/">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/shop-photo_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/shop-photo_sp.css" />
<link rel="icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- スワイパー -->
<script src="<?php echo get_template_directory_uri(); ?>/js/swiper/swiper.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/swiper/swiper.min.css" />
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('shop-photo');?>/" />
<meta property="og:type" content="website" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $page_title; ?>" />
<meta property="og:description" content="<?php echo $page_description; ?>" />
<meta property="og:site_name" content="<?php echo $store_name; ?>のWebサイト" />
<meta property="og:image" content="<?php echo wp_get_attachment_url( $ogp_img ); ?>" />
<!-- <meta property="fb:app_id" content="123********" /> -->
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
// ショップフォトページカスタムフィールドセット
  $shop_photo_thema_type = scf::get('SHOP-PHOTOのテーマタイプ');
  $room_list_title_text_color = scf::get('ROOMリストのタイトルの文字色');
?>

<?php get_template_part('common-styles'); ?>

<style type="text/css">
.selector_text_style {
	font-family: <?php echo $title_font; ?>;
	color: <?php echo $schedule_period_text_color; ?>;
}
.room_list_title_text_style {
  color: <?php echo $room_list_title_text_color; ?>;
  font-family: <?php echo $title_font; ?>;
}
</style>

<?php get_header(); ?>

<div id="breadcrumbs">
  <ol itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url();?>/">
        <span class="text_style" itemprop="name">TOP</span></a>
      <meta itemprop="position" content="1" />
    </li>
    <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url('shop-photo');?>/">
        <span class="text_style" itemprop="name">SHOP-PHOTO</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">

  <div class="container">

    <article class="main">

      <section class="shop-photo">
        <div class="shop-photo__inner--<?php echo $shop_photo_thema_type; ?>">
          <h2 class="title_style">S H O P&nbsp;&nbsp;P H O T O</h2>
          <h3 class="sub_title_style">店内写真</h3>

          <div class="swiper-container-selector">
          	<ul class="swiper-wrapper">

              <?php
                $photos_sql = "SELECT `images_subject`,`room_name`,`image_number`,`image_url` FROM `shop_images` WHERE `shop_id` = ".$shop_id;
                $photos = $pdo->prepare($photos_sql);
                $photos->execute();
                $photos = $photos->fetchAll(PDO::FETCH_ASSOC);
                $sort_key_image_number = array_column($photos, 'image_number');
                array_multisort(
                      $sort_key_image_number, SORT_ASC, SORT_NUMERIC,
                      $photos
                );

                $room_names_sql = "SELECT distinct `room_name` FROM `shop_images` WHERE `shop_id` = ".$shop_id." and `room_name` != ''";
                $room_names = $pdo->prepare($room_names_sql);
                $room_names->execute();
                $room_names = $room_names->fetchAll(PDO::FETCH_ASSOC);
              ?>

              <?php
                $flag_1 = 0;
                $flag_2 = 0;
                $flag_3 = 0;
                $flag_4 = 0;
                $flag_5 = 0;
                $flag_6 = 0;
                $flag_7 = 0;
                $flag_8 = 0;
                foreach($photos as $photo) {
                  if(!empty($photo['image_url']) and $photo['images_subject'] == "Room1") {
                    $flag_1 = 1;
                  }
                }
                foreach($photos as $photo) {
                  if(!empty($photo['image_url']) and $photo['images_subject'] == "Room2") {
                    $flag_2 = 1;
                  }
                }
                foreach($photos as $photo) {
                  if(!empty($photo['image_url']) and $photo['images_subject'] == "Room3") {
                    $flag_3 = 1;
                  }
                }
                foreach($photos as $photo) {
                  if(!empty($photo['image_url']) and $photo['images_subject'] == "Room4") {
                    $flag_4 = 1;
                  }
                }
                foreach($photos as $photo) {
                  if(!empty($photo['image_url']) and $photo['images_subject'] == "Room5") {
                    $flag_5 = 1;
                  }
                }
              ?>
              <?php
                if($flag_1) {
              ?>
          		<li id="01" class="swiper-slide schedule_period_style schedule_selector_active_style">
          			<span class="selector_text_style"><?php echo $room_names[0]['room_name'];?></span>
          		</li>
              <?php
                }
                if($flag_2) {
              ?>
          		<li id="02" class="swiper-slide schedule_period_style ">
          			<span class="selector_text_style"><?php echo $room_names[1]['room_name'];?></span>
          		</li>
              <?php
                }
                if($flag_3) {
              ?>
          		<li id="03" class="swiper-slide schedule_period_style ">
          			<span class="selector_text_style"><?php echo $room_names[2]['room_name'];?></span>
          		</li>
              <?php
                }
                if($flag_4) {
              ?>
          		<li id="04" class="swiper-slide schedule_period_style ">
          			<span class="selector_text_style"><?php echo $room_names[3]['room_name'];?></span>
          		</li>
              <?php
                }
                if($flag_5) {
              ?>
          		<li id="05" class="swiper-slide schedule_period_style ">
          			<span class="selector_text_style"><?php echo $room_names[4]['room_name'];?></span>
          		</li>
              <?php
                }
                if($flag_6) {
              ?>
              <li id="06" class="swiper-slide schedule_period_style ">
                <span class="selector_text_style"><?php echo $room_names[5]['room_name'];?></span>
              </li>
              <?php
                }
                if($flag_7) {
              ?>
              <li id="07" class="swiper-slide schedule_period_style ">
                <span class="selector_text_style"><?php echo $room_names[6]['room_name'];?></span>
              </li>
              <?php
                }
                if($flag_8) {
              ?>
              <li id="08" class="swiper-slide schedule_period_style ">
                <span class="selector_text_style"><?php echo $room_names[7]['room_name'];?></span>
              </li>
              <?php
                }
              ?>
          	</ul>
          </div> <!-- /selector -->

    <script type="text/javascript">
      var w = $(window).width();
      if(w <= 767.9){
        var mySwiper = new Swiper ('.swiper-container-selector', {
        effect: "slide",
        fadeEffect: {
          crossFade: true
        },
        slidesPerView: 2.32,
        spaceBetween: 0,
          loop: false,
        });
      }
    </script>

          <?php
            if($flag_1 == 1) {
          ?>
          <div id="room01" class="wrap spotlight-group">
            <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room1") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  $photo['image_url'] = str_replace('http://', 'https://', $photo['image_url']);
                  if($photo['images_subject'] == "Room1" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[0]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
          if($flag_2 == 1) {
          ?>
          <div id="room02" class="wrap spotlight-group">
            <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room2") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room2" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[1]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_3 == 1) {
          ?>
          <div id="room03" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room3") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room3" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[2]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_4 == 1) {
          ?>
          <div id="room04" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room4") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
            <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room4" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[3]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_5 == 1) {
          ?>
          <div id="room05" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room5") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room5" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[4]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_6 == 1) {
          ?>
          <div id="room06" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room6") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room6" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[5]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_7 == 1) {
          ?>
          <div id="room07" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room7") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room7" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[6]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

          <?php
            if($flag_8 == 1) {
          ?>
          <div id="room08" class="wrap spotlight-group">
          <?php
            foreach($photos as $photo) {
              if(!empty($photo['image_url']) and $photo['images_subject'] == "Room8") {
            ?>
            <h4 class="room_list_title_text_style"><?php echo $photo['room_name'];?></h4>
            <?php
              break;
              }
            }
            ?>
            <ul>
              <?php
                $count = 0;
                foreach($photos as $photo) {
                  if($photo['images_subject'] == "Room8" and $photo['image_url'] != "") {
                  $count++;
              ?>
              <li class="border_color">
                <a class="spotlight" href="<?php echo $photo['image_url']; ?>">
                  <img src="<?php echo $photo['image_url']; ?>" alt="<?php echo $room_names[7]['room_name'];?>の店内写真<?php echo $count; ?>番目" />
                </a>
              </li>
              <?php
                  }
                }
              ?>
            </ul>
          </div> <!-- /wrap -->
          <?php
            }
          ?>

        </div> <!-- /calendar__inner -->
      </section> <!-- /calendar-- -->

  <?php get_footer(); ?>

<!-- ショップフォト切り替えセレクター -->
<script type="text/javascript">
$(function() {
$('.swiper-container-selector ul li').on('click', function() {
  $(this).siblings().removeClass('schedule_selector_active_style');
  $(this).addClass('schedule_selector_active_style');
  var target02 = $(this).attr('id');
      target02 = $('#room' + target02);
      target02.siblings('.wrap').css('display','none');
      target02.css('display','block');
  });
});
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/spotlight/spotlight.bundle.js"></script>

<script type="application/ld+json">
  [
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= site_url('shop-photo'); ?>/"
      },
      "inLanguage": "ja",
      "author": {
        "@type": "Organization",
        "@id": "<?= site_url(); ?>/",
        "name": "<?php echo $store_name; ?>",
        "url": "<?= site_url(); ?>/",
        "image": "<?php echo wp_get_attachment_url($logo); ?>"
      },
      "headline": "店内写真",
      "description": "<?php echo $page_description; ?>"
    },
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php echo $store_name; ?>",
      "url": "<?= site_url(); ?>/",
      "logo": "<?php echo wp_get_attachment_url($logo); ?>",
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "<?php echo $mono_international_tel; ?>",
          "contactType": "customer support"
        }
      ],
      "sameAs": [
        <?php
        $sns_urls = [];
        if ($mono_sns01) $sns_urls[] = '"' . $mono_sns01 . '"';
        if ($mono_sns02) $sns_urls[] = '"' . $mono_sns02 . '"';
        if ($mono_sns03) $sns_urls[] = '"' . $mono_sns03 . '"';
        if ($mono_sns04) $sns_urls[] = '"' . $mono_sns04 . '"';
        if ($mono_sns05) $sns_urls[] = '"' . $mono_sns05 . '"';
        echo implode(",\n", $sns_urls);
        ?>
      ]
    },
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "<?php echo $store_name; ?>",
      "image": "<?php echo wp_get_attachment_url($logo); ?>",
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
      "itemListElement": [
        {
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
            "name": "SHOP PHOTO",
            "@id": "<?= site_url('shop-photo'); ?>/"
          }
        }
      ]
    }
  ]
</script>
