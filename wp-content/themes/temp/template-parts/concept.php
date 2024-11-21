<!-- コンセプト -->
<?php
    $concept_bg_color = scf::get('コンセプト背景色', 34);
    $concept_title_color = scf::get('コンセプトタイトル文字色', 34);
    $concept_color = scf::get('コンセプト詳細文字色', 34);
    $concept_img = scf::get('コンセプト画像', 34);
    $concept_title = scf::get('コンセプトタイトル', 34);
    $concept_title_font = scf::get('コンセプトタイトルフォント', 34);
    $concept_title_align = scf::get('コンセプトタイトル段落', 34);
    $concept_title_border = scf::get('コンセプトタイトル下線色', 34);
    $concept_detail = scf::get('コンセプト詳細', 34);
    $concept_detail_font = scf::get('コンセプト詳細フォント', 34);
    $concept_detail_align = scf::get('コンセプト詳細段落', 34);
    $concept_order = scf::get('コンセプト配置');

    if($concept_img || $concept_title || $concept_detail) {
?>

<style type="text/css">
    .concept {
        background-color: <?= $concept_bg_color; ?>;
        color: <?= $concept_color; ?>;
    }

    .concept__inner .title_style {
        border-bottom: 1px solid <?= $concept_title_border; ?>;
        text-align: <?= $concept_title_align; ?>;
        color: <?= $concept_title_color; ?>;
    }

    .concept__inner .detail_style {
        text-align: <?= $concept_detail_align; ?>;
    }

    .concept__inner .title_style,
    .about h2 {
        font-family: <?= $concept_title_font; ?>;
    }

    .concept__inner .detail_style,
    .about p {
        font-family: <?= $concept_detail_font; ?>;
    }
</style>

    <section class="concept">
        <div class="concept__inner <?php $concept_order = scf::get('コンセプト配置');
                                    echo $concept_order; ?>">

            <?php if($concept_img) { ?>
                <img src="<?php
                    echo wp_get_attachment_url($concept_img) ?>" alt onerror = "this.onerror = null; this.src ='';" />
            <?php } ?>

            <?php if($concept_title || $concept_detail) { ?>
            <div class="concept_text">
                <?php if($concept_title) { ?>
                    <p class="title_style"><?= $concept_title; ?></p>
                <?php } ?>
                <?php if($concept_detail) { ?>
                    <p class="detail_style"><?= nl2br($concept_detail); ?></p>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
