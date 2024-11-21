<?php
for ($i = 1; $i < 4; $i++) {
  $column_count_bg_color[$i] = SCF::get('カラム背景' . $i);
  $column_count_color[$i] = SCF::get('カラム基本文字色' . $i);
  $column_count[$i] = SCF::get('カラム数' . $i);
  $column_count_title[$i] = SCF::get('カラムコンテンツ内メインタイトル' . $i);
  $column_count_title_color[$i] = SCF::get('カラムコンテンツ内メインタイトル文字色' . $i);
  $column_contents[$i] = SCF::get('column-content-' . $i);
  $column_title_align[$i] = SCF::get('カラムタイトル段落' . $i);
  $column_text_align[$i] = SCF::get('カラムテキスト段落' . $i);
  $column_img_order[$i] = SCF::get('カラム内並び順' . $i);

  $should_display_section = false;

  foreach ($column_contents[$i] as $column_content) {
    $column_img = wp_get_attachment_image_src($column_content['カラム画像' . $i], 'full');
    $column_title = $column_content['カラムタイトル' . $i];
    $column_text = $column_content['カラムテキスト' . $i];

    if ($column_img || $column_title || $column_text) {
      $should_display_section = true;
    }
  }

  if ($should_display_section) {
?>
  <section class="column-content" style="background-color: <?= $column_count_bg_color[$i]; ?>; color: <?= $column_count_color[$i]; ?>">
    <?php if ($column_count_title[$i]) { ?>
      <h1 style="color: <?= $column_count_title_color[$i]; ?>"><?= $column_count_title[$i]; ?></h1>
    <?php } ?>
    <div class="inner">
      <?php
      foreach ($column_contents[$i] as $column_content) {
        $column_img = wp_get_attachment_image_src($column_content['カラム画像' . $i], 'full');
        $column_title = $column_content['カラムタイトル' . $i];
        $column_text = $column_content['カラムテキスト' . $i];

        if ($column_img || $column_title || $column_text) {
      ?>
        <div class="<?php echo $column_count[$i]; ?>">
          <?php if ($column_img) { ?>
            <img src="<?php echo $column_img[0]; ?>" class="<?php echo $column_img_order[$i]; ?>">
          <?php } ?>

          <?php if ($column_title) { ?>
            <h2 class="title <?= $column_title_align[$i]; ?>">
              <?= $column_title; ?>
            </h2>
          <?php } ?>

          <?php if ($column_text) { ?>
            <p class="text <?= $column_text_align[$i]; ?>">
              <?php echo nl2br($column_text); ?>
            </p>
          <?php } ?>
        </div>
      <?php 
          }
        }
      ?>
    </div>
  </section>
<?php
  }
}
?>
