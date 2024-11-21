<?php
global $thema_color;
global $sub_color;
global $title_color;
global $title_font;
global $sub_title_color;
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
global $main_nav_text_underline_color;
global $main_nav_text_color;
global $main_nav_inversion_text_color;
global $main_nav_english_font;
global $main_nav_inversion_color01;
global $main_nav_contact_text_color;
global $main_nav_contact_bg_color;
global $main_nav_sns_icon_color;
global $main_nav_sns_icon_color;
global $button_shape_thema_type;
global $button_color;
global $button_bg_color;
global $button_border_color;
global $sns_icon_color;
global $sns_icon_bg_color;
global $sns_thema_type;
global $sns_link_button_text;
global $shop_photo_thema_type;
global $shop_photo_link_button_text;
global $modal_thema_type;
global $modal_top_block_text_color;
global $modal_top_block_bg_color;
global $modal_sns_icon_color;
global $modal_sns_icon_bg_color;
// top ranking
global $ranking_bg_color;
global $ranking_title_color;
global $ranking_color;
global $ranking_btn_color;
global $ranking_btn_bg_color;
global $ranking_btn_border_color;
global $ranking_No_font;
global $ranking_No1_color;
global $ranking_No2_color;
global $ranking_No3_color;
global $ranking_No4_color;
// top staff
global $staff_bg_color;
global $staff_title_color;
global $staff_color;
global $staff_btn_color;
global $staff_btn_bg_color;
global $staff_btn_border_color;
// top sns
global $sns_bg_color;
global $sns_title_color;
global $sns_btn_color;
global $sns_btn_bg_color;
global $sns_btn_border_color;
// top shop_photo
global $shop_photo_bg_color;
global $shop_photo_title_color;
global $shop_photo_btn_color;
global $shop_photo_btn_bg_color;
global $shop_photo_btn_border_color;
// top about
global $about_bg_color;
global $about_title_color;
global $about_color;


global $staff_thema_type;
global $profile_thema_type;
?>

<style type="text/css">
body {
  font-family: "<?php echo $text_font; ?>";
  color: <?php echo $text_color; ?>;
}
a {
  color: <?php echo $text_color; ?>;
}
.thema_bg_color {
  background-color: <?php echo $thema_color; ?>;
}
.sub_bg_color {
  background-color: <?php echo $sub_color; ?>;
}
.header_border_color {
  border-color: <?php echo $header_border_color; ?>;
}
#sp-menu-btn span {
  background-color: <?php echo $header_menu_line_color; ?>;
}
.drawer_gray_out_bgcolor {
 background-color: <?php echo $sub_color; ?>;
}
.title_style {
  font-family: "<?php echo $title_font; ?>";
  color: <?php echo $title_color ?>;
}
.sub_title_style {
  color: <?php echo $sub_title_color ?>;
}
.text_style {
  color: <?php echo $text_color; ?>;
}
#breadcrumbs ol li:after {
  color: <?php echo $text_color; ?>;
}
.border_color {
  border-color: <?php echo $border_color; ?>;
}
.logo_width {
  width: <?php echo $logo_width; ?>px;
}
.sp_logo_width {
  width: <?php echo $sp_logo_width; ?>px;
}
<?php
$v = str_replace('#', '', $main_nav_bg_color);
$v = str_split($v,2);
$n1 = hexdec($v[0]);
$n2 = hexdec($v[1]);
$n3 = hexdec($v[2]);
?>
.main_nav_bg_color {
  background-color: rgba(<?php echo $n1; ?>, <?php echo $n2; ?>, <?php echo $n3; ?>, 0.85);
}
.main_nav_border_color {
  border-color: <?php echo $main_nav_boder_color; ?>;
}
.main_nav_text_underline_color {
  border-color: <?php echo $main_nav_text_underline_color; ?>;
}
nav.main-nav div ul:first-of-type li a{
  fill: <?php echo $main_nav_text_underline_color; ?>;
}
nav.main-nav div ul li a h2:after {
  background-color: <?php echo $main_nav_text_underline_color; ?>;
}
.main_nav_text_color {
  color: <?php echo $main_nav_text_color; ?>;
}
.main_nav_english_font {
  font-family: "<?php echo $main_nav_english_font; ?>";
}
.main-nav h2::after {
  background-color: <?php echo $main_nav_boder_color; ?>;
}
.main_nav_active {
  background-color: <?php echo $main_nav_inversion_color01; ?>;
  fill: <?php echo $main_nav_inversion_text_color; ?>;
}
.main_nav_active .main_nav_text_color {
  color: <?php echo $main_nav_inversion_text_color; ?>;
}
.main_nav_contact_text_color {
  color: <?php echo $main_nav_contact_text_color; ?>;
}
.main_nav_contact_bg_color {
  background-color: <?php echo $main_nav_contact_bg_color; ?>;
}
.main_nav_contact_icon_color {
  fill: <?php echo $main_nav_contact_text_color; ?>;
}
.main_nav_sns_icon_color {
  fill: <?php echo $main_nav_sns_icon_color; ?>;
}
.button_style {
  color: <?php echo $button_color ?>;
  background-color: <?php echo $button_bg_color; ?>;
  border-color: <?php echo $button_border_color ?>;
}
.tab.detail {
  border-color: <?php echo $button_border_color ?> !important;
}
.tab.detail ul li a,
.schedule_period_style {
  color: <?php echo $button_color ?>;
  background-color: <?php echo $button_bg_color; ?>;
  border-color: <?php echo $button_border_color ?>;
}
.tab.detail ul li a.active,
.schedule_selector_active_style {
  color: <?php echo $button_bg_color; ?> !important;
  background-color: <?php echo $button_color ?> !important;
  border-color: <?php echo $button_border_color ?>;
}

/* ranking */
.ranking {
  background-color: <?= $ranking_bg_color; ?>;
  color: <?= $ranking_color; ?>;
}

.ranking h2,
.ranking h3 {
  color: <?= $ranking_title_color; ?>;
}

#ranking-title,
.ranking p {
  color: <?= $ranking_color; ?>;
}

.ranking h4,
.ranking h4 span {
  font-family: <?=$ranking_No_font; ?>;
  color: <?=$ranking_No4_color; ?>;
}

.rank_content .rank_item:first-of-type h4,
.rank_content .rank_item:first-of-type h4 span {
  color: <?=$ranking_No1_color; ?>;
}

.rank_content .rank_item:nth-of-type(2) h4,
.rank_content .rank_item:nth-of-type(2) h4 span {
  color: <?=$ranking_No2_color; ?>;
}

.rank_content .rank_item:nth-of-type(3) h4,
.rank_content .rank_item:nth-of-type(3) h4 span {
  color: <?=$ranking_No3_color; ?>;
}

.ranking__arcives-link--pop,
.ranking__arcives-link--stylish,
.ranking__arcives-link--luxury,
.tab li a {
  color: <?= $ranking_btn_color; ?>;
  background-color: <?= $ranking_btn_bg_color; ?>;
  border: <?= $ranking_btn_border_color; ?> 1px solid;
}

section.ranking div.ranking__inner div.tab {
  border-color: <?= $ranking_btn_border_color; ?>;
}

section.ranking div.ranking__inner div.tab ul li a.tab-link.active {
  color: <?= $ranking_btn_bg_color; ?>;
  background-color: <?= $ranking_btn_color; ?>;
}

/* staff */
.schedule {
  background-color: <?= $staff_bg_color; ?>;
  color: <?= $staff_color; ?>;
}

.schedule h2,
.schedule h3 {
  color: <?= $staff_title_color; ?>;
}

.schedule__list-item-content--pop,
.schedule__list-item-content--pop2,
.schedule__list-item-content--stylish,
.schedule__list-item-content--luxury {
  color: <?= $staff_color; ?>;
}

.schedule__arcives-link--pop,
.schedule__arcives-link--stylish,
.schedule__arcives-link--luxury {
  color: <?= $staff_btn_color; ?>;
  background-color: <?= $staff_btn_bg_color; ?>;
  border-color: <?= $staff_btn_border_color; ?>;
}

/* sns */
.sns {
  background-color: <?= $sns_bg_color; ?>;
}

.sns h2,
.sns h3 {
  color: <?= $sns_title_color; ?>;
}

.sns__more-button--pop,
.sns__more-button--stylish,
.sns__more-button--luxury {
  color: <?= $sns_btn_color; ?>;
  background-color: <?= $sns_btn_bg_color; ?>;
  border-color: <?= $sns_btn_border_color; ?>;
}

.sns_icon_color {
  fill: <?php echo $sns_icon_color; ?>;
}

.sns_icon_bg_color {
  background-color: <?php echo $sns_icon_bg_color; ?>;
}

.working_hours_style {
  background-color: <?php echo $working_hours_bg_color; ?>;
  color: <?php echo $working_hours_color; ?>;
}

.modal_top_block_text_color {
	color: <?php echo $modal_top_block_text_color; ?>;
}

.modal_top_block_bg_color {
	background-color: <?php echo $modal_top_block_bg_color; ?>;
}

.modal_sns_icon_color {
	fill: <?php echo $modal_sns_icon_color; ?>;
}

.modal_sns_icon_bg_color {
	background-color: <?php echo $modal_sns_icon_bg_color; ?>;
}

<?php if($staff_thema_type == "pop" || $staff_thema_type == "luxury") { ?>
.sns_modal_no_img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}
<?php } ?>

/* shop_photo */
.shop-photo {
  background-color: <?= $shop_photo_bg_color; ?>;
}

.shop-photo h2,
.shop-photo h3 {
  color: <?= $shop_photo_title_color; ?>;
}

.shop-photo__arcives-link--pop,
.shop-photo__arcives-link--stylish,
.shop-photo__arcives-link--luxury {
  color: <?= $shop_photo_btn_color; ?>;
  background-color: <?= $shop_photo_btn_bg_color; ?>;
  border-color: <?= $shop_photo_btn_border_color; ?>;
}

/* contact */
  .contact__inner h2.title_style,
  .contact__inner h3.sub_title_style {
    color: <?= $title_color; ?>;
  }
  
  .contact__inner h2.title_style,
  .contact__inner h3.sub_title_style {
    color: <?= $title_color; ?>;
  }

  .contact__inner {
    color: <?= $text_color; ?>;
  }

  .wpcf7 p label span > * {
    font-family: <?= $text_font; ?>;
  }

  .wpcf7 p button,
  .wpcf7 p input.wpcf7-submit,
  .wpcf7 p input.wpcf7-previous,
  .contact_text a {
    border-color: <?= $button_border_color; ?>;
    background-color: <?= $button_bg_color; ?>;
    color: <?= $button_color; ?>;
    font-family: <?= $text_font; ?>;

    <? if($button_shape_thema_type == "pop") { ?>
      border-radius: 11.5px;
    <? } elseif($button_shape_thema_type == "stylish") { ?>
      border-radius: 23px;
    <? } elseif($button_shape_thema_type == "luxury") { ?>
      border-radius: 0;
    <? } ?>
  }
</style>
