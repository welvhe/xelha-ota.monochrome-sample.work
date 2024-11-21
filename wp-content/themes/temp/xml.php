<?php
require_once dirname(__FILE__) ."/../../../wp-load.php";
echo home_url()."\n";
?>
<?php
date_default_timezone_set("Asia/Tokyo");
//management_system
$DB_host        = 'main-test1-db.cbcxa5lv23yo.ap-northeast-1.rds.amazonaws.com';
$DB_database    = 'management_system';
$DB_user        = 'admin';
$DB_password    = 'XdB2atTzPBAtEZrSssXMWnRTuLaKxtJ5';
// error_reporting(0);
// $DB_host        = '127.0.0.1';
// $DB_database    = 'management_system';
// $DB_user        = 'root';
// $DB_password    = '';
$dsn = "mysql:dbname={$DB_database};host={$DB_host}";
try {
    $pdo = new PDO($dsn,$DB_user,$DB_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // echo "接続に成功しました。<br>";
} catch (PDOException $e) {
    // echo "接続に失敗しました。{$e->getMessage()}<br>";
}

$shop_id = scf::get('店舗ID',34);
$contact_page_exsitance_flg = scf::get('コンタクトページあり',3180);
$casts_count_sql = "SELECT count(id) FROM `casts` WHERE `shop_id` = ".$shop_id." AND `cabaweb_privacy` = 1"
;
$casts_count = $pdo->prepare($casts_count_sql);
$casts_count->execute();
$casts_count = $casts_count->fetch(PDO::FETCH_ASSOC);
$for_count_photos_sql = "SELECT `image_url` FROM `shop_images` WHERE `shop_id` = ".$shop_id." and `images_subject` <> 'TOP' order by `image_number` ASC";
$for_count_photos = $pdo->prepare($for_count_photos_sql);
$for_count_photos->execute();
$for_count_photos = $for_count_photos->fetchAll(PDO::FETCH_ASSOC);
$for_count_photos = count($for_count_photos);
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$xml .= "\n<url>
    <loc>" .  site_url() . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>";
$xml .= "\n<url>
    <loc>" .  site_url('news') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
</url>";
if ($calendar_page_exsitance_flg) {
$xml .= "\n<url>
    <loc>" .  site_url('calendar') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
</url>";
}
if ($casts_count) {
$xml .= "\n<url>
    <loc>" .  site_url('cast') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
</url>";
}
if ($for_count_photos) {
$xml .= "\n<url>
    <loc>" . site_url('shop-photo') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
</url>";
}
$xml .= "\n<url>
    <loc>" . site_url('fee-system') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>";
if ($coupon_page_exsitance_flg) {
$xml .= "\n<url>
    <loc>" . site_url('coupon') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>";
}
$xml .= "\n<url>
    <loc>" . site_url('staff-recruit') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>";
$xml .= "\n<url>
    <loc>" . site_url('privacy') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>";
if ($contact_page_exsitance_flg) {
$xml .= "\n<url>
    <loc>" . site_url('contact') . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>";
}
$site_map_cast_list_sql = "SELECT `id`,`priority` FROM `casts` WHERE `shop_id` = ".$shop_id." AND `cabaweb_privacy` = 1";
$site_map_cast_list = $pdo->prepare($site_map_cast_list_sql);
$site_map_cast_list->execute();
$site_map_cast_list = $site_map_cast_list->fetchALL();
$sort_key_cast_id = array_column($site_map_cast_list, 'id');
$sort_key_priority = array_column($site_map_cast_list, 'priority');
array_multisort(
      $sort_key_cast_id, SORT_ASC, SORT_NUMERIC,
      $sort_key_priority, SORT_ASC, SORT_NUMERIC,
      $site_map_cast_list
);
foreach ($site_map_cast_list as $key => $value) {
$xml .= "\n<url>
    <loc>" . site_url('profile/?') . "/?cast=" . $value['id'] . "</loc>
    <lastmod>" . date("Y-m-d") . "</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>";
} //end_foreach
$xml .= "\n</urlset>";
$fp = fopen(ABSPATH . "wp-content/themes/temp/sitemap.xml", 'w');
fwrite($fp, $xml);
fclose($fp);
?>
