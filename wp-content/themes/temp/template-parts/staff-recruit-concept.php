<!-- コンセプト -->
<?php 
    $recruit_concept_img = SCF::get('求人用コンセプト画像');
    $recruit_concept_title = SCF::get('求人用コンセプトタイトル');
    $recruit_concept_detail = SCF::get('求人用コンセプト詳細');
    if($recruit_concept_img || $recruit_concept_title || $recruit_concept_detail) {
?>
    <section class="concept recruit">
        <div class="concept__inner <?php $recruit_concept_order = SCF::get('求人用コンセプト配置');
                                    echo $recruit_concept_order; ?>">

            <?php if($recruit_concept_img) { ?>
                <img src="<?php
                    echo wp_get_attachment_url($recruit_concept_img) ?>" alt onerror = "this.onerror = null; this.src ='';" />
            <?php } ?>

            <?php if($recruit_concept_title || $recruit_concept_detail) { ?>
            <div class="concept_text">
                <?php if($recruit_concept_title) { ?>
                    <p class="title_style"><?= $recruit_concept_title; ?></p>
                <?php } ?>
                <?php if($recruit_concept_detail) { ?>
                    <p class="detail_style"><?= nl2br($recruit_concept_detail); ?></p>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
