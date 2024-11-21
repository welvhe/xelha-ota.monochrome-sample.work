<?php
date_default_timezone_set("Asia/Tokyo");

require("database.php");

// SCF start
// 基本情報
global $favicon_img;
$favicon_img = scf::get('ファビコン画像', 34);

global $ogp_img;
$ogp_img = scf::get('OGP画像', 34);

global $search_consol_tag;
$search_consol_tag = scf::get('サーチコンソールタグ埋め込み', 34);

global $analytics_tag;
$analytics_tag = scf::get('アナリティクスタグ埋め込み', 34);

global $ads_tag;
$ads_tag = scf::get('コンバージョンタグ埋め込み', 34);

global $no_img;
$no_img = scf::get('画像未登録の時の代替え画像', 34);

global $staff_recruit_url;
$use_group_staff_recruit = scf::get('グループ店サイトのスタッフ求人ページ利用', 34);
if ($use_group_staff_recruit == "true") {
    $shop_id = scf::get('店舗ID', 34);
    $shop_query = "SELECT `shop_group_id` FROM `shops` WHERE `id` = :shop_id AND `privacy` = 1";
    $shop_stmt = $pdo->prepare($shop_query);
    $shop_stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
    $shop_stmt->execute();
    $shop_group_id = $shop_stmt->fetchColumn();
    if ($shop_group_id) { 
        $group_query = "SELECT `url` FROM `shop_groups` WHERE `id` = :shop_group_id";
        $group_stmt = $pdo->prepare($group_query);
        $group_stmt->bindParam(':shop_group_id', $shop_group_id, PDO::PARAM_INT);
        $group_stmt->execute();
        $group_url = $group_stmt->fetchColumn();
        if ($group_url) {
            $group_staff_recruit_url = $group_url . "/staff-recruit";
            $staff_recruit_url = str_replace('http://', 'https://', $group_staff_recruit_url);
        } else {
            $staff_recruit_url = site_url('staff-recruit');
        }
    } else {
        $staff_recruit_url = site_url('staff-recruit');
    }
} else {
    $staff_recruit_url = site_url('staff-recruit');
}

global $shop_id;
$shop_id = scf::get('店舗ID', 34);

global $sub_color;
$sub_color = scf::get('基本の背景色', 34);

global $title_color;
$title_color = scf::get('タイトルの文字色', 34);

global $sub_title_color;
$sub_title_color = scf::get('サブタイトルの文字色', 34);

global $title_font;
$title_font = scf::get('タイトルのフォント', 34);

global $text_color;
$text_color = scf::get('基本の文字色', 34);

global $text_font;
$text_font = scf::get('基本のフォント', 34);

global $border_color;
$border_color = scf::get('枠線の色', 34);

global $button_shape_thema_type;
$button_shape_thema_type = scf::get('共通リンクボタン形状のテーマタイプ', 34);

global $button_color;
$button_color = scf::get('ボタンの文字色', 34);

global $button_bg_color;
$button_bg_color = scf::get('ボタンの背景色', 34);

global $button_border_color;
$button_border_color = scf::get('共通リンクボタンの枠線色', 34);

global $change_content;
$change_content = scf::get('コンテンツ切替', 34);

global $sns_icon_color;
$sns_icon_color = scf::get('SNSアイコンの色', 34);

global $sns_icon_bg_color;
$sns_icon_bg_color = scf::get('SNSアイコンの背景色', 34);

global $sns_thema_type;
$sns_thema_type = scf::get('SNSセクションのテーマタイプ', 34);

global $sns_link_button_text;
$sns_link_button_text = scf::get('SNSボタンのテキスト', 34);

// ヘッダー＆メインナビ
global $thema_color;
$thema_color = scf::get('ヘッダー背景色', 34);

global $logo;
$logo = scf::get('ロゴ', 34);

global $logo_width;
$logo_width = scf::get('ロゴの横幅', 34);

global $sp_logo_width;
$sp_logo_width = ($logo_width * 0.664);

$slider_button_bg = scf::get('スライダーボタン背景', 34);
$slider_button_color = scf::get('スライダーボタン文字色', 34);

global $header_menu_line_color;
$header_menu_line_color = scf::get('メニュー三本ラインの色', 34);

global $header_border_color;
$header_border_color = scf::get('ヘッダー枠線の色', 34);

global $main_nav_thematype;
$main_nav_thematype = scf::get('メインナビのテーマタイプ', 34);

global $main_nav_bg_color;
$main_nav_bg_color = scf::get('メインナビの背景色', 34);

global $main_nav_boder_color;
$main_nav_boder_color = scf::get('メインナビの枠線色', 34);

global $main_nav_text_underline_color;
$main_nav_text_underline_color = scf::get('メインナビの各ページリンクの下線の色', 34);

global $main_nav_text_color;
$main_nav_text_color = scf::get('メインナビの文字色', 34);

global $main_nav_inversion_text_color;
$main_nav_inversion_text_color = scf::get('メインナビのページリンク反転文字色', 34);

global $main_nav_english_font;
$main_nav_english_font = scf::get('メインナビリストの英字フォント', 34);

global $main_nav_inversion_color01;
$main_nav_inversion_color01 = scf::get('メインナビのページリンク背景反転色', 34);

global $main_nav_contact_text_color;
$main_nav_contact_text_color = scf::get('メインナビのお問い合わせ文字色', 34);

global $main_nav_contact_bg_color;
$main_nav_contact_bg_color = scf::get('メインナビのお問い合わせ背景色', 34);

global $main_nav_sns_icon_color;
$main_nav_sns_icon_color = scf::get('メインナビのSNSアイコン色', 34);

// ランキング
global $ranking_bg_color;
$ranking_bg_color = scf::get('ランキング背景色');

global $ranking_title_color;
$ranking_title_color = scf::get('ランキングタイトル文字色');

global $ranking_color;
$ranking_color = scf::get('ランキング基本文字色');

global $ranking_btn_color;
$ranking_btn_color = scf::get('ランキングボタンの文字色', 34);

global $ranking_btn_bg_color;
$ranking_btn_bg_color = scf::get('ランキングボタンの背景色', 34);

global $ranking_btn_border_color;
$ranking_btn_border_color = scf::get('ランキングボタンの枠線色', 34);

global $ranking_No_font;
$ranking_No_font = scf::get('ナンバーのフォント', 34);

global $ranking_No1_color;
$ranking_No1_color = scf::get('No.1の文字色', 34);

global $ranking_No2_color;
$ranking_No2_color = scf::get('No.2の文字色', 34);

global $ranking_No3_color;
$ranking_No3_color = scf::get('No.3の文字色', 34);

global $ranking_No4_color;
$ranking_No4_color = scf::get('No.4以降の文字色', 34);

global $before_btn;
$before_btn = scf::get('ランキングボタン切替', 34);

global $after_btn;
$after_btn = scf::get('ランキング全表示後のボタン', 34);

// スタッフ
global $staff_bg_color;
$staff_bg_color = scf::get('スタッフ背景色');

global $staff_title_color;
$staff_title_color = scf::get('スタッフタイトル文字色');

global $staff_color;
$staff_color = scf::get('スタッフ基本文字色');

global $staff_btn_color;
$staff_btn_color = scf::get('スタッフボタンの文字色');

global $staff_btn_bg_color;
$staff_btn_bg_color = scf::get('スタッフボタンの背景色');

global $staff_btn_border_color;
$staff_btn_border_color = scf::get('スタッフボタンの枠線色');

// SNS
global $sns_bg_color;
$sns_bg_color = scf::get('SNS背景色');

global $sns_title_color;
$sns_title_color = scf::get('SNSタイトル文字色');

global $sns_btn_color;
$sns_btn_color = scf::get('SNSボタンの文字色');

global $sns_btn_bg_color;
$sns_btn_bg_color = scf::get('SNSボタンの背景色');

global $sns_btn_border_color;
$sns_btn_border_color = scf::get('SNSボタンの枠線色');

// 店内写真
global $shop_photo_bg_color;
$shop_photo_bg_color = scf::get('店内写真背景色');

global $shop_photo_title_color;
$shop_photo_title_color = scf::get('店内写真タイトル文字色');

global $shop_photo_btn_color;
$shop_photo_btn_color = scf::get('店内写真ボタンの文字色');

global $shop_photo_btn_bg_color;
$shop_photo_btn_bg_color = scf::get('店内写真ボタンの背景色');

global $shop_photo_btn_border_color;
$shop_photo_btn_border_color = scf::get('店内写真ボタンの枠線色');

global $shop_photo_thema_type;
$shop_photo_thema_type = scf::get('店内写真のテーマタイプ', 34);

global $shop_photo_link_button_text;
$shop_photo_link_button_text = scf::get('店内写真ボタンのテキスト', 34);

// マップ
$map_iframe_sql = "SELECT `embed_html` FROM `maps` WHERE `shop_id` = :shop_id";
$map_iframe = $pdo->prepare($map_iframe_sql);
$map_iframe->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$map_iframe->execute();
$map_iframe = $map_iframe->fetch(PDO::FETCH_ASSOC);

// フッター
global $footer_thema_type;
$footer_thema_type = scf::get('フッターのテーマタイプ', 34);

global $footer_bg_color;
$footer_bg_color = scf::get('フッターの背景色', 34);

global $footer_logo;
$footer_logo = scf::get('フッターロゴ', 34);

global $footer_logo_width;
$footer_logo_width = scf::get('フッターロゴの横幅', 34);

global $sp_footer_logo_width;
$sp_footer_logo_width = scf::get('スマホ版フッターロゴの横幅', 34);

global $footer_text_color;
$footer_text_color = scf::get('フッターの文字色', 34);

global $footer_nav_border_color;
$footer_nav_border_color = scf::get('フッターの枠線色', 34);

global $footer_tel_icon_color;
$footer_tel_icon_color = scf::get('フッターTELアイコンの色', 34);

global $footer_tel_icon_bg_color;
$footer_tel_icon_bg_color = scf::get('フッターTELアイコンの背景色', 34);

global $tel_font;
$tel_font = scf::get('フッター電話番号のフォント', 34);

global $footer_sns_icon_color;
$footer_sns_icon_color = scf::get('フッターSNSアイコンの色', 34);

global $footer_sns_icon_bg_color;
$footer_sns_icon_bg_color = scf::get('フッターSNSアイコンの背景色', 34);

global $group_display;
$group_display = scf::get('フッターグループの表示', 34);

global $group_width;
$group_width = scf::get('フッターグループ全体の横幅', 34);

global $group_width_sp;
$group_width_sp = scf::get('フッターグループ全体の横幅（SP用）', 34);

global $group_ten_mother_logo;
$group_ten_mother_logo = scf::get('グループ店母体のロゴ', 34);

global $group_ten_mother_text;
$group_ten_mother_text = scf::get('グループ店母体のテキスト', 34);

global $group_ten_mother_url;
$group_ten_mother_url = scf::get('グループ店母体のURL', 34);
$group_ten_mother_url = str_replace('http://', 'https://', $group_ten_mother_url);

global $group_sister_store;
$group_sister_store = SCF::get('グループ姉妹店のロゴグループ', 34);

global $group_sister_store_text;
$group_sister_store_text = SCF::get('グループ姉妹店のテキストグループ', 34);

global $group_sister_store_column_count;
$group_sister_store_column_count = SCF::get('PC版グループ店のレイアウトカラム数', 34);

global $sp_group_sister_store_column_count;
$sp_group_sister_store_column_count = SCF::get('スマホ版グループ店のレイアウトカラム数', 34);

global $group_sister_store_column_int;
$group_sister_store_column_int = (110 * $group_sister_store_column_count);

global $sp_group_sister_store_column_int;
$sp_group_sister_store_column_int = (86.5 * $sp_group_sister_store_column_count);

// page top
global $page_top_button_color;
$page_top_button_color = scf::get('ページトップボタンの色', 34);

global $page_top_button_bg_color;
$page_top_button_bg_color = scf::get('ページトップボタンの背景色', 34);

// modal
global $modal_thema_type;
$modal_thema_type = scf::get('モーダルのテーマタイプ', 34);

global $modal_top_block_text_color;
$modal_top_block_text_color = scf::get('モーダル上部の文字色', 34);

global $modal_top_block_bg_color;
$modal_top_block_bg_color = scf::get('モーダル上部の背景色', 34);

global $modal_sns_icon_color;
$modal_sns_icon_color = scf::get('モーダルSNSアイコンの色', 34);

global $modal_sns_icon_bg_color;
$modal_sns_icon_bg_color = scf::get('モーダルSNSアイコンの背景色', 34);

// staff page
global $staff_thema_type;
$staff_thema_type = scf::get('STAFFページのテーマタイプ',364);

// profile page
global $profile_thema_type;
$profile_thema_type = scf::get('PROFILEページのテーマタイプ');

// recruit page
global $mono_datePosted;
$mono_datePosted = date("Y-m-01");

global $mono_validThrough;
$mono_validThrough = date('Y-m-d', strtotime('last day of this month'));

// SCF end

$shop_id = scf::get('店舗ID', 34);
$staffs_count_sql = "SELECT count(id) FROM `staffs` WHERE `shop_id` = " . $shop_id . " AND `hosweb_privacy` = 1";
$staffs_count = $pdo->prepare($staffs_count_sql);
$staffs_count->execute();
$staffs_count = $staffs_count->fetch(PDO::FETCH_ASSOC);

$shop_sql = "SELECT * FROM shops WHERE id = " . $shop_id;
$shop = $pdo->prepare($shop_sql);
$shop->execute();
$shop = $shop->fetch(PDO::FETCH_ASSOC);

$staff_recruit_sql = "SELECT * FROM staff_recruits WHERE `subject_id` = " . $shop_id . " AND `subject_name` = 'shop'";
$staff_recruit = $pdo->prepare($staff_recruit_sql);
$staff_recruit->execute();
$staff_recruit = $staff_recruit->fetch(PDO::FETCH_ASSOC);

$for_count_photos_sql = "SELECT `image_url` FROM `shop_images` WHERE `shop_id` = " . $shop_id . " and `images_subject` <> 'TOP' order by `image_number` ASC";
$for_count_photos = $pdo->prepare($for_count_photos_sql);
$for_count_photos->execute();
$for_count_photos = $for_count_photos->fetchAll(PDO::FETCH_ASSOC);
$for_count_photos = count($for_count_photos);

$shop_sns_sql = "SELECT `instagram_account_url`,`youtube_account_url`,`twitter_account_url`,`tiktok_account_url` FROM `sns` WHERE `subject_id` = " . $shop_id . " and `subject_name` = 'shop' and `main_sns_set` = 1";
$shop_sns_list = $pdo->prepare($shop_sns_sql);
$shop_sns_list->execute();
$shop_sns_list = $shop_sns_list->fetch(PDO::FETCH_ASSOC);

$shop_google_map_sql = "SELECT `work_location_googlemap` FROM `staff_recruits` WHERE `subject_id` = " . $shop_id . " and `hosweb_privacy` = 1";
$shop_google_map = $pdo->prepare($shop_google_map_sql);
$shop_google_map->execute();
$shop_google_map = $shop_google_map->fetch(PDO::FETCH_ASSOC);

// schema.org用
global $store_name;
$store_name = $shop['name'];
global $mono_international_tel;
$mono_international_tel = substr_replace($shop['phone_number'], '+81', 0, 1);
global $mono_sns01;
$mono_sns01 = "";
if (!empty($shop_sns_list['instagram_account_url'])) {
    $mono_sns01 = $shop_sns_list['instagram_account_url'] = str_replace('http://', 'https://', $shop_sns_list['instagram_account_url']);
}
global $mono_sns02;
$mono_sns02 = "";
if (!empty($shop_sns_list['youtube_account_url'])) {
    $mono_sns02 = $shop_sns_list['youtube_account_url'] = str_replace('http://', 'https://', $shop_sns_list['youtube_account_url']);
}
global $mono_sns03;
$mono_sns03 = "";
if (!empty($shop_sns_list['twitter_account_url'])) {
    $mono_sns03 = $shop_sns_list['twitter_account_url'] = str_replace('http://', 'https://', $shop_sns_list['twitter_account_url']);
}
global $mono_sns04;
$mono_sns04 = "";
if (!empty($shop_sns_list['tiktok_account_url'])) {
    $mono_sns04 = $shop_sns_list['tiktok_account_url'] = str_replace('http://', 'https://', $shop_sns_list['tiktok_account_url']);
}
global $mono_sns05;
$mono_sns05 = "";
global $mono_priceRange;
$mono_priceRange = "￥4,000～￥10,000,000";
global $address_array;
$address_full_string = '';
$address_full_string = $shop['shop_address'];
if ($address_full_string) {
    $address_array = separate_address($address_full_string);
}
global $mono_streetAddress;
$mono_streetAddress = $address_array['other'];
global $mono_addressLocality;
$mono_addressLocality = $address_array['city'];
global $mono_addressRegion;
$mono_addressRegion = $address_array['state'];
global $mono_postalCode;
$mono_postalCode = $shop['shop_postcode'];
global $mono_staff_hasMap;
$mono_staff_hasMap = $shop_google_map['work_location_googlemap'];
global $mono_openingHours;
$mono_openingHours = "Mo-Fr 14:00-23:00";
global $mono_latitude;
if ($shop_google_map['work_location_googlemap']) {
    $googlemap_full_string = $shop_google_map['work_location_googlemap'];
    $start = mb_strpos($googlemap_full_string, '@') + 1;
    $end = mb_strpos($googlemap_full_string, ',');
    $mono_latitude = mb_substr($googlemap_full_string, $start, $end - $start);
    global $mono_longitude;
    $start = mb_strpos($googlemap_full_string, ',') + 1;
    $end = mb_strpos($googlemap_full_string, ',', strpos($googlemap_full_string, ',') + 1);
    $mono_longitude = mb_substr($googlemap_full_string, $start, $end - $start);
}
