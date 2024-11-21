<?php
global $staff_recruit_page_exsitance_flg;
global $staff_recruit_url;
global $shop_id;
global $thema_color;
global $sub_color;
global $title_color;
global $title_font;
global $text_color;
global $text_font;
global $border_color;
global $logo;
global $logo_width;
global $sp_logo_width;
global $header_menu_line_color;
global $header_border_color;
global $main_nav_thematype;
global $main_nav_bg_color;
global $main_nav_boder_color;
global $main_nav_text_color;
global $main_nav_inversion_text_color;
global $main_nav_english_font;
global $main_nav_inversion_color01;
global $main_nav_contact_text_color;
global $main_nav_contact_bg_color;
global $main_nav_sns_icon_color;
global $tel;
?>
<?php
require("setting.php");
?>

<body class="sub_bg_color" ontouchstart="">
  <div id="drawer_gray_out" class="drawer_gray_out_bgcolor">
  </div> <!-- /gray_out -->
  <input id="open" type="checkbox">
  <nav class="main-nav main_nav_bg_color">
    <div class="main-nav__inner--<?php echo $main_nav_thematype; ?>">
      <ul class="main-nav__list--<?php echo $main_nav_thematype; ?> main_nav_border_color" itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement">
        <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                if (is_home() || is_front_page()) {
                                                                                                                                  echo "main_nav_active";
                                                                                                                                } ?>" itemprop="name">
          <a itemprop="url" href="<?= site_url(); ?>/">
            <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">TOP</h2>
            <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">トップ</h3>
            <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
              <defs></defs>
              <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
            </svg>
          </a>
        </li>
        <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                if (is_page('news')) {
                                                                                                                                  echo "main_nav_active";
                                                                                                                                } ?>" itemprop="name">
          <a itemprop="url" href="<?= site_url('news'); ?>/">
            <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">NEWS</h2>
            <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">最新ニュース</h3>
            <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
              <defs></defs>
              <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
            </svg>
          </a>
        </li>
        <?php if ($shop['event_privacy'] == 1) : ?>
          <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                  if (is_page('calendar')) {
                                                                                                                                    echo "main_nav_active";
                                                                                                                                  } ?>" itemprop="name">
            <a itemprop="url" href="<?= site_url('calendar'); ?>/">
              <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">EVENT CALENDAR</h2>
              <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">カレンダー</h3>
              <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                <defs></defs>
                <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
              </svg>
            </a>
          </li>
        <?php endif ?>
        <?php if ($staffs_count['count(id)'] > 0) : ?>
          <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                  if (is_page('staff')) {
                                                                                                                                    echo "main_nav_active";
                                                                                                                                  } ?>" itemprop="name">
            <a itemprop="url" href="<?= site_url('staff'); ?>/">
              <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">STAFF</h2>
              <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">スタッフ一覧</h3>
              <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                <defs></defs>
                <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
              </svg>
            </a>
          </li>

          <?php if ($before_btn == "view") : ?>
            <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                    if (is_page('ranking')) {
                                                                                                                                      echo "main_nav_active";
                                                                                                                                    } ?>" itemprop="name">
              <a itemprop="url" href="<?= site_url('ranking'); ?>/">
                <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">RANKING</h2>
                <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">ランキング一覧</h3>
                <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                  <defs></defs>
                  <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
                </svg>
              </a>
            </li>
          <?php endif ?>
        <?php endif ?>
        <?php if ($for_count_photos) { ?>
          <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                  if (is_page('shop-photo')) {
                                                                                                                                    echo "main_nav_active";
                                                                                                                                  } ?>" itemprop="name">
            <a itemprop="url" href="<?= site_url('shop-photo'); ?>/">
              <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">SHOP PHOTO</h2>
              <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">店内写真</h3>
              <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                <defs></defs>
                <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
              </svg>
            </a>
          </li>
        <?php } ?>
        <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                if (is_page('fee-system')) {
                                                                                                                                  echo "main_nav_active";
                                                                                                                                } ?>" itemprop="name">
          <a itemprop="url" href="<?= site_url('fee-system'); ?>/">
            <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">SYSTEM</h2>
            <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">料金システム</h3>
            <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
              <defs></defs>
              <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
            </svg>
          </a>
        </li>
        <?php if ($shop['coupon_privacy'] == 1) : ?>
          <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                  if (is_page('coupon')) {
                                                                                                                                    echo "main_nav_active";
                                                                                                                                  } ?>" itemprop="name">
            <a itemprop="url" href="<?= site_url('coupon'); ?>/">
              <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">COUPON</h2>
              <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">クーポン</h3>
              <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                <defs></defs>
                <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
              </svg>
            </a>
          </li>
        <?php endif ?>
        <?php if ($staff_recruit['hosweb_privacy'] == 1) : ?>
          <li class="main-nav__list-item--<?php echo $main_nav_thematype; ?> main_nav_border_color main_nav_text_underline_color <?php wp_reset_query();
                                                                                                                                  if (is_page('staff-recruit')) {
                                                                                                                                    echo "main_nav_active";
                                                                                                                                  } ?>" itemprop="name">
            <a itemprop="url" href="<?php echo $staff_recruit_url; ?>/">
              <h2 class="main-nav__list-title-en--<?php echo $main_nav_thematype; ?> main_nav_text_color main_nav_english_font">RECRUIT</h2>
              <h3 class="main-nav__list-title-jp--<?php echo $main_nav_thematype; ?> main_nav_text_color">求人情報</h3>
              <svg xmlns="https://www.w3.org/2000/svg" width="13.193" height="21.842" viewBox="0 0 13.193 21.842">
                <defs></defs>
                <path class="a" d="M.987,0,0,.883,11.22,10.921,0,20.959l.987.883L13.193,10.921Z" transform="translate(0 0)" />
              </svg>
            </a>
          </li>
        <?php endif ?>
      </ul>
      <ul class="main-nav__address--<?php echo $main_nav_thematype; ?>">
        <li class="main-nav__address-item--<?php echo $main_nav_thematype; ?> main_nav_contact_bg_color main_nav_border_color">
          <a <?php wp_reset_query();
              if (is_page('staff-recruit')) { ?>onclick="return gtag_report_conversion('tel:<?php echo $shop['phone_number']; ?>');" <?php } ?> href="tel:<?php echo $shop['phone_number']; ?>">
            <div class="wrap main_nav_contact_icon_color">
              <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="18.975" height="28.232" viewBox="0 0 18.975 28.232">
                <defs>
                  <clipPath id="a" />
                </defs>
                <g class="a">
                  <path class="b" d="M14.538,9.637c-.548-.914-1.323-2.7-2.193-2.285L10.956,8.74S9.6,10,12.116,11.007c0,0,.623.675-1.313,2.47-1.8,1.936-2.47,1.312-2.47,1.312-1.006-2.512-2.268-1.159-2.268-1.159L4.678,15.018c-.414.871,1.371,1.646,2.284,2.194.849.509,2.527.188,5.067-2.165l.01.014.348-.348-.014-.01c2.353-2.539,2.675-4.218,2.165-5.066M15.5,0H3.471A3.47,3.47,0,0,0,0,3.471V24.76a3.471,3.471,0,0,0,3.471,3.472H15.5a3.471,3.471,0,0,0,3.471-3.472V3.471A3.471,3.471,0,0,0,15.5,0m1.3,20.844a1.884,1.884,0,0,1-1.881,1.881H4.052A1.884,1.884,0,0,1,2.17,20.844V4.427A1.884,1.884,0,0,1,4.052,2.545H14.923A1.884,1.884,0,0,1,16.8,4.427Z" />
                </g>
              </svg>
              <h4 class="main_nav_contact_text_color">電話をかける</h4>
            </div> <!-- /wrap -->
          </a>
        </li>
        <?php
        $map_sql = "SELECT `url` FROM `maps` WHERE `shop_id` = " . $shop_id;
        $map = $pdo->prepare($map_sql);
        $map->execute();
        $map = $map->fetch(PDO::FETCH_ASSOC);
        ?>
        <li class="main-nav__address-item--<?php echo $main_nav_thematype; ?> main_nav_contact_bg_color main_nav_border_color">
          <a target="_blank" href="<?php echo $map['url']; ?>">
            <div class="wrap main_nav_contact_icon_color">
              <svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.155" height="28.232" viewBox="0 0 19.155 28.232">
                <defs>
                  <clipPath id="a">
                    <rect class="a" width="19.155" height="28.232" />
                  </clipPath>
                </defs>
                <g class="b">
                  <path class="a" d="M19.155,9.577A9.577,9.577,0,0,0,0,9.577c0,9.356,9.577,18.654,9.577,18.654s9.577-9.3,9.577-18.654M5.407,8.683a4.166,4.166,0,1,1,4.17,4.163,4.164,4.164,0,0,1-4.17-4.163" transform="translate(0 0)" />
                </g>
              </svg>
              <h4 class="main_nav_contact_text_color">マップを見る</h4>
            </div> <!-- /wrap -->
          </a>
        </li>
        <?php //if ($contact_page_exsitance_flg) : ?>
          <!-- <li class="main-nav__address-item--<?php echo $main_nav_thematype; ?> main_nav_contact_bg_color main_nav_border_color">
            <a href="<?= site_url('contact'); ?>/">
              <div class="wrap main_nav_contact_icon_color">
                <svg id="a" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 361.31 567.7">
                  <path d="m79.67,338.49h201.97v-137.7H79.67v137.7Zm166.6-121.17l-65.63,43.51-65.62-43.51h131.25Zm-150.52,6.91l84.89,56.28,84.91-56.28v97.73H95.75v-97.73ZM295.22,0H66.09C29.6,0,0,29.58,0,66.08v435.52c0,36.51,29.6,66.1,66.09,66.1h229.13c36.49,0,66.09-29.58,66.09-66.1V66.08c0-36.5-29.6-66.08-66.09-66.08Zm24.76,427.04c0,19.75-16.07,35.82-35.82,35.82H77.15c-19.75,0-35.82-16.07-35.82-35.82V84.29c0-19.75,16.07-35.82,35.82-35.82h207c19.75,0,35.82,16.07,35.82,35.82v342.74Z" />
                </svg>
                <h4 class="main_nav_contact_text_color">お問合せ</h4>
              </div>
            </a>
          </li> -->
        <?php //endif ?>
      </ul>
      <ul class="main-nav__sns">
        <?php
        $svg_list = [
          '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="22" height="20" viewBox="0 0 22 20"><defs><clipPath id="a"><rect class="a" width="22" height="20"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="a" d="M14.179,20.037H5.857A5.865,5.865,0,0,1,0,14.179V5.857A5.864,5.864,0,0,1,5.857,0h8.322a5.864,5.864,0,0,1,5.857,5.857v8.322a5.865,5.865,0,0,1-5.857,5.858M5.857,1.868A3.994,3.994,0,0,0,1.868,5.857v8.322a3.993,3.993,0,0,0,3.989,3.989h8.322a3.993,3.993,0,0,0,3.989-3.989V5.857a3.994,3.994,0,0,0-3.989-3.989Zm9.515,1.558a1.249,1.249,0,1,0,1.249,1.249,1.249,1.249,0,0,0-1.249-1.249M10.019,15.2A5.179,5.179,0,1,1,15.2,10.019,5.184,5.184,0,0,1,10.019,15.2m0-8.49a3.311,3.311,0,1,0,3.31,3.312,3.316,3.316,0,0,0-3.31-3.312" transform="translate(0.952 -0.086)"></path></g></svg>',

          '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="19.424" height="13.686" viewBox="0 0 19.424 13.686"><defs><clipPath id="a"></clipPath></defs><g class="a"><path class="b" d="M19.019,2.138A2.44,2.44,0,0,0,17.3.409C15.786,0,9.713,0,9.713,0S3.638,0,2.123.409A2.44,2.44,0,0,0,.405,2.138,25.626,25.626,0,0,0,0,6.843a25.638,25.638,0,0,0,.405,4.706,2.442,2.442,0,0,0,1.718,1.729c1.515.408,7.59.408,7.59.408s6.074,0,7.589-.408a2.442,2.442,0,0,0,1.718-1.729,25.638,25.638,0,0,0,.405-4.706,25.626,25.626,0,0,0-.405-4.705M7.726,9.731V3.955L12.8,6.843Z" transform="translate(0)"></path></g></svg>',

          '<svg class="twitter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="250 250 1500 1500" width="95%"><defs><clipPath id="a" /></defs><g class="a" transform="translate(0 0)"><path class="cls-1" d="M1479.3,1455.9l-375.6-545.7-42.5-61.7-268.7-390.4-22.3-32.4h-330.1l80.5,117,357.3,519.1,42.5,61.6,287.1,417.1,22.3,32.3h330.2l-80.7-116.9ZM1268.9,1498.2l-298.2-433.3-42.5-61.7-346-502.8h148.8l279.9,406.6,42.5,61.7,364.4,529.5h-148.9Z" transform="translate(0 0)" /><polygon class="cls-1" points="928.2 1003.2 970.7 1064.9 920.4 1123.5 534.1 1572.9 438.8 1572.9 877.9 1061.9 928.2 1003.2" /><polygon class="cls-1" points="1520.1 425.8 1103.7 910.2 1053.4 968.7 1010.9 907.1 1061.2 848.5 1343.3 520.2 1424.8 425.8 1520.1 425.8" /></g></svg>',

          '<svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="17.691" height="20.736" viewBox="0 0 17.691 20.736"><defs><style></style><clipPath id="a"><rect class="a" width="17.691" height="20.736"></rect></clipPath></defs><g class="b" transform="translate(0 0)"><path class="c" d="M12.806,0V.017c0,.316.094,4.88,4.883,5.164,0,4.246,0,0,0,3.526a8.39,8.39,0,0,1-4.89-1.73L12.8,13.841c.043,3.108-1.687,6.157-4.927,6.771a7.021,7.021,0,0,1-3.1-.109C-3.13,18.139-.5,6.418,7.431,7.673c0,3.784,0,0,0,3.784-3.278-.482-4.374,2.245-3.5,4.2a2.914,2.914,0,0,0,5.195-.345,6.617,6.617,0,0,0,.194-1.679V0Z" transform="translate(0 0)"></path></g></svg>'
        ];
        if (!empty($shop_sns_list['instagram_account_url'])) {
        ?>
          <!-- kanai-mod-s -->
          <li class="main-nav__sns-item--<?php echo $main_nav_thematype; ?>">
            <a target="_blank" class="main_nav_sns_icon_color" href="<?php echo $shop_sns_list['instagram_account_url']; ?>">
              <?php echo $svg_list[0]; ?>
            </a>
          </li>
        <?php
        }
        if (!empty($shop_sns_list['youtube_account_url'])) {
        ?>
          <li class="main-nav__sns-item--<?php echo $main_nav_thematype; ?>">
            <a target="_blank" class="main_nav_sns_icon_color" href="<?php echo $shop_sns_list['youtube_account_url']; ?>">
              <?php echo $svg_list[1]; ?>
            </a>
          </li>
        <?php
        }
        if (!empty($shop_sns_list['twitter_account_url'])) {
        ?>
          <li class="main-nav__sns-item--<?php echo $main_nav_thematype; ?>">
            <a target="_blank" class="main_nav_sns_icon_color" href="<?php echo $shop_sns_list['twitter_account_url']; ?>">
              <?php echo $svg_list[2]; ?>
            </a>
          </li>
        <?php
        }
        if (!empty($shop_sns_list['tiktok_account_url'])) {
        ?>
          <li class="main-nav__sns-item--<?php echo $main_nav_thematype; ?>">
            <a target="_blank" class="main_nav_sns_icon_color" href="<?php echo $shop_sns_list['tiktok_account_url']; ?>">
              <?php echo $svg_list[3]; ?>
            </a>
          </li>
          <!-- kanai-mod-e -->
        <?php
        }
        ?>
      </ul>
    </div> <!-- /inner -->
  </nav> <!-- /main-nav -->

  <header class="header thema_bg_color header_border_color" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
    <div class="header__inner">
      <!-- PC用ロゴwidth -->
      <div class="header__inner-center logo_width pc">
        <h1>
          <a href="<?= site_url(); ?>/">
            <?php
            switch ($shop['industry_id']) {
              case '1':
                $for_alt_text = 'ホストクラブ';
                break;
              default:
                $for_alt_text = 'ホストクラブ';
                break;
            }
            ?>
            <img src="<?php echo wp_get_attachment_url($logo);  ?>" alt="<?php echo $mono_addressLocality; ?>の<?php echo $for_alt_text; ?>「<?php echo $store_name; ?>」のロゴ" />
          </a>
        </h1>
      </div> <!-- /center -->
      <!-- SP用ロゴwidth -->
      <div class="header__inner-center sp_logo_width sp">
        <h2>
          <a href="<?= site_url(); ?>/">
            <img src="<?php echo wp_get_attachment_url($logo);  ?>" alt="スマホ版<?php echo $store_name; ?>のロゴ" />
          </a>
        </h2>
      </div> <!-- /center -->
      <label for="open" id="sp-menu-btn">
        <span></span>
        <span></span>
        <span></span>
      </label> <!-- /sp-menu-btn -->
    </div> <!-- /inner -->
  </header> <!-- /sp_header -->
