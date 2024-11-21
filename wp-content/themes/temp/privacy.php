<?php
/*
Template Name:privacy
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
<!-- <meta name="robots" content="noINDEX,noFOLLOW"> wordpressの設定でコントロール-->
<link rel="canonical" href="<?= site_url('news');?>/">
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/admin_sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/privacy_pc.css" />
<link rel="stylesheet" media="all" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/privacy_sp.css" />
<link rel="shortcut icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<link rel="apple-touch-icon" href="<?php echo wp_get_attachment_url( $favicon_img ); ?>">
<!-- jquery読込 -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.4.1.min.js"></script>
<!-- og関連 -->
<meta property="og:url" content="<?= site_url('news');?>/" />
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
</head>

<?php get_template_part('common-styles'); ?>

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
      <a itemprop="item" href="<?= site_url('privacy');?>/">
        <span class="text_style" itemprop="name">PRIVACY</span>
      </a>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</div>

<div class="wraper">

  <div class="container">

    <article class="main">

      <section class="privacy">
        <div class="privacy__inner">
          <h2 class="title_style">P R I V A C Y</h2>
          <h3 class="sub_title_style">プライバシポリシー</h3>
          <p>弊社はサービスを利用されるお客様のプライバシーを尊重し、お客様の個人情報を以下の定義に従い、<br class="sp">細心の注意を払い取り扱います。</p>
          <ol>
            <li>
              <h4>第1条（個人情報）</h4>
              <p>「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
            </li>
            <li>
              <h4>第2条（個人情報の収集方法）</h4>
              <p>弊社は，お客様が弊社の提供するサービスを使用する際に氏名，生年月日，住所，電話番号，メールアドレス，LINEアカウント，銀行口座番号，クレジットカード番号，運転免許証番号などの個人情報をお尋ねすることがあります。また，お客様と提携先などとの間でなされたお客様の個人情報を含む取引記録や決済に関する情報を，弊社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。</p>
            </li>
            <li>
              <h4>第3条（個人情報を収集・利用する目的）</h4>
              <p>弊社が個人情報を収集・利用する目的は，以下のとおりです。</p>
              <ol>
                <li>1. 弊社サービスの提供・運営のため</li>
                <li>2. お客様からのお問い合わせに回答するため（本人確認を行うことを含む）</li>
                <li>3. お客様が利用中のサービスの新機能，更新情報，キャンペーン等及び弊社が提供する他のサービスの案内を送付するため</li>
                <li>4. メンテナンス，重要なお知らせなど必要に応じたご連絡のため</li>
                <li>5. 利用規約に違反したお客様や，不正・不当な目的でサービスを利用しようとするお客様の特定をし，ご利用をお断りするため</li>
                <li>6. お客様にご自身の登録情報の閲覧や変更，削除，ご利用状況の閲覧を行っていただくため</li>
                <li>7. 有料サービスにおいて，お客様に利用料金を請求するため</li>
                <li>8. 上記の利用目的に付随する目的</li>
              </ol>
            </li>
            <li>
              <h4>第4条（利用目的の変更）</h4>
              <ol>
                <li>1. 弊社は，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。</li>
                <li>2. 利用目的の変更を行った場合には，変更後の目的について，弊社所定の方法により，お客様に通知するものとします。</li>
              </ol>
            </li>
            <li>
              <h4>第5条（個人情報の第三者提供）</h4>
              <ol>
                <li>
                  <h5>1. 弊社は，次に掲げる場合を除いて，あらかじめお客様の同意を得ることなく，第三者に個人情報を提供することはありません。ただし，個人情報保護法その他の法令で認められる場合を除きます。</h5>
                  <ol>
                    <li>① 人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                    <li>② 公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき</li>
                    <li>③ 国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
                    <li>
                      <h6>④ 予め次の事項を告知あるいは公表し，かつ当社が個人情報保護委員会に届出をしたとき</h6>
                      <ul>
                        <li>a. 利用目的に第三者への提供を含むこと</li>
                        <li>b. 第三者に提供されるデータの項目</li>
                        <li>c. 第三者への提供の手段または方法</li>
                        <li>d. 本人の求めに応じて個人情報の第三者への提供を停止すること</li>
                        <li>e. 本人の求めを受け付ける方法</li>
                      </ul>
                    </li>
                  </ol>
                </li>
                <li>
                  <h5>2. 前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。</h5>
                  <ol>
                    <li>① 弊社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合</li>
                    <li>② 合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
                    <li>③ 個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合</li>
                  </ol>
                </li>
              </ol>
            </li>
            <li>
              <h4>第6条（個人情報の開示）</h4>
              <ol>
                <li>
                  <h5>1. 弊社は，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します</h5>
                  <ol>
                    <li>① 本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合</li>
                    <li>② 弊社の業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
                    <li>③ その他法令に違反することとなる場合</li>
                  </ol>
                </li>
                <li>2. 弊社は，本サービスの提供の停止または中断により，お客様または第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。</li>
              </ol>
            </li>
            <li>
              <h4>第7条（個人情報の訂正および削除）</h4>
              <ol>
                <li>1. お客様は，弊社の保有する自己の個人情報が誤った情報である場合には，弊社が定める手続きにより，弊社に対して個人情報の訂正，追加または削除（以下，「訂正等」といいます。）を請求することができます。</li>
                <li>2. 弊社は，お客様から前項の請求を受けてその請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の訂正等を行うものとします。</li>
                <li>3. 弊社は，前項の規定に基づき訂正等を行った場合，または訂正等を行わない旨の決定をしたときは遅滞なく，これをお客様に通知します。</li>
              </ol>
            </li>
            <li>
              <h4>第8条（個人情報の利用停止等）</h4>
              <ol>
                <li>1. 弊社は，本人から，個人情報が，利用目的の範囲を超えて取り扱われているという理由，または不正の手段により取得されたものであるという理由により，その利用の停止または消去（以下，「利用停止等」といいます。）を求められた場合には，遅滞なく必要な調査を行います</li>
                <li>2. 前項の調査結果に基づき，その請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の利用停止等を行います。</li>
                <li>3. 弊社は，前項の規定に基づき利用停止等を行った場合，または利用停止等を行わない旨の決定をしたときは，遅滞なく，これをお客様に通知します。</li>
                <li>4. 前2項にかかわらず，利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって，お客様の権利利益を保護するために必要なこれに代わるべき措置をとれる場合は，この代替策を講じるものとします。</li>
              </ol>
            </li>
            <li>
              <h4>第9条（プライバシーポリシーの変更）</h4>
              <ol>
                <li>1. 本ポリシーの内容は，法令その他本ポリシーに別段の定めのある事項を除いて，お客様に通知することなく，変更することができるものとします。</li>
                <li>2. 弊社が別途定める場合を除いて，変更後のプライバシーポリシーは，本ウェブサイトに掲載したときから効力を生じるものとします。</li>
              </ol>
            </li>
            <li>
              <h4>第10条（お問い合わせ窓口）</h4>
              <p>本ポリシーに関するお問い合わせは，下記の窓口までお願いいたします。</p>
              <dl>
                <dt>社名：</dt>
                <dd>株式会社MONOCHROME</dd>
              </dl>
              <dl>
                <dt>ホームページ：</dt>
                <dd>https://www.caba-web.com/</dd>
              </dl>
              <dl>
                <dt>Eメールアドレス：</dt>
                <dd>info@caba-web.com</dd>
              </dl>
            </li>
          </ol>

        </div> <!-- /privacy__inner -->
      </section> <!-- /privacy-- -->

  <?php get_footer(); ?>

<script type="application/ld+json">
[
{
"@context": "https://schema.org",
"@type": "WebSite",
"mainEntityOfPage": {
"@type": "WebPage",
"@id": "<?= site_url('privacy');?>/"
},
"inLanguage": "ja",
"author": {
 "@type": "Organization",
 "@id": "<?= site_url();?>/",
 "name": "<?php echo $store_name; ?>",
 "url": "<?= site_url();?>/",
 "image": "<?php echo wp_get_attachment_url( $logo );  ?>"
},
"headline": "プライバシーポリシー",
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
"item":{"name":"NEWS","@id":"<?= site_url('privacy');?>/"}
}
]
}
]
</script>
