<?php
/*
Template Name:contact
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
  $page_title = scf::get('ページタイトル');
  $page_description = scf::get('ページ説明文');
  ?>

  <title><?php echo $page_title; ?></title>
  <meta name="description" content="<?php echo $page_description; ?>">
  <link rel="canonical" href="<?= site_url('ranking');?>/">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/front-page_pc.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/front-page_sp.css">
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/add.css">

  <link rel="icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="shortcut icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
  <link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">

  <!-- jquery読込 -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>

  <!-- og関連 -->
  <meta property="og:url" content="<?= site_url('contact'); ?>/">
  <meta property="og:type" content="website">
  <meta property="og:type" content="article">
  <meta property="og:title" content="<?php echo $page_title; ?>">
  <meta property="og:description" content="<?php echo $page_description; ?>">
  <meta property="og:site_name" content="<?php echo $page_title; ?>のWebサイト">
  <meta property="og:image" content="<?php echo wp_get_attachment_url($ogp_img); ?>">

  <?php 
    $contact_display = SCF::get('かんたん応募フォーム利用');
    if($contact_display == false) {
  ?>
    <meta name="viewport" content="width=1180"><meta name='robots' content='noindex, nofollow'/>
  <?php } ?>

  <?php
  $ua = $_SERVER['HTTP_USER_AGENT'];
  if ((strpos($ua, 'Android') !== false) && (strpos($ua, 'Mobile') !== false) || (strpos($ua, 'iPhone') !== false) || (strpos($ua, 'Windows Phone') !== false)) {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';
  } else {
    echo '<meta name="viewport" content="width=1180">';
  }

  wp_deregister_style('wp-block-library');
  wp_head();

  echo $search_consol_tag;
  echo PHP_EOL;
  ?>
</head>
<!-- edit設定でのスタイル反映 -->
<?php get_template_part('common-styles'); ?>

<?php get_header(); ?>

<div id="breadcrumbs">
  <ol itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url();?>/">
        <span class="text_style" itemprop="name">TOP</span></a>
      <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="<?= site_url('contact');?>/">
        <span class="text_style" itemprop="name">CONTACT</span>
      </a>
      <meta itemprop="position" content="2">
    </li>
  </ol>
</div>

<div class="wraper">
  <div class="container">
    <article class="main">
      <section class="contact">
        <div class="contact__inner">
          <h2 class="title_style">かんたん応募フォーム</h2>
          <h3 class="sub_title_style">入力フォーム</h3>
          <div class="contact_text">
            <p>以下フォームよりお気軽にお問い合わせください。</p>
            <p>お問い合わせ内容の確認後、担当者よりご連絡させていただきます。</p>
          </div>
          <?= do_shortcode('[contact-form-7 id="56edd70" title="お問い合わせ"]'); ?>
        </div>
      </section>
    <?php get_footer(); ?>

<script type="application/ld+json">
  [
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= site_url('contact'); ?>/"
      },
      "inLanguage": "ja",
      "author": {
        "@type": "Organization",
        "@id": "<?= site_url(); ?>/",
        "name": "<?php echo $store_name; ?>",
        "url": "<?= site_url(); ?>/",
        "image": "<?php echo wp_get_attachment_url($logo);  ?>"
      },
      "headline": "かんたん応募フォーム",
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
            "name": "CONTACT",
            "@id": "<?= site_url('contact'); ?>/"
          }
        }
      ]
    }
  ]
</script>
