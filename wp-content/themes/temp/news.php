<?php
/*
Template Name:news
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
<link rel="canonical" href="<?= site_url('news');?>/">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/news_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/news_sp.css" />
<link rel="icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('news');?>/" />
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
  // ニュースページカスタムフィールドセット
  $news02_thema_type = scf::get('ニュースのテーマタイプ', 34); // トップページと連動
  $news02_article_thumnail_border_color = scf::get('NEWS02記事サムネイル画像の枠線色');
  $news02_article_bg_color = scf::get('NEWS02記事リストの背景色');
  $news02_article_title_text_color = scf::get('NEWS02記事タイトルの文字色');
  $news02_article_text_color = scf::get('NEWS02記事文章の文字色');
  $news02_button_text_color = scf::get('NEWS02記事詳細を見るボタンの文字色');
  $news02_button_bg_color = scf::get('NEWS02記事詳細を見るボタンの背景色');
  $news02_button_border_color = scf::get('NEWS02記事詳細を見るボタンの枠線色');  
?>
<?php get_template_part('common-styles'); ?>

<style type="text/css">
.news02_article_thumnail_border_color {
  border-color: <?php echo $news02_article_thumnail_border_color; ?>;
}
.news02_article_bg_color {
  background-color: <?php echo $news02_article_bg_color; ?>;
}
.news02_article_title_text_color {
  color: <?php echo $news02_article_title_text_color; ?>;
}
.news02_article_text_color {
  color: <?php echo $news02_article_text_color; ?>;
}
.news02_button_style {
  color: <?php echo $news02_button_text_color; ?>;
  background-color: <?php echo $news02_button_bg_color; ?>;
  border-color: <?php echo $news02_button_border_color; ?>;
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
      <a itemprop="item" href="<?= site_url('news');?>/">
        <span class="text_style" itemprop="name">NEWS</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">

  <div class="container">

    <article class="main">

      <section class="news02">
        <div class="news02__inner--<?php echo $news02_thema_type; ?>">
          <h2 class="title_style">N E W S</h2>
          <h3 class="sub_title_style">最新ニュース</h3>
          <?php
            $shop_news_sql      = "SELECT `id`,`image_url`,`title`,`text`,`link` FROM `shop_news` where `shop_id` = ".$shop_id." AND (`expired_at` >= now() OR `expired_at` IS NULL) ORDER BY `priority` ASC limit 20";
            $shop_news = $pdo->prepare($shop_news_sql);
            $shop_news->execute();
            $shop_news = $shop_news->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <?php
            $total_count = count($shop_news);
          ?>
          <?php if ($total_count): ?>
          <ul>
            <?php
              $count =  1;
              foreach($shop_news as $news) {
            ?>
             <li id="news_<?php echo $news['id']?>">
              <div class="wrap news02_article_bg_color border_color" itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
                <div class="news02__thumnail news02_article_thumnail_border_color" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                  <?php
                  if(!empty($news['image_url'])) {
                    $news['image_url'] = str_replace('http://', 'https://', $news['image_url']);
                  ?>
                    <img src="<?php echo $news['image_url']; ?>" alt="<?php echo $count; ?>番目のニュース記事「<?php echo $news['title'];?>の画像" itemprop="thumbnailUrl" />
                    <meta itemprop="url" content="<?php echo $news['image_url']; ?>">
                  <?php } else {?>
                    <img src="<?php echo wp_get_attachment_url( $no_img ); ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" itemprop="thumbnailUrl" />
                    <meta itemprop="url" content="<?php echo wp_get_attachment_url( $no_img ); ?>">
                  <?php } ?>
                </div> <!-- /sns__list-item-thumnail -->
                <div class="news02__content border_color">
                  <h4 class="entry-title news02_article_title_text_color" itemprop="name headline" itemprop="name headline"><?php echo $news['title'];?></h4>
                  <p class="news02_article_text_color" itemprop="articleBody" itemprop="articleBody"><?php echo nl2br($news['text']);?></p>
                  <?php
                    if($news['link'] != "") {
                      $news['link'] = str_replace('http://', 'https://', $news['link']);
                  ?>
                  <a class="news02_button_style" href="<?php echo $news['link'];?>" itemprop="url"><span>詳細を見る</span></a>
                  <?php } ?>
                </div> <!-- /news02__content -->
              </div> <!-- /wrap -->
            </li>
            <?php
            $count++;
              }
            ?>
          </ul>

         <?php endif ?>

        </div> <!-- /news02__inner--r -->
      </section> <!-- /news02-- -->

  <?php get_footer(); ?>

<script type="application/ld+json">
[
{
"@context": "https://schema.org",
"@type": "WebSite",
"mainEntityOfPage": {
"@type": "WebPage",
"@id": "<?= site_url('news');?>/"
},
"inLanguage": "ja",
"author": {
 "@type": "Organization",
 "@id": "<?= site_url();?>/",
 "name": "<?php echo $store_name; ?>",
 "url": "<?= site_url();?>/",
 "image": "<?php echo wp_get_attachment_url( $logo );  ?>"
},
"headline": "最新ニュース",
"description": "<?php echo $page_description; ?>"
},
{
"@context" : "https://schema.org",
"@type" : "Organization",
"name" : "<?php echo $store_name; ?>",
"url" : "<?= site_url();?>/",
"logo": "<?php echo wp_get_attachment_url( $logo );  ?>",
"contactPoint" : [
{ "@type" : "ContactPoint",
"telephone" : "<?php echo $mono_international_tel; ?>",
"contactType" : "customer support"
} ],
//snsのURL出力
"sameAs" : [
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
"image": "<?php echo wp_get_attachment_url( $logo );  ?>",
"url": "<?= site_url();?>/",
"priceRange":"<?php echo $mono_priceRange; ?>",
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
"@context":"https://schema.org",
"@type":"BreadcrumbList",
"name":"パンくずリスト",
"itemListElement":[
{
"@type":"ListItem",
"position":1,
"item":{"name":"TOP","@id":"<?= site_url();?>/"}
},
{
"@type":"ListItem",
"position":2,
"item":{"name":"NEWS","@id":"<?= site_url('news');?>/"}
}
]
}
]
</script>
