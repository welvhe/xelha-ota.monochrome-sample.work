<?php
/*
Template Name:calendar
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
<link rel="canonical" href="<?= site_url('calendar');?>/">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/calendar_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/calendar_sp.css" />
<link rel="icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('calendar');?>/" />
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
// カレンダーページカスタムフィールドセット
  $calendar_thema_type = scf::get('カレンダーのテーマタイプ');
  $calendar_text_color = scf::get('カレンダー文字色');
  $calendar_bg_color = scf::get('カレンダー背景色');
  $calendar_border_color = scf::get('カレンダー枠線色');
  $calendar_saturday_bg_color = scf::get('カレンダー土曜日の背景色');
  $calendar_sunday_bg_color = scf::get('カレンダー日曜日の背景色');
  $calendar_event_text_color = scf::get('カレンダーイベントタグの文字色');
  $calendar_event_bg_color = scf::get('カレンダーイベントタグの背景色');
  $calendar_birthday_text_color = scf::get('カレンダー誕生日タグの文字色');
  $calendar_birthday_bg_color = scf::get('カレンダー誕生日タグの背景色');
  $calendar_closed_text_color = scf::get('カレンダー休業タグの文字色');
  $calendar_closed_bg_color = scf::get('カレンダー休業タグの背景色');
?>

<?php get_template_part('common-styles'); ?>

<style type="text/css">
.calendar_style {
  color: <?php echo $calendar_text_color; ?>;
  background-color: <?php echo $calendar_bg_color; ?>;
  border-color: <?php echo $calendar_border_color; ?>;
}
.calendar_saturday_bg_color {
  background-color: <?php echo $calendar_saturday_bg_color; ?>;
}
.calendar_sunday_bg_color {
  background-color: <?php echo $calendar_sunday_bg_color; ?>;
}
</style>

<script type="application/ld+json">
[
{
"@context": "https://schema.org",
"@type": "WebSite",
"mainEntityOfPage": {
"@type": "WebPage",
"@id": "<?= site_url('calendar');?>/"
},
"inLanguage": "ja",
"author": {
 "@type": "Organization",
 "@id": "<?= site_url();?>/",
 "name": "<?php echo $store_name; ?>",
 "url": "<?= site_url();?>/",
 "image": "<?php echo wp_get_attachment_url( $logo );  ?>"
},
"headline": "イベントカレンダー",
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
"telephone": "<?php echo $international_tel; ?>",
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
"item":{"name":"CALENDAR","@id":"<?= site_url('calendar');?>/"}
}
]
}
]
</script>

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
      <a itemprop="item" href="<?= site_url('calendar');?>/">
        <span class="text_style" itemprop="name">EVENT CALENDAR</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>


<div class="wraper">

  <div class="container">

    <article class="main">

      <section class="calendar">
        <div class="calendar__inner--<?php echo $calendar_thema_type; ?>">
          <h2 class="title_style">E V E N T&nbsp;&nbsp;C A L E N D A R</h2>
          <h3 class="sub_title_style">イベントカレンダー</h3>

<?php
$pre_year = "";
$pre_month = "";
$next_year = "";
$next_month = "";
$pre_year = getParamval('pre_year');
$pre_month = getParamval('pre_month');
$next_year = getParamval('next_year');
$next_month = getParamval('next_month');
?>
                <?php
                  $year = date('Y');
                  $month = date('n');
                  $end = date('d',strtotime('last day of this month'));
                  $start_date = date('Y-m-1');
                  $end_date = date('Y-m-d',strtotime('last day of this month'));
                  $month_name = date('F');
                  if ($pre_year) {
                    if ($pre_year <> $year) {
                      $year = $pre_year;
                    }
                  }
                  if ($pre_month) {
                    if ($pre_month <> $month) {
                      $month = $pre_month;
                    }
                  }
                  if ($pre_year || $pre_month) {
                    $iBaseTimestamp = strtotime($pre_year . '-' . $pre_month);
                    $end = date('d',strtotime("last day of this month", $iBaseTimestamp));;
                    $start_date = date('Y-m-d',strtotime("first day of this month", $iBaseTimestamp));;
                    $end_date = date('Y-m-d',strtotime("last day of this month", $iBaseTimestamp));;
                    $month_name = date('F', strtotime('this month', $iBaseTimestamp));
                  }
                  if ($next_year) {
                    if ($next_year <> $year) {
                      $year = $next_year;
                    }
                  }
                  if ($next_month) {
                    if ($next_month <> $month) {
                      $month = $next_month;
                    }
                  }
                  if ($next_year || $next_month) {
                    $iBaseTimestamp = strtotime($next_year . '-' . $next_month);
                    $end = date('d',strtotime("last day of this month", $iBaseTimestamp));;
                    $start_date = date('Y-m-d',strtotime("first day of this month", $iBaseTimestamp));;
                    $end_date = date('Y-m-d',strtotime("last day of this month", $iBaseTimestamp));;
                    $month_name = date('F', strtotime('this month', $iBaseTimestamp));
                  }
                ?>

          <div class="event_page_base">
            <h3 class="title_style">
              <?php echo $month_name;?><br><span><?php echo $year . '.' .$month;?></span>
            </h3>
            <table class="event_t calendar_style">
              <tbody>


                <?php
                  for($i = 1; $i <= $end; $i++) {
                    $events_sql = "SELECT `date`,`type`,`title` FROM `events` WHERE `shop_id` = ".$shop_id." AND `date` <= '".$end_date."' AND `date` >= '".$start_date."' ORDER BY `date` ASC";
                    $events = $pdo->prepare($events_sql);
                    $evnets = $events->execute();
                    $dw = date('w',strtotime($year.'-'.$month.'-'.$i));
                    switch($dw) {
                      case 0:
                        $class = 'sun calendar_sunday_bg_color';
                        break;
                      case 6:
                        $class = 'sat calendar_saturday_bg_color';
                        break;
                      default:
                        $class = '';
                        break;
                    }
                    $date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$i));
                    $targets = [];
                    foreach($events as $event) {
                      if($event['date'] == $date) {
                        $targets[] = $event;
                      }
                    }
                    if($targets != []) {
                      foreach($targets as $target) {
                        switch($target['type']) {
                          case 0:
                            $type = 'イベント';
                            $color = 'color:' . $calendar_event_text_color . ';';
                            $background_color = 'background-color:' . $calendar_event_bg_color . ';';
                            break;
                          case 1:
                            $type = '休業';
                            $color = 'color:' . $calendar_closed_text_color . ';';
                            $background_color = 'background-color:' . $calendar_closed_bg_color . ';';
                            break;
                          case 2:
                            $type = '誕生日';
                            $color = 'color:' . $calendar_birthday_text_color . ';';
                            $background_color = 'background-color:' . $calendar_birthday_bg_color . ';';
                            break;
                          default:
                            $type = '';
                            $color = '';
                        }
                    ?>
                      <tr class="<?php echo $class;?>">
                        <td class="data"><?php echo $i;?></td>
                        <td class="naiyou">
                          <div class="calendar_page_icon" style="<?php echo $color;echo $background_color;?>"><?php echo $type;?></div>
                          <div class="calendar_page_title"><?php echo $target['title'];?></div>
                        </td>
                      </tr>
                    <?php
                      }
                    } else {
                    ?>
                      <tr class="<?php echo $class;?>">
                        <td class="data"><?php echo $i;?></td>
                        <td class="naiyou">
                       </td>
                     </tr>
                <?php
                  }
                }
                ?>
              </tbody></table>
          <?php
            if ($month == '1') {
              $pre_year = $year - 1;
              $next_year = $year;
              $pre_month = 12;
              $next_month = $month;
            } elseif ($month == '12') {
              $next_year = $year + 1;
              $pre_year = $year;
              $pre_month = $month - 1;
              $next_month = 1;
            } else {
              $pre_year = $year;
              $next_year = $year;
              $pre_month = $month - 1;
              $next_month = $month + 1;
            }
          ?>
						<div class='event_back calendar_style'> <a href='<?= site_url('calendar');?>?pre_year=<?php echo $pre_year; ?>&pre_month=<?php echo $pre_month; ?>' class='btn_event'><span><<　</span><b><?php echo $pre_month; ?>月</b></a></div>
						<div class='event_next calendar_style'><a href='<?= site_url('calendar');?>?next_year=<?php echo $next_year; ?>&next_month=<?php echo $next_month; ?>' class='btn_event'><b><?php echo $next_month; ?>月</b><span>　>></span></a></div>
						<div class='clear'></div>

					</div>

        </div> <!-- /calendar__inner--r -->
      </section> <!-- /calendar-- -->

<script type="text/javascript">
$(function(){
  var event_back = $('.event_back').html();
  var event_next= $('.event_next').html();
  var target = "<div class='event_back calendar_style'>" + event_back + "</div>" + "<div class='event_next calendar_style'>" + event_next + "</div>";
  $('div.event_page_base h3').after(target);
});
</script>

  <?php get_footer(); ?>
