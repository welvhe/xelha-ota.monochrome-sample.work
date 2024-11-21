<?php
add_theme_support( 'post-thumbnails' );
add_filter('wp_calculate_image_srcset_meta', '__return_null');
//画像アップロード時サムネイルを作らない
function not_create_image($sizes){
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['medium_large']);
    unset($sizes['large']);
    unset($sizes['post-thumbnail']);# 1200x800
    unset($sizes['1536x1536']);
    unset($sizes['twentytwenty-fullscreen']);# 1980x1320
    unset($sizes['2048x2048']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'not_create_image');
add_image_size( 'custom',250, 250, array( 'center', 'center')  );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles',     'print_emoji_styles' );
remove_action( 'admin_print_styles',  'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action('wp_head','rest_output_link_wp_head');
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
add_filter( 'emoji_svg_url', '__return_false' );
add_action( 'wp_enqueue_scripts', 'remove_my_global_styles' );
function remove_my_global_styles() {
    wp_dequeue_style( 'global-styles' );
}
add_action('wp', function(){
    // if(is_home() || is_front_page()) return;
    remove_action('wp_head','wp_oembed_add_discovery_links');
    remove_action('wp_head','wp_oembed_add_host_js');
    function my_deregister_scripts(){
        wp_deregister_script( 'wp-embed' );
    }
    add_action( 'wp_footer', 'my_deregister_scripts' );
});
add_action('wp', function(){
    if(is_page('contact')) return;
    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');
});
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );
// 編集者に設定メニューを追加
// function add_theme_caps(){
//     $role = get_role( 'editor' );
//     $role->remove_cap( 'manage_options' );
// }
// add_action( 'admin_init', 'add_theme_caps' );
// icoを許可
function add_mimes($mimes) {
  $mimes['ico']  = 'image/vnd.microsoft.icon';
  return $mimes;
}
add_filter('upload_mimes','add_mimes');

function get_text($target) {
    $result = preg_split("/\s/",$target);
    return $result;
}
function getParamVal($param) {
    $val = (isset($_GET[$param]) && $_GET[$param] != '') ? $_GET[$param] : '';
    $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    return $val;
}
// shema.orgの所在地項目の自動化
function separate_address(string $address)
{
    if (preg_match('@^(.{2,3}?[都道府県])(.+?郡.+?[町村]|.+?市.+?区|.+?[市区町村])(.+)@u', $address, $matches) !== 1) {
        return [
            'state' => null,
            'city' => null,
            'other' => null
        ];
    }
    return [
        'state' => $matches[1],
        'city' => $matches[2],
        'other' => $matches[3],
    ];
}

require("database.php");

// アクセスランキング
function track_access_to_staff() {
    global $pdo;

    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    if (isset($_GET['staff']) && is_numeric($_GET['staff'])) {
        $staff_id = intval($_GET['staff']);
        $url_from = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL;
        $client_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : NULL;
        $device = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
        $shop_id = scf::get('店舗ID', 34);

        try {
            // 同じip/device/staff_idで、当日のレコードがあるか確認
            $sql_check = "SELECT COUNT(*) FROM access WHERE ip = :ip AND device = :device AND staff_id = :staff_id AND DATE(created_at) = CURDATE()";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':ip', $client_ip, PDO::PARAM_STR);
            $stmt_check->bindParam(':device', $device, PDO::PARAM_STR);
            $stmt_check->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);
            $stmt_check->execute();
            $record_exists = $stmt_check->fetchColumn();

            if ($record_exists > 0) {
                // echo "このスタッフには本日既にアクセスが記録されています。<br>";
                return;
            }

            $sql_insert = "INSERT INTO access (url_from, url_to, shop_id, staff_id, ip, device, created_at, updated_at) VALUES (:url_from, :url_to, :shop_id, :staff_id, :ip, :device, NOW(), NOW())";

            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->bindParam(':url_from', $url_from, PDO::PARAM_STR);
            $stmt_insert->bindParam(':url_to', $current_url, PDO::PARAM_STR);
            $stmt_insert->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
            $stmt_insert->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);
            $stmt_insert->bindParam(':ip', $client_ip, PDO::PARAM_STR);
            $stmt_insert->bindParam(':device', $device, PDO::PARAM_STR);
            $stmt_insert->execute();

            // echo "アクセス情報を登録しました。<br>";

        } catch (PDOException $e) {
            // echo "アクセス情報の登録に失敗しました: " . $e->getMessage() . "<br>";
        }
    }
}

// contact
function enqueue_cf7_scripts() {
  if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
    wpcf7_enqueue_scripts();
  }
  if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
    wpcf7_enqueue_styles();
  }
}
add_action( 'wp_enqueue_scripts', 'enqueue_cf7_scripts' );
