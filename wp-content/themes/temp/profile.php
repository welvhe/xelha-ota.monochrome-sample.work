<?php
/*
Template Name:profile
*/ query_posts( 'post' );
require("setting.php");
$staff_id = getParamval('staff');
$staff_sql = "SELECT * FROM `staffs` WHERE `id` = ".$staff_id;
$staff = $pdo->prepare($staff_sql);
$staff->execute();
$staff = $staff->fetch(PDO::FETCH_ASSOC);

$staff_images_sql = "SELECT `image_url`,`subject_id` FROM `staff_images` WHERE `staff_id` = ".$staff_id." AND `image_url` != '' AND `subject_id` != 2 ORDER BY `subject_id` ASC";
$images = $pdo->prepare($staff_images_sql);
$images->execute();
$images = $images->fetchAll(PDO::FETCH_ASSOC);

$sns_sql = "SELECT `main_sns`,`main_sns_set`,`instagram_account_url`,`youtube_account_url`,`twitter_account_url`,`tiktok_account_url`,`main_sns` FROM `sns` WHERE `subject_id` = ".$staff_id." AND `subject_name` = 'staff' AND `main_sns_set` = 1 limit 1";
$sns = $pdo->prepare($sns_sql);
$sns->execute();
$sns = $sns->fetch(PDO::FETCH_ASSOC);

$questions_sql = "SELECT `answer`,`question` FROM `interviews` INNER JOIN `interview_answers` ON interviews.`id` = interview_answers.`interview_id` WHERE interview_answers.`staff_id` = ".$staff_id." AND interviews.`shop_id` = ".$shop_id." order by interviews.`priority` ASC";
$questions = $pdo->prepare($questions_sql);
$questions->execute();
$questions = $questions->fetchAll(PDO::FETCH_ASSOC);

$staff_name = $staff['name'];
$staff_post = $staff['post'];
$staff_performance = $staff['performance'];

//アクセスランキング集計用
$shop_sql = "SELECT access_ranking FROM shops WHERE id = :shop_id";
$shop = $pdo->prepare($shop_sql);
$shop->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$shop->execute();
$shop_ar = $shop->fetch(PDO::FETCH_ASSOC);

if ($shop_ar['access_ranking'] == 1) {
  track_access_to_staff();
}
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
<title>「<?php echo $staff_name;?>」の<?php echo $page_title; ?></title>
<meta name="description" content="<?php echo $page_description; ?>">
<link rel="canonical" href="<?= site_url('profile');?>?staff=<?php echo $staff_id; ?>">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/profile_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/profile_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/schedule-layout_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sns-modal_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sns-modal_sp.css" />
<link rel="icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- スワイパー -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('profile');?>?staff=<?php echo $staff_id; ?>" />
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

  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
</head>
<?php
// プロフィールページカスタムフィールドセット
  $sub_thumnail_list_thema_type = scf::get('サブサムネイルリストのテーマタイプ');
  $staff_name_text_color = scf::get('キャストの名前の文字色');
  $staff_detail_table_border_color = scf::get('キャスト詳細テーブルの枠線色');
  $staff_detail_table_inversion_color = scf::get('キャスト詳細テーブルの背景反転色');
  $staff_detail_table_TH_text_color = scf::get('プロフィールテーブルの行の左側のタイトルの文字色');
  $staff_detail_table_TH_bg_color = scf::get('プロフィールテーブルの行の左側のタイトルの背景色');
  $staff_detail_table_TD_text_color = scf::get('プロフィールテーブルの行の右側の内容の文字色');
  $staff_detail_table_TD_bg_color = scf::get('プロフィールテーブルの行の右側の内容の背景色');
?>

<?php get_template_part('common-styles'); ?>

<style type="text/css">
.cast_name_text_color {
  color: <?php echo $staff_name_text_color; ?>;
}
.cast_detail_table_border_color,
.performance {
	border-color: <?php echo $staff_detail_table_border_color; ?>;
}
.cast_detail_table_inversion_color {
  background-color: <?php echo $staff_detail_table_inversion_color; ?>;
}
.cast_detail_table_TH_style {
  background-color: <?php echo $staff_detail_table_TH_bg_color; ?>;
}
.cast_detail_table_TH_style span {
  color: <?php echo $staff_detail_table_TH_text_color; ?>;
}
.cast_detail_table_TD_style {
  background-color: <?php echo $staff_detail_table_TD_bg_color; ?>;
}
.cast_detail_table_TD_style span {
  color: <?php echo $staff_detail_table_TD_text_color; ?>;
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
      <a itemprop="item" href="<?= site_url('profile');?>/?staff=<?php echo $staff_id; ?>">
        <span class="text_style" itemprop="name">「<?php echo $staff_name;?>」のプロフィール</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">
  <div class="container">
    <article class="main">
      <section class="profile">
        <div class="profile__inner--<?= $profile_thema_type; ?>">
          <div class="left">
            <div class="main-thumnail border_color">
              <?php
                $count_images = count($images);
              ?>
              <?php if ($count_images > 0): ?>
                <?php $images[0]['image_url'] = str_replace('http://', 'https://', $images[0]['image_url']); ?>
                <?php if ($images[0]['image_url'] && $images[0]['subject_id'] == 1) { ?>
                  <img src="<?php echo $images[0]['image_url'];?>" alt="<?php echo $store_name; ?>所属スタッフの「<?php echo $staff_name;?>」のメイン肖像写真" />
                <?php
                  } else {
                ?>
                  <img src="<?php echo wp_get_attachment_url( $no_img );  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                <?php
                  }
                ?>
                <?php else: ?>
                  <img src="<?php echo wp_get_attachment_url( $no_img );  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
              <?php endif ?>
            </div> <!-- /main-thumnail -->
            <div class="sub-thumnail-wrap--<?php echo $sub_thumnail_list_thema_type; ?> swiper-container-profile">
              <ul class="swiper-wrapper  spotlight-group">
              <?php if ($count_images > 0): ?>
                <?php
                if ($images[0]['subject_id'] == 1) {
                  $j = 1;
                } else {
                  $j = 0;
                }
                ?>
                <?php
                  for($i = $j; $i < $count_images; $i++) {
                ?>
                <?php $images[$i]['image_url'] = str_replace('http://', 'https://', $images[$i]['image_url']); ?>
                <li class="swiper-slide border_color">
                  <div class="sub-thumnail">
                    <a class="spotlight" href="<?php echo $images[$i]['image_url'];?>">
                      <img src="<?php echo $images[$i]['image_url'];?>" alt="<?php echo $store_name; ?>所属スタッフの「<?php echo $staff_name;?>」のサブ肖像写真<?php echo $i; ?>番目" />
                    </a>
                  </div> <!-- /sub-thumnail -->
                </li>
                <?php
                  }
                ?>
              <?php endif ?>
              </ul>
            </div> <!-- /sub-thumnail-wrap -->

            <?php
              switch ( $sub_thumnail_list_thema_type ):
                case 'pop':
            ?>
            <!-- スワイパー動かさない -->
            <?php break; ?>
            <?php case 'stylish': ?>
            <!-- スワイパー動かさない -->
            <?php break; ?>
            <?php case 'luxury': ?>
            <script type="text/javascript">
                var mySwiper = new Swiper ('.swiper-container-profile', {
                effect: "slide",
                fadeEffect: {
                  crossFade: true
                },
                slidesPerView: 2.452,
                spaceBetween: 11,
                loop: false,
                breakpoints: {
                  // 768px以上の場合
                  768: {
                    slidesPerView: 3.591,
                    spaceBetween: 11,
                  },
                }
                })
            </script>
            <?php break; ?>
            <?php endswitch; ?>
          </div> <!-- /left -->

          <div class="right">
            <h2 class="cast_name_text_color border_color"><?php echo $staff_name;?></h2>
            <div class="wrap">
              <p class="cast_name_text_color border_color"><?= $staff_post; ?></p>
              <ul class="profile__sns-list">
                <?php
                $instagram_account_url = !empty($sns['instagram_account_url']) ? $sns['instagram_account_url'] : "";
                $youtube_account_url = !empty($sns['youtube_account_url']) ? $sns['youtube_account_url'] : "";
                $twitter_account_url = !empty($sns['twitter_account_url']) ? $sns['twitter_account_url'] : "";
                $tiktok_account_url = !empty($sns['tiktok_account_url']) ? $sns['tiktok_account_url'] : "";
                if($instagram_account_url != "") {
                ?>
                <li class="profile__sns-list-item--<?php echo $profile_thema_type; ?> border_color">
                    <a class="profile__sns-list-item-link--<?php echo $profile_thema_type; ?> sns_icon_bg_color" href="<?php echo $instagram_account_url; ?>" target="_blank">
                      <i class="profile__sns-list-item-instagram-icon--<?php echo $profile_thema_type; ?> sns_icon_color">
                        <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"/></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"/></g></svg>
                      </i>
                    </a>
                </li>
                <?php
                }
                if($youtube_account_url != "") {
                ?>
                <li class="profile__sns-list-item--<?php echo $profile_thema_type; ?> border_color">
                    <a class="profile__sns-list-item-link--<?php echo $profile_thema_type; ?> sns_icon_bg_color" href="<?php echo $youtube_account_url; ?>" target="_blank">
                      <i class="profile__sns-list-item-youtube-icon--<?php echo $profile_thema_type; ?> sns_icon_color">
                        <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"/></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"/></g></svg>
                      </i>
                    </a>
                </li>
                <?php
                }
                if($twitter_account_url != "") {
                ?>
                <li class="profile__sns-list-item--<?php echo $profile_thema_type; ?> border_color">
                    <a class="profile__sns-list-item-link--<?php echo $profile_thema_type; ?> sns_icon_bg_color" href="<?php echo $twitter_account_url; ?>" target="_blank">
                      <i class="profile__sns-list-item-twitter-icon--<?php echo $profile_thema_type; ?> sns_icon_color">
                        <svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%">
                        <defs>
                            <clipPath id="a" />
                        </defs>
                        <g class="a" transform="translate(0 0)">
                            <path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" />
                            <polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" />
                            <polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" />
                        </g>
                    </svg>
                      </i>
                    </a>
                </li>
                <?php
                }
                if($tiktok_account_url != "") {
                ?>
                <li class="profile__sns-list-item--<?php echo $profile_thema_type; ?> border_color">
                    <a class="profile__sns-list-item-link--<?php echo $profile_thema_type; ?> sns_icon_bg_color" href="<?php echo $tiktok_account_url; ?>" target="_blank">
                      <i class="profile__sns-list-item-tiktok-icon--<?php echo $profile_thema_type; ?> sns_icon_color">
                        <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"/></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"/></g></svg>
                      </i>
                    </a>
                </li>
                <?php
                }
                ?>
              </ul>
            </div> <!-- /wrap -->
            <table>
              <?php
              foreach($questions as $question) {
              ?>
                <?php if ($question['answer']): ?>
                <tr class="cast_detail_table_inversion_color">
                  <th class="cast_detail_table_border_color cast_detail_table_TH_style"><span class="text_style"><?php echo $question['question'];?></span></th>
                  <td class="cast_detail_table_border_color cast_detail_table_TD_style"><span class="text_style"><?php echo $question['answer'];?></span></td>
                </tr>
                <?php endif ?>
              <?php } ?>
            </table>
            <?php if($staff_performance) { ?>
              <div class="performance <?php echo $profile_thema_type; ?>">
                <p><?=  nl2br($staff_performance); ?></p>
              </div>
            <?php } ?>
            <a class="cast-page-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('staff');?>/">
              <span>back to staff list</span>
            </a>
          </div> <!-- /right -->
        </div> <!-- /profile__inner -->
      </section> <!-- /profile -->

      <?php
        if ($sns !== false) {
          $main_sns = $sns['main_sns'];
        } else {
          $main_sns = null;
        }
        $sns_type_conditions = [];

        if (strpos($main_sns, '0') !== false) {
          $sns_type_conditions[] = "sns_posts.`sns_type` = 0";
        }
        if (strpos($main_sns, '1') !== false) {
          $sns_type_conditions[] = "sns_posts.`sns_type` = 1";
        }
        if (strpos($main_sns, '2') !== false) {
          $sns_type_conditions[] = "sns_posts.`sns_type` = 2";
        }
        if (strpos($main_sns, '3') !== false) {
          $sns_type_conditions[] = "sns_posts.`sns_type` = 3";
        }
        if (empty($main_sns)) { //何も表示させない
          $sns_type_conditions[] = "sns_posts.`sns_type` = -1";
        }

        $sns_type_condition = implode(" OR ", $sns_type_conditions);

        $sns_list_sql = "SELECT sns_posts.`id` AS `id`, sns.`instagram_account_url` AS `instagram_account_url`, sns.`youtube_account_url` AS `youtube_account_url`, sns.`twitter_account_url` AS `twitter_account_url`, sns.`tiktok_account_url` AS `tiktok_account_url`, sns_posts.`parent_id` AS `parent_id`, sns_posts.`priority` AS `priority`, sns_posts.`subject_id` AS `subject_id`, sns_posts.`subject_name` AS `subject_name`, sns_posts.`sns_type` AS `sns_type`,sns_posts.`guid` AS `guid`, sns_posts.`original_image_url` AS `original_image_url`, sns_posts.`original_video_url` AS `original_video_url`, sns_posts.`image_url` AS `image_url`, sns_posts.`video_url` AS `video_url`, sns_posts.`description` AS `description`, sns_posts.`published_at` AS `published_at`, shops.`id` AS `shop_id`, staffs.`id` AS `staff_id` ,staffs.`name` AS `name`, staff_images.`image_url` AS `thumbnail`, shops.`name` AS `shop_name`,sns.`main_sns` AS `main_sns` FROM `sns_posts` JOIN `sns` ON sns.`subject_id` = sns_posts.`subject_id` and sns.`subject_name` = sns_posts.`subject_name` JOIN `staffs` ON staffs.`id` = sns_posts.`subject_id` JOIN `shops` ON shops.`id` = staffs.`shop_id` JOIN `staff_images` ON staffs.`id` = staff_images.`staff_id` WHERE staff_images.`subject_id` = 1 AND staffs.`id` = ".$staff_id." AND sns.`hosweb_privacy` = 1 AND ($sns_type_condition)  ORDER BY `published_at` DESC LIMIT 100";
        $sns_list = $pdo->prepare($sns_list_sql);
        $sns_list->execute();
        $sns_list = $sns_list->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach($sns_list as $post) {
          if(!is_null($post["parent_id"])) {
            // すでに親IDのリストが存在するか確認
            $parent = null;
            foreach(array_keys($list) as $item) {
              if($post["parent_id"] == $item) {
                $parent = $item;
                break;
              }
            }
            // 親IDのリストが存在しない場合、新しいリストを作成して追加
            if(is_null($parent)) {
              $list[$post["parent_id"]] = [];
              $list[$post["parent_id"]][] = $post;
            } else {
              $list[$parent][] = $post;
              usort($list[$parent],['Item','sortByPriority']);
            }
          } else {
            $target = null;
            foreach(array_keys($list) as $item) {
              if($item == $post['id']) {
                $target = $item;
                break;
              }
            }
            if(is_null($target)) {
              $list[$post['id']] = [];
              $list[$post['id']][] = $post;
            } else {
              $list[$target][] = $post;
              usort($list[$target],['Item','sortByPriority']);
            }
          }
        }
        $sns_list = $list;
        class Item {
          public static function sortByPriority($a, $b) {
            return $a["priority"] - $b["priority"];
          }
        }

        // 最終的な結果を最新順に並べ替え最新の27件を取得
        usort($sns_list, function($a, $b) {
          $dateA = isset($a[0]['published_at']) ? strtotime($a[0]['published_at']) : 0;
          $dateB = isset($b[0]['published_at']) ? strtotime($b[0]['published_at']) : 0;
          return $dateB - $dateA;
        });
        $sns_list = array_slice($sns_list, 0, 27);

         // To sns-modal.php
        $sns_data = array(
          'sns_list' => $sns_list
        );
        set_query_var('sns_data', $sns_data);
      ?>

      <?php
      //全記事数を変数に代入。
       $total_count = count($sns_list);
      //記事０件ならブロックごと出さない。
       if ($total_count) {
      ?>

      <section class="sns">
        <div class="sns__inner--<?php echo $sns_thema_type; ?>">
          <h2 class="sns__title-main--<?php echo $sns_thema_type; ?> title_style">S N S</h2>
          <h3 class="sns__title-sub--<?php echo $sns_thema_type; ?> sub_title_style">新着インスタ・ティックトック・ユーチューブ</h3>

            <ul class="sns__list--<?php echo $sns_thema_type; ?>">
            <?php
              $count = 1;
              foreach ($sns_list as $key => $value) {
              if($value[0]['image_url'] != "" || $value[0]['thumbnail']) {
                if ($count == 1) { // ループの初回だけ実行
                  if (strpos($main_sns, '0') !== false) {
                    $main_sns_account_url = $instagram_account_url;
                    $main_sns_name = 'Instagram';
                  } elseif (strpos($main_sns, '3') !== false) {
                    $main_sns_account_url = $tiktok_account_url;
                    $main_sns_name = 'TikTok';
                  } elseif (strpos($main_sns, '1') !== false) {
                    $main_sns_account_url = $youtube_account_url;
                    $main_sns_name = 'Youtube';
                  } elseif (strpos($main_sns, '2') !== false) {
                    $main_sns_account_url = $twitter_account_url;
                    $main_sns_name = 'X';
                  } else {
                    $main_sns_account_url = $instagram_account_url;
                    $main_sns_name = 'Instagram';
                  }
                }
                if ($count == 10) {
                  break;
                } // SNS記事を9件出力したらループ終了
            ?>
              <?php
              //SNS種類による出力切り分けの変数セット
              $sns_name = '';
              $svg = '';
               switch ($value[0]['sns_type']) {
                case '0':
                  $sns_name = 'Instagram';
                  $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"></path></g></svg>';
                  break;
                case '1':
                  $sns_name = 'YouTube';
                  $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"></clipPath></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"></path></g></svg>';
                  break;
                case '2':
                  $sns_name = 'Twitter';
                  $svg = '<svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%"><defs><clipPath id="a" /></defs><g class="a" transform="translate(0 0)"><path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" /><polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" /><polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" /></g></svg>';
                  break;
                case '3':
                  $sns_name = 'Tiktok';
                  $svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"></path></g></svg>';
                  break;
                 }
              ?>
              <li class="position<?php echo sprintf('%02d', $count); ?> sns__list-item--<?php echo $sns_thema_type; ?>  border_color" data-cast_id="<?php if($value[0]['staff_id']){ echo $value[0]['staff_id']; } else {echo '0';}?>" data-shop_id="<?php echo $value[0]['shop_id'];?>">
                <div class="sns__list-item-thumnail--<?php echo $sns_thema_type; ?>">
                  <?php
                    $value[0]['image_url'] = str_replace('http://', 'https://', $value[0]['image_url']);
                    $value[0]['thumbnail'] = str_replace('http://', 'https://', $value[0]['thumbnail']);
                  ?>
                  <img class="sns__list-item-thumnail-img--<?php echo $sns_thema_type; ?>" src="<?php if($value[0]['image_url']) { echo $value[0]['image_url']; } elseif($value[0]['thumbnail']) { echo $value[0]['thumbnail']; } else { echo $no_img; } ?>" alt="<?php echo $count; ?>番目のSNSサムネイル、'<?php echo $value[0]['shop_name']; ?>'<?php if($value[0]['subject_name'] == 'staff' ){ echo '所属のスタッフ' . $value[0]['name'];}?>の<?php echo $sns_name; ?>投稿" />
                   <span class="sns__list-item-thumnail-snslink--<?php echo $sns_thema_type; ?> sns_icon_bg_color" href="">
                    <i class="sns__list-item-thumnail-<?php echo $sns_name; ?>-icon--<?php echo $sns_thema_type; ?> sns_icon_color">
                      <?php echo $svg; ?>
                    </i>
                  </span>
                </div> <!-- /sns__list-item-thumnail -->
              </li>
            <?php
                }
              $count++;
              } //end_foreach
            ?>
          </ul>
            <a class="sns__more-button--<?php echo $button_shape_thema_type; ?> button_style border_color more" href="<?php echo $main_sns_account_url; ?>" target="_blank"><span><?php echo $staff_name; ?>の<?php echo $main_sns_name; ?>を見る</span></a>
          </ul>
        </div> <!-- /sns__inner -->
      </section> <!-- /sns -->

      <?php
        }
      ?>

      <section class="schedule">
        <div class="schedule__inner--<?= $staff_thema_type; ?>">
          <h2 class="schedule__title-main--<?= $staff_thema_type; ?> title_style">O T H E R&nbsp;&nbsp;S T A F F</h2>
          <h3 class="schedule__title-sub--<?= $staff_thema_type; ?> sub_title_style">他の在籍スタッフ</h3>

          <ul class="schedule__list--<?= $staff_thema_type; ?>">
            <?php
              $staffs_sql = "SELECT staff_images.`staff_id`,staff_images.`image_url`,staffs.`name`,staffs.`post` FROM `staffs` JOIN `staff_images` ON staffs.`id` = staff_images.`staff_id` WHERE staff_images.`subject_id` = 1 AND staffs.`shop_id` = " . $shop_id . " AND staffs.`hosweb_privacy` = 1 ORDER BY staffs.`priority` ASC";
              $staffs = $pdo->prepare($staffs_sql);
      	      $staffs->execute();
      	      $staffs = $staffs->fetchAll(PDO::FETCH_ASSOC);
              foreach($staffs as $staff) {
                $sns_sql = "SELECT DISTINCT `main_sns`,`main_sns_set`,`instagram_account_url`,`youtube_account_url`,`twitter_account_url`,`tiktok_account_url` FROM `sns` WHERE `subject_name` = 'staff' AND subject_id = ".$staff['staff_id']." limit 1";
            		$sns = $pdo->prepare($sns_sql);
            		$sns->execute();
            		$sns = $sns->fetch();
            ?>
            <li class="schedule__list-item--<?= $staff_thema_type; ?> border_color">
              <a href="<?= site_url('profile');?>/?staff=<?php echo $staff['staff_id'];?>">
                <div class="schedule__list-item-thumnail--<?= $staff_thema_type; ?>">
                <?php
                  if($staff['image_url'] != "") {
                    $staff['image_url'] = str_replace('http://', 'https://', $staff['image_url']);
                ?>
                  <img class="schedule__list-item-thumnail-img--<?= $staff_thema_type; ?>" src="<?php echo $staff['image_url'];?>" alt="<?php echo $store_name; ?>所属スタッフの<?php echo $staff['name'];?>の肖像写真" />
                <?php
                  } else {
                ?>
                  <img class="schedule__list-item-thumnail-img--<?= $staff_thema_type; ?>" src="<?php echo wp_get_attachment_url( $no_img );  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー" />
                <?php
                  }
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
                        case 0:
                          $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"></path></g></svg>';
                          break;
                        case 1:
                          $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"></clipPath></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"></path></g></svg>';
                          break;
                        case 2:
                          $svg = '<svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%"><defs><clipPath id="a" /></defs><g class="a" transform="translate(0 0)"><path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" /><polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" /><polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" /></g></svg>';
                          break;
                        case 3:
                          $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"></path></g></svg>';
                          break;
                        default:
                          $svg = '';
                          break;
                      }
                      if($svg != '' && $sns['main_sns_set'] ) {
                        echo '<span class="schedule__list-item-thumnail-snslink--'.$staff_thema_type.' sns_icon_bg_color"><i class="schedule__list-item-thumnail-tiktok-icon--'.$staff_thema_type.' sns_icon_color">'.$svg.'</i></span>';
                      }
                      ?>
                </div> <!-- /schedule__list-item-thumnail -->
                <div class="schedule__list-item-content--<?= $staff_thema_type; ?> schedule_cast_name_bg_color">
                  <p class="schedule__list-item-content-title--<?= $staff_thema_type; ?> schedule_cast_name_text_color"><i><?php echo  $staff['post'];?></i></p>
                  <h4 class="schedule__list-item-content-title--<?= $staff_thema_type; ?> schedule_cast_name_text_color"><i><?php echo  $staff['name'];?></i></h4>
                </div> <!-- /news__list-item-content -->
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </div> <!-- /schedule__inner -->
      </section> <!-- /schedule -->

  <?php get_footer(); ?>

<script type="application/ld+json">
  [
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?= site_url('profile');?>/"
    },
      "inLanguage": "ja",
      "author": {
      "@type": "Organization",
      "@id": "<?= site_url();?>/",
      "name": "<?php echo $store_name; ?>",
      "url": "<?= site_url();?>/",
      "image": "<?php echo wp_get_attachment_url( $logo );  ?>"
    },
      "headline": "スタッフ一覧",
      "description": "<?php echo $page_description; ?>"
    },
    {
      "@context" : "https://schema.org",
      "@type" : "Organization",
      "name" : "<?php echo $store_name; ?>",
      "url" : "<?= site_url();?>/",
      "logo": "<?php echo wp_get_attachment_url( $logo );  ?>",
      "contactPoint" : [ 
        { 
          "@type" : "ContactPoint",
          <?php echo $international_tel; ?>
          "telephone" : "<?php echo $mono_international_tel; ?>",
          "contactType" : "customer support"
        }
      ],
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
          "item":{
            "name":"TOP",
            "@id":"<?= site_url();?>/"
          }
        },
        {
          "@type":"ListItem",
          "position":2,
          "item":{
            "name":"STAFF",
            "@id":"<?= site_url('profile');?>/"
          }
        }
      ]
    }
  ]
</script>
