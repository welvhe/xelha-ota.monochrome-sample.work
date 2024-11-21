<?php
/*
Template Name:staff
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
<?php $date = getParamval('date'); ?>
<link rel="canonical" href="<?= site_url('staff');?>/?date=<?php echo $date; ?>">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/staff_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/staff_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_sp.css" />
<link rel="icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- スワイパー -->
<script src="<?php echo get_template_directory_uri(); ?>/js/swiper/swiper.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/swiper/swiper.min.css" />
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('staff');?>/?date=<?php echo $date; ?>" />
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

<?php
  wp_deregister_style('wp-block-library');
  wp_head();
?>
</head>

<?php get_template_part('common-styles'); ?>
<style type="text/css"></style>
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
      <a itemprop="item" href="<?= site_url('staff');?>/">
        <span class="text_style" itemprop="name">STAFF</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">
  <div class="container">
    <article class="main">
      <section class="schedule">
        <div class="schedule__inner--<?php echo $staff_thema_type; ?>">
          <h2 class="schedule__title-main--<?php echo $staff_thema_type; ?> title_style">S T A F F</h2>
          <h3 class="schedule__title-sub--<?php echo $staff_thema_type; ?> sub_title_style">スタッフ一覧</h3>
          <ul class="schedule__list--<?php echo $staff_thema_type; ?>">
            <?php
              $staffs_regular_sql = "SELECT * FROM staffs JOIN staff_images ON staffs.id = staff_images.staff_id WHERE staff_images.subject_id = 1 AND staffs.shop_id = ".$shop_id." AND staffs.hosweb_privacy = 1 ORDER BY staffs.priority ASC";
              $staffs_regular = $pdo->prepare($staffs_regular_sql);
              $staffs_regular->execute();
              foreach($staffs_regular as $staff) {
                $sns_sql = "SELECT DISTINCT * FROM sns WHERE subject_name = 'staff' AND subject_id = ".$staff['staff_id']." limit 1";
                $sns  = $pdo->prepare($sns_sql);
                $sns->execute();
                $sns = $sns->fetch();
            ?>
                <li class="schedule__list-item--<?php echo $staff_thema_type; ?> border_color">
                  <a href="<?= site_url('profile');?>/?staff=<?php echo $staff['staff_id'];?>">
                    <div class="schedule__list-item-thumnail--<?php echo $staff_thema_type; ?>">
                      <?php
                        if($staff['image_url'] != "") {
                          $staff['image_url'] = str_replace('http://', 'https://', $staff['image_url']);
                      ?>
                          <img class="schedule__list-item-thumnail-img--<?php echo $staff_thema_type; ?>" src="<?php echo $staff['image_url'];?>" alt="<?php echo $store_name; ?>所属スタッフの「<?php echo $staff['name'];?>」の肖像写真" />
                      <?php
                        } else {
                      ?>
                          <img class="schedule__list-item-thumnail-img--<?php echo $staff_thema_type; ?>" src="<?php echo wp_get_attachment_url( $no_img );  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                      <?php
                        }
                        // $main_sns = $sns['main_sns'];
                        if(strpos($sns['main_sns'], '0') !== false) {
                          $sns_icon = 0;
                        } elseif(strpos($sns['main_sns'], '3') !== false) {
                          $sns_icon = 3;
                        } elseif(strpos($sns['main_sns'], '1') !== false) {
                          $sns_icon = 1;
                        } elseif(strpos($sns['main_sns'], '2') !== false) {
                          $sns_icon = 2;
                        } else {
                          $sns_icon = -1;
                        }
                        switch($sns_icon) {
                          case 0: //instagram
                            $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"></path></g></svg>';
                            break;
                          case 1://youtube
                            $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"></clipPath></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"></path></g></svg>';
                            break;
                          case 2: //X
                            $svg = '<svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%"><defs><clipPath id="a" /></defs><g class="a" transform="translate(0 0)"><path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" /><polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" /><polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" /></g></svg>';
                            break;
                          case 3: //tiktok
                            $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"></path></g></svg>';
                            break;
                          default:
                            $svg = '';
                            break;
                        }
                        if($svg != '' && $sns['main_sns_set']) {
                          echo '<span class="schedule__list-item-thumnail-snslink--'.$staff_thema_type.' sns_icon_bg_color"><i class="schedule__list-item-thumnail-tiktok-icon--'.$staff_thema_type.' sns_icon_color">'.$svg.'</i></span>';
                        }
                      ?>
                    </div> <!-- /schedule__list-item-thumnail -->
                    <div class="schedule__list-item-content--<?php echo $staff_thema_type; ?> schedule_staff_name_bg_color">
                      <p class="schedule__list-item-content-title--<?php echo $staff_thema_type; ?> schedule_staff_name_text_color"><i><?php echo $staff['post'];?></i></p>
                      <h4 class="schedule__list-item-content-title--<?php echo $staff_thema_type; ?> schedule_staff_name_text_color"><i><?php echo $staff['name'];?></i></h4>
                    </div> <!-- /news__list-item-content -->
                  </a>
                </li>
            <?php
              }
            ?>
          </ul>
        </div> <!-- /schedule__inner -->
      </section> <!-- /schedule -->
    </article>
  </div>
</div>

<?php get_footer(); ?>

<script type="application/ld+json">
  [
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= site_url('staff'); ?>/"
      },
      "inLanguage": "ja",
      "author": {
        "@type": "Organization",
        "@id": "<?= site_url(); ?>/",
        "name": "<?php echo $store_name; ?>",
        "url": "<?= site_url(); ?>/",
        "image": "<?php echo wp_get_attachment_url($logo); ?>"
      },
      "headline": "スタッフ一覧",
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
        if ($mono_sns01) {
          $sns_urls[] = '"' . $mono_sns01 . '"';
        }
        if ($mono_sns02) {
          $sns_urls[] = '"' . $mono_sns02 . '"';
        }
        if ($mono_sns03) {
          $sns_urls[] = '"' . $mono_sns03 . '"';
        }
        if ($mono_sns04) {
          $sns_urls[] = '"' . $mono_sns04 . '"';
        }
        if ($mono_sns05) {
          $sns_urls[] = '"' . $mono_sns05 . '"';
        }
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
            "name": "STAFF",
            "@id": "<?= site_url('staff'); ?>/"
          }
        }
      ]
    }
  ]
</script>
