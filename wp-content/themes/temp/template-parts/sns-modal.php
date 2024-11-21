<!-- SNS modal start -->
<div id="sns-modal-window">
  <div class="sns-modal-window__inner--<?= $modal_thema_type; ?> modal_inner">
    <ul>
      <?php
        // From sns.php
        $sns_data = get_query_var('sns_data');

        $cnt = 1;
        $video_cnt = 1;
        $i =0;
        // foreach($sns_list as $post){
        foreach($sns_data['sns_list'] as $post){
          $account_url = '';
          $sns_name = '';
          $svg = '';
          $sns_type = $post[0]['sns_type'];
          $subject_name = $post[0]['subject_name'];
          $for_img_no = $i + 1;
        ?>
          <li class="position<?= sprintf("%02d", $cnt); ?>">
            <div class="top modal_top_block_bg_color">
              <div class="wrap">
                <div class="left">
                  <?php
                    switch ($subject_name) {
                      case 'staff':
                        $url = site_url('profile') . "/?staff=" . $post[0]['subject_id'];
                        break;
                      default:
                        $url = site_url();
                        break;
                    }
                  ?>
                  <a href="<?= $url; ?>">
                    <?php
                      if ($post[0]['thumbnail']) {
                        $post[0]['thumbnail'] = str_replace('http://', 'https://', $post[0]['thumbnail']);
                    ?>
                        <img src="<?= $post[0]['thumbnail']; ?>" alt="<?= $for_img_no; ?>番目のモーダル版' .$store_name. '所属のキャスト' .$post[0]['name']. 'のSNS写真" />
                    <?php
                      } else {
                    ?>
                        <img src="<?= wp_get_attachment_url($no_img); ?>" class="sns_modal_no_img" alt="画像未登録時の代替え画像の<?= $store_name; ?>のロゴバナー" />
                    <?php
                      }
                    ?>
                  </a>
                  <div class="content">
                    <h2 class="modal_top_block_text_color"><?= $post[0]['name']; ?></h2>
                    <h3 class="modal_top_block_text_color"><?= $post[0]['shop_name']; ?></h3>
                  </div>
                </div>
                <div class="right">
                  <?php
                    if($post[0]["sns_type"] == 0) {
                      $sns_name = 'Instagram';
                      $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"></path></g></svg>';
                      $account_url = $post[0]['instagram_account_url'];
                    } elseif($post[0]["sns_type"] == 1) {
                      $sns_name = 'YouTube';
                      $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"></clipPath></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"></path></g></svg>';
                      $account_url = $post[0]['youtube_account_url'];
                    } elseif($post[0]["sns_type"] == 2) {
                      $sns_name = 'Twitter';
                      $svg = '<svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%"><defs><clipPath id="a" /></defs><g class="a" transform="translate(0 0)"><path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" /><polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" /><polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" /></g></svg>';
                      $account_url = $post[0]['twitter_account_url'];
                    } elseif($post[0]["sns_type"] == 3) {
                      $sns_name = 'Tiktok';
                      $svg = '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"/></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"/></g></svg>';
                      $account_url = $post[0]['tiktok_account_url'];
                    }
                  ?>
                  <a class="to_sns_link modal_sns_icon_bg_color" href="<?= $account_url; ?>" target="_blank">
                    <i class="<?= $sns_name; ?>-icon modal_sns_icon_color">
                      <?= $svg; ?>
                    </i>
                  </a>
                </div>
              </div>
            </div>
            <?php
              if(count($post)>1) {
                $content =  '<div class="swiper"><!-- Additional required wrapper --><div class="swiper-wrapper"><!-- Slides -->';
                foreach($post as $item){
                  $content .='<div class="swiper-slide">';
                  if(is_null($item['video_url']) || $item['video_url'] == '') {
                    $content .= '<img src="'.$item['image_url'].'" alt="">';
                  } else {
                    $content .= '<video id="player_'.$video_cnt.'" playsinline controls muted loop><source src="'.$item['video_url'].'" type="video/mp4"></video>';
                    $video_cnt++;
                  }
                  $content .= '</div>';
                }
                $content .='</div><!-- If we need pagination --><div class="swiper-pagination"></div><!-- If we need navigation buttons --><div class="swiper-button-prev"></div><div class="swiper-button-next"></div><!-- If we need scrollbar --><div class="swiper-scrollbar"></div></div>';
                echo $content;
              } elseif($post[0]["sns_type"] == 3) {
                echo '<video id="player_'.$cnt.'" playsinline controls muted loop><source src="'.$post[0]['video_url'].'" type="video/mp4"></video>';
              } elseif($post[0]["sns_type"] == 1) {
                echo '<iframe width="100%"src="'.$post[0]['original_video_url'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
              } elseif(count($post) == 1) {
                if (is_null($post[0]['video_url']) || $post[0]['video_url'] == '') {
                  echo '<img src="'.$post[0]['image_url'].'" alt=""/>';
                } else {
                  echo '<video id="player_'.$cnt.'" playsinline controls muted loop><source src="'.$post[0]['video_url'].'" type="video/mp4"></video>';
                }
              }
            ?>
            <p class="modal_top_block_text_color modal_top_block_bg_color"><?= $post[0]['description']; ?></p>
          </li>
        <?php
          $cnt++;
        }
      ?>
    </ul>
    <b><span>×</span><small>閉じる</small></b>
  </div>
</div>
<!-- SNS modal end -->
