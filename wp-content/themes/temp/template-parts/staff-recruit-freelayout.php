<?php
$freelayout = SCF::get('freelayout');
foreach ($freelayout as $fields) {
	$img = wp_get_attachment_image_src($fields['フリーレイアウト画像'], 'full');
	$img_link_url = esc_attr($fields['フリーレイアウト画像リンクURL']);
	$img_order = esc_attr($fields['画像の並び順']);
	$main_title_element =esc_attr($fields['メインタイトル段落']);
	$sub_title_element =esc_attr($fields['サブタイトル段落']);
	$text_element =esc_attr($fields['テキスト段落']);
	$bg_color = esc_attr($fields['フリー求人の背景色']);
	$section_bg_color = !empty($bg_color) ? "style=\"background-color: $bg_color;\"" : '';
	$text_decoration = esc_attr($fields['テキストの装飾']);
	$text_decoration_color = esc_attr($fields['テキストの装飾の色']);
	$text_bg_color = esc_attr($fields['テキストの装飾の背景色']);

	$main_title_font_color = esc_attr($fields['メインタイトルの文字色']);
	$staff_recruit_main_title_size = esc_attr($fields['メインタイトルの文字サイズ']);
	$main_title_class = esc_attr($fields['メインタイトルのフォント']);

	$sub_title_font_color = esc_attr($fields['サブタイトルの文字色']);
	$staff_recruit_sub_title_size = esc_attr($fields['サブタイトルの文字サイズ']);
	$sub_title_class = esc_attr($fields['サブタイトルのフォント']);

	$text_font_color = esc_attr($fields['テキストの文字色']);
	$staff_recruit_text_size = esc_attr($fields['テキストの文字サイズ']);
	$text_class = esc_attr($fields['テキストのフォント']);

	if($img || $fields['メインタイトル'] || $fields['サブタイトル'] || $fields['テキスト']) {
?>

	<section class="cont00 set <?php echo $img_order ?>" <?php echo $section_bg_color; ?>>
		<?php if($img_link_url) { ?>
			<a href="<?= $img_link_url; ?>" target="_blank">
		<?php } ?>
				<img src="<?php echo $img[0]; ?>" class="">
		<?php if($img_link_url) { ?>
			</a>
		<?php } ?>

		<?php if($fields['メインタイトル']) { ?>
			<h2 class="main_title <?php echo $main_title_class ?> <?php echo $main_title_element ?> <?php echo $staff_recruit_main_title_size;?>" style="color: <?php echo $main_title_font_color; ?>"><?php echo nl2br($fields['メインタイトル']); ?></h2>
		<?php } ?>

		<?php if($fields['サブタイトル']) { ?>
			<h3 class="sub_title text_decoration <?php echo $text_decoration; ?> <?php echo $sub_title_class ?> <?php echo $sub_title_element ?> <?php echo $staff_recruit_sub_title_size;?>" style="color: <?php echo $sub_title_font_color; ?>; border-color:<?php echo $text_decoration_color; ?>"><?php echo nl2br($fields['サブタイトル']); ?></h3>
		<?php } ?>

		<?php if($fields['テキスト']) { ?>
			<div class="text_decoration <?php echo $text_decoration; ?>" style ="border-color:<?php echo $text_decoration_color; ?>; background-color:<?php echo $text_bg_color ?>">
				<p class="text <?php echo $text_class ?> text_element <?php echo $text_element ?> text-size <?php echo $staff_recruit_text_size;?>" style="color: <?php echo $text_font_color; ?>"><?php echo nl2br($fields['テキスト']); ?></p>
		</div>
		<?php } ?>
</section>

<?php 
	}
}
?>
