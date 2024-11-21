<?php
  require(__DIR__ . '/../setting.php');

  // スタッフのリストを取得
  $staffs_query = "SELECT * FROM staffs WHERE shop_id = :shop_id";
  $staff_stmt = $pdo->prepare($staffs_query);
  $staff_stmt->execute(array(':shop_id' => $shop_id));
  $staffs = $staff_stmt->fetchAll(PDO::FETCH_ASSOC);

  $sns_list = array();

  // 各スタッフに対してSNS投稿を取得
  foreach($staffs as $staff) {
    $sns_sql = "SELECT `main_sns` FROM `sns` WHERE `subject_id` = ".$staff['id']." AND `subject_name` = 'staff' AND `main_sns_set` = 1 LIMIT 1";
    $main_sns_stmt = $pdo->prepare($sns_sql);
    $main_sns_stmt->execute();
    $main_sns = $main_sns_stmt->fetchColumn();

    // main_snsからsns_typeの条件を取得
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
    if (empty($main_sns)) { // 何も表示させない
      $sns_type_conditions[] = "sns_posts.`sns_type` = -1";
    }
    $sns_type_condition = implode(" OR ", $sns_type_conditions);

    // 各スタッフのSNS投稿を取得
    $sns_list_sql = "SELECT sns_posts.`id` AS `id`, sns.`instagram_account_url` AS `instagram_account_url`, sns.`youtube_account_url` AS `youtube_account_url`, sns.`twitter_account_url` AS `twitter_account_url`, sns.`tiktok_account_url` AS `tiktok_account_url`, sns_posts.`parent_id` AS `parent_id`, sns_posts.`priority` AS `priority`, sns_posts.`subject_id` AS `subject_id`, sns_posts.`subject_name` AS `subject_name`, sns_posts.`sns_type` AS `sns_type`,sns_posts.`guid` AS `guid`, sns_posts.`original_image_url` AS `original_image_url`, sns_posts.`original_video_url` AS `original_video_url`, sns_posts.`image_url` AS `image_url`, sns_posts.`video_url` AS `video_url`, sns_posts.`description` AS `description`, sns_posts.`published_at` AS `published_at`, shops.`id` AS `shop_id`, staffs.`id` AS `staff_id` ,staffs.`name` AS `name`, staff_images.`image_url` AS `thumbnail`, shops.`name` AS `shop_name`,sns.`main_sns` AS `main_sns` FROM `sns_posts` JOIN `sns` ON sns.`subject_id` = sns_posts.`subject_id` and sns.`subject_name` = sns_posts.`subject_name` JOIN `staffs` ON staffs.`id` = sns_posts.`subject_id` JOIN `shops` ON shops.`id` = staffs.`shop_id` JOIN `staff_images` ON staffs.`id` = staff_images.`staff_id` WHERE staff_images.`subject_id` = 1 AND staffs.`id` = ".$staff['id']." AND sns.`hosweb_privacy` = 1 AND ($sns_type_condition) AND (sns_posts.image_url IS NOT NULL OR sns_posts.image_url != '') ORDER BY `published_at` DESC LIMIT 100";
    $sns_list_stmt = $pdo->prepare($sns_list_sql);
    $sns_list_stmt->execute();
    $sns_list_staff = $sns_list_stmt->fetchAll(PDO::FETCH_ASSOC);

    // 結果を $sns_list にマージ
    $sns_list = array_merge($sns_list, $sns_list_staff);
  }

  // ショップを取得
  $sns_sql_shop = "SELECT `main_sns` FROM `sns` WHERE `subject_id` = ".$shop_id." AND `subject_name` = 'shop' AND `main_sns_set` = 1 LIMIT 1";
  $main_sns_stmt_shop = $pdo->prepare($sns_sql_shop);
  $main_sns_stmt_shop->execute();
  $main_sns_shop = $main_sns_stmt_shop->fetchColumn();

  $sns_type_conditions_shop = [];
  if (strpos($main_sns_shop, '0') !== false) {
    $sns_type_conditions_shop[] = "sns_posts.`sns_type` = 0";
  }
  if (strpos($main_sns_shop, '1') !== false) {
    $sns_type_conditions_shop[] = "sns_posts.`sns_type` = 1";
  }
  if (strpos($main_sns_shop, '2') !== false) {
    $sns_type_conditions_shop[] = "sns_posts.`sns_type` = 2";
  }
  if (strpos($main_sns_shop, '3') !== false) {
    $sns_type_conditions_shop[] = "sns_posts.`sns_type` = 3";
  }
  if (empty($main_sns_shop)) { //何も表示させない
    $sns_type_conditions_shop[] = "sns_posts.`sns_type` = -1";
  }
  $sns_type_condition_shop = implode(" OR ", $sns_type_conditions_shop);

  $sns_list_sql_shop = "SELECT sns_posts.`id` AS `id`, sns.`instagram_account_url` AS `instagram_account_url`, sns.`youtube_account_url` AS `youtube_account_url`, sns.`twitter_account_url` AS `twitter_account_url`, sns.`tiktok_account_url` AS `tiktok_account_url`, sns_posts.`parent_id` AS `parent_id`, sns_posts.`priority` AS `priority`, sns_posts.`subject_id` AS `subject_id`, sns_posts.`subject_name` AS `subject_name`, sns_posts.`sns_type` AS `sns_type`,sns_posts.`guid` AS `guid`, sns_posts.`original_image_url` AS `original_image_url`, sns_posts.`original_video_url` AS `original_video_url`,sns_posts.`image_url` AS `image_url`, sns_posts.`video_url` AS `video_url`, sns_posts.`description` AS `description`, sns_posts.`published_at` AS `published_at`, shops.`id` AS `shop_id`, NULL AS `staff_id`,shops.`name` AS `name`,shops.`name` AS `shop_name`, shop_images.`image_url` AS `thumbnail` FROM `sns_posts` JOIN `sns` ON sns.`subject_id` = sns_posts.`subject_id` AND sns.`subject_name` = sns_posts.`subject_name` JOIN `shops` ON shops.`id` = sns_posts.`subject_id` JOIN `shop_images` ON shop_images.`shop_id` = shops.`id` WHERE shop_images.`images_subject` = 'サムネ' AND shops.`id` = " . $shop_id . " AND sns.`hosweb_privacy` = 1 AND ($sns_type_condition_shop)  AND (sns_posts.image_url IS NOT NULL OR sns_posts.image_url != '') ORDER BY `published_at` DESC LIMIT 100";
  $sns_list_stmt = $pdo->prepare($sns_list_sql_shop);
  $sns_list_stmt->execute();
  $sns_list_shop = $sns_list_stmt->fetchAll(PDO::FETCH_ASSOC);

  class Item {
    public static function sortByPriority($a, $b) {
      return $a["priority"] - $b["priority"];
    }
  }

  // 結果を $sns_list にマージ
  $sns_list = array_merge($sns_list, $sns_list_shop);
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
    <?php
    $count = 1;
    foreach ($sns_list as $value) {
      if ($value[0]['image_url'] != "" || $value[0]['thumbnail']) {
        if ($count % 9 == 1) { // ループの初回だけ実行
          ?>
          <ul class="sns__list--<?php echo $sns_thema_type; ?>">
          <?php
            } // ul開始タグ判定
          ?>
          <?php
            //SNS種類による出力切り分けの変数セット
            $account_url = '';
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
          <li class="position<?php echo sprintf('%02d', $count); ?> sns__list-item--<?php echo $sns_thema_type; ?>  border_color" data-cast_id="<?php if ($value[0]['staff_id']) {
                                                                                                                                                    echo $value[0]['staff_id'];
                                                                                                                                                  } else {
                                                                                                                                                    echo '0';
                                                                                                                                                  } ?>" data-shop_id="<?php echo $value[0]['shop_id']; ?>">
            <div class="sns__list-item-thumnail--<?php echo $sns_thema_type; ?>">
              <?php
                $value[0]['image_url'] = str_replace('http://', 'https://', $value[0]['image_url']);
                $value[0]['thumbnail'] = str_replace('http://', 'https://', $value[0]['thumbnail']);
              ?>
              <img class="sns__list-item-thumnail-img--<?php echo $sns_thema_type; ?>" src="<?php if ($value[0]['image_url']) {
                                                                                                echo $value[0]['image_url'];
                                                                                              } elseif ($value[0]['thumbnail']) {
                                                                                                echo $value[0]['thumbnail'];
                                                                                              } else {
                                                                                                echo $no_img;
                                                                                              } ?>" alt="<?php echo $count; ?>番目のSNSサムネイル、'<?php echo $value[0]['shop_name']; ?>'<?php if ($value[0]['subject_name'] == 'staff') {
                                                                                                                                                                                  echo '所属のスタッフ' . $value[0]['name'];
                                                                                                                                                                                } ?>の<?php echo $sns_name; ?>投稿" />
              <span class="sns__list-item-thumnail-snslink--<?php echo $sns_thema_type; ?> sns_icon_bg_color" href="">
                <i class="sns__list-item-thumnail-<?php echo $sns_name; ?>-icon--<?php echo $sns_thema_type; ?> sns_icon_color">
                  <?php echo $svg; ?>
                </i>
              </span>
            </div> <!-- /sns__list-item-thumnail -->
          </li>
          <?php
            if (($count % 9 == 0) || ($count == $total_count)) {
          ?>
          </ul>
            <?php
              if ($count != $total_count) {
            ?>
          <b class="sns__more-button--<?php echo $button_shape_thema_type; ?> more" href=""><span><?php echo $sns_link_button_text; ?></span></b>
          <?php
            } //end_if 最後の1件はもっと見るボタンを出さない
          ?>
        <?php
          } //end_if ul閉じタグ9件で1セット判定
        ?>
      <?php
        $count++;
      }
    } //end_foreach
  ?>

  </div> <!-- /sns__inner -->
</section> <!-- /sns -->
<?php } ?>
