<?php
/*
Template Name:fee-system
*/ query_posts('post');
require("setting.php");

$charge_systems_sql = "SELECT * FROM `charge_systems` WHERE `shop_id` = " . $shop_id;
$charge_systems = $pdo->prepare($charge_systems_sql);
$charge_systems->execute();
$charge_systems = $charge_systems->fetchALL(PDO::FETCH_ASSOC);
$sort_key_priority = array_column($charge_systems, 'priority');
array_multisort(
	$sort_key_priority,
	SORT_ASC,
	SORT_NUMERIC,
	$charge_systems
);

$cautions_sql = "SELECT * FROM `cautions` WHERE `subject_id` = :shop_id AND `subject_name` = 'shop'";
$cautions = $pdo->prepare($cautions_sql);
$cautions->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$cautions->execute();
$caution = $cautions->fetch(PDO::FETCH_ASSOC);

$free_drinks_sql    = "SELECT * FROM `free_drinks` WHERE `shop_id` = " . $shop_id;
$free_drinks    = $pdo->prepare($free_drinks_sql);
$free_drinks->execute();
$free_drink = $free_drinks->fetch(PDO::FETCH_ASSOC);

$payment_methods_sql = "SELECT `visa`,`mastar`,`amex`,`jcb`,`diners`,`union_pay`,`paypay`,`r_pay`,`line_pay`,`mer_pay`,`d_pay`,`i_d`,`quic_pay`,`rakuten_edy`,`au_pay` FROM `payment_methods` WHERE `shop_id` = " . $shop_id;
$payment_methods = $pdo->prepare($payment_methods_sql);
$payment_methods->execute();
$payment_method = $payment_methods->fetch(PDO::FETCH_ASSOC);
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
	<link rel="canonical" href="<?= site_url('fee-system'); ?>/">
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/fee-system_pc.css" />
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/fee-system_sp.css" />
	<link rel="icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
	<link rel="shortcut icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
	<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url($favicon_img); ?>">
	<!-- jquery読込 -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
	<!-- og関連 -->
	<meta property="og:url" content="<?= site_url('fee-system'); ?>/" />
	<meta property="og:type" content="website" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $page_title; ?>" />
	<meta property="og:description" content="<?php echo $page_description; ?>" />
	<meta property="og:site_name" content="<?php echo $store_name; ?>のWebサイト" />
	<meta property="og:image" content="<?php echo wp_get_attachment_url($ogp_img); ?>" />
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
// 料金システムページカスタムフィールドセット
$fee_system_thema_type = scf::get('料金システムのテーマタイプ');
$fee_system_table_list_title_color = scf::get('料金システムテーブルリストのタイトルの文字色');
$fee_system_table_list_bg_color = scf::get('料金システムテーブルリストのタイトルの背景色');
$fee_system_table_list_border_color = scf::get('料金システムテーブルリストの枠線色');
$fee_system_table_list_th_text_color = scf::get('料金システムテーブルリストのTHの文字色');
$fee_system_table_list_th_bg_color = scf::get('料金システムテーブルリストのTHの背景色');
$fee_system_table_list_td_text_color = scf::get('料金システムテーブルリストのTDの文字色');
$fee_system_supplementary_table_list_border_color = scf::get('料金システム付帯情報テーブルリストの枠線色');
?>

<?php get_template_part('common-styles'); ?>

<style type="text/css">
	.fee_system_table_list_title_style {
		color: <?php echo $fee_system_table_list_title_color; ?>;
		background-color: <?php echo $fee_system_table_list_bg_color; ?>;
		border-color: <?php echo $fee_system_table_list_border_color; ?>;
	}

	.fee_system_table_list_border_color {
		border-color: <?php echo $fee_system_table_list_border_color; ?>;
	}

	.fee_system_supplementary_table_list_border_color {
		border-color: <?php echo $fee_system_supplementary_table_list_border_color; ?>;
	}

	.fee_system_table_list_th_style {
		color: <?php echo $fee_system_table_list_th_text_color; ?>;
		background-color: <?php echo $fee_system_table_list_th_bg_color; ?>;
	}

	.fee_system_table_list_td_style {
		color: <?php echo $fee_system_table_list_td_text_color; ?>;
	}
</style>

<?php get_header(); ?>

<div id="breadcrumbs">
	<ol itemscope itemtype="https://schema.org/BreadcrumbList">
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
			<a itemprop="item" href="<?= site_url(); ?>/">
				<span class="text_style" itemprop="name">TOP</span></a>
			<meta itemprop="position" content="1" />
		</li>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
			<a itemprop="item" href="<?= site_url('fee-system'); ?>/">
				<span class="text_style" itemprop="name">FEE-SYSTEM</span>
			</a>
			<meta itemprop="position" content="2" />
		</li>
	</ol>
</div>

<div class="wraper">

	<div class="container">

		<article class="main">

			<section class="fee_system">
				<div class="fee_system__inner--<?php echo $fee_system_thema_type ?>">
					<h2 class="title_style">S Y S T E M</h2>
					<h3 class="sub_title_style">料金システム</h3>
					<?php
					foreach ($charge_systems as $charge_system) {
					?>
						<table class="basic_fee_table fee_system_table_list_border_color">
							<thead>
								<tr class="fee_system_table_list_border_color">
									<th class="fee_system_table_list_title_style fee_system_table_list_border_color" colspan="2"><?php echo nl2br($charge_system['category_name']); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								for ($i = 0; $i < 15; $i++) {
									if ($charge_system['service_name_' . $i] != "" or $charge_system['service_name_' . $i] != NULL) {
								?>
										<tr class="fee_system_table_list_border_color">
											<th class="fee_system_table_list_border_color fee_system_table_list_th_style fee_system_table_list_border_color"><?php echo nl2br($charge_system['service_name_' . $i]); ?></th>
											<td class="fee_system_table_list_border_color fee_system_table_list_td_style"><?php echo nl2br($charge_system['service_value_' . $i]); ?></td>
										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
						<?php if ($charge_system['free_text']) : ?>
							<p class=" fee_system_table_list_td_stylshowe">
								<?php echo nl2br($charge_system['free_text']); ?>
							</p>
						<?php endif ?>

					<?php
					}
					?>
					<?php
					$drinks = [
						$free_drink['shouchu'],
						$free_drink['whisky'],
						$free_drink['brandy'],
						$free_drink['beer'],
						$free_drink['highball'],
						$free_drink['wine'],
						$free_drink['cocktails'],
						$free_drink['softdrink'],
						$free_drink['other_drinks'],
					];

					$cards = [
						$payment_method['visa'],
						$payment_method['mastar'],
						$payment_method['amex'],

						$payment_method['jcb'],
						$payment_method['diners'],
						$payment_method['union_pay'],

						$payment_method['paypay'],
						$payment_method['r_pay'],
						$payment_method['line_pay'],

						$payment_method['mer_pay'],
						$payment_method['d_pay'],
						$payment_method['i_d'],

						$payment_method['quic_pay'],
						$payment_method['rakuten_edy'],
						$payment_method['au_pay'],
					];

					$drinksEmpty = true;
					foreach ($drinks as $drink) {
						if ($drink == 1) {
							$drinksEmpty = false;
							break;
						}
					}

					$cardsEmpty = true;
					foreach ($cards as $card) {
						if ($card == 1) {
							$cardsEmpty = false;
							break;
						}
					}

					if (!$drinksEmpty || !$cardsEmpty || $free_drink['other'] != null) {
					?>
						<table id="related_information_table" class="fee_system_supplementary_table_list_border_color">
							<?php if (!$drinksEmpty || $free_drink['other'] != null) { ?>
								<tr class="fee_system_supplementary_table_list_border_color">
									<th class="fee_system_supplementary_table_list_border_color fee_system_table_list_th_style">Free Drink</th>
									<td class="fee_system_supplementary_table_list_border_color fee_system_table_list_td_style">
										<ul>
											<?php
											$list = [
												'焼酎',
												'ウイスキー',
												'ブランデー',
												'生ビール',
												'ハイボール',
												'ワイン',
												'カクテル類',
												'ソフトドリンク',
												'その他',
											];

											if ($drinks[0] == 1) {
											?>
												<li><?php echo $list[0]; ?></li>
												<?php
											}

											for ($i = 1; $i < 9; $i++) {
												if ($drinks[$i] == 1) {
												?>
													<li>・<?php echo $list[$i]; ?></li>
												<?php
												}
											}

											if ($free_drink['other']) {
												?>
												<br>
												<li><?= $free_drink['other']; ?></li>
											<?php
											}
											?>
										</ul>
									</td>
								</tr>
							<?php } ?>

							<?php if (!$cardsEmpty) { ?>
								<tr class="fee_system_supplementary_table_list_border_color">
									<th class="fee_system_supplementary_table_list_border_color fee_system_table_list_th_style">ご利用可能な<br />クレジットカード<br />or 電子マネー</th>
									<td class="fee_system_supplementary_table_list_border_color" class="fee_system_supplementary_table_list_border_color">
										<ul>
											<?php
											$list = [
												'/img/fee-system/visa-card.png',
												'/img/fee-system/master-card.png',
												'/img/fee-system/amex-card.png',

												'/img/fee-system/jcb-card.png',
												'/img/fee-system/diners-club.png',
												'/img/fee-system/union-card.png',

												'/img/fee-system/pay-pay.png',
												'/img/fee-system/rakuten-pay.png',
												'/img/fee-system/line-pay.png',

												'/img/fee-system/mer-pay.png',
												'/img/fee-system/d-pay.png',
												'/img/fee-system/id.png',

												'/img/fee-system/quic-pay.png',
												'/img/fee-system/rakuten-edy.png',
												'/img/fee-system/au-card.png'
											];

											$for_alt_arrey = [
												'VISAカード',
												'Mastercard',
												'アメリカン・エキスプレスカード',

												'JCBカード',
												'ダイナースクラブカード',
												'ユニカード',

												'PayPay',
												'楽天ペイ',
												'LINE_Pay',

												'メルペイ',
												'd払い',
												'電子マネー「iD]',

												'QUICPay',
												'楽天Edy',
												'au_PAY'
											];

											for ($i = 0; $i < 15; $i++) {
												if ($cards[$i] == 1) {
											?>
													<li><img src="<?php echo get_template_directory_uri() . $list[$i]; ?>" alt="<?php echo $for_alt_arrey[$i]; ?>のアイコン" /></li>
											<?php
												}
											}
											?>
										</ul>
									</td>
								</tr>
							<?php
							}
							?>
						</table>
					<?php
					}
					?>
					<p class=" fee_system_table_list_td_style">
						<?= nl2br($caution['free_text']); ?>
					</p>
				</div> <!-- /inner -->
	</div> <!-- /fee_system -->

	<?php get_footer(); ?>

	<script type="application/ld+json">
		[{
				"@context": "https://schema.org",
				"@type": "WebSite",
				"mainEntityOfPage": {
					"@type": "WebPage",
					"@id": "<?= site_url('fee-system'); ?>/"
				},
				"inLanguage": "ja",
				"author": {
					"@type": "Organization",
					"@id": "<?= site_url(); ?>/",
					"name": "<?php echo $store_name; ?>",
					"url": "<?= site_url(); ?>/",
					"image": "<?php echo wp_get_attachment_url($logo);  ?>"
				},
				"headline": "料金システム",
				"description": "<?php echo $page_description; ?>"
			},
			{
				"@context": "https://schema.org",
				"@type": "Organization",
				"name": "<?php echo $store_name; ?>",
				"url": "<?= site_url(); ?>/",
				"logo": "<?php echo wp_get_attachment_url($logo);  ?>",
				"contactPoint": [{
					"@type": "ContactPoint",
					"telephone": "<?php echo $mono_international_tel; ?>",
					"contactType": "customer support"
				}],
				//snsのURL出力
				"sameAs": [
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
				"image": "<?php echo wp_get_attachment_url($logo);  ?>",
				"url": "<?= site_url(); ?>/",
				"priceRange": "<?php echo $mono_priceRange; ?>",
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
				"@context": "https://schema.org",
				"@type": "BreadcrumbList",
				"name": "パンくずリスト",
				"itemListElement": [{
						"@type": "ListItem",
						"position": 1,
						"item": {
							"name": "TOP",
							"@id": "<?= site_url(); ?>/"
						}
					},
					{
						"@type": "ListItem",
						"position": 2,
						"item": {
							"name": "FEE-SYSTEM",
							"@id": "<?= site_url('fee-system'); ?>/"
						}
					}
				]
			}
		]
	</script>
