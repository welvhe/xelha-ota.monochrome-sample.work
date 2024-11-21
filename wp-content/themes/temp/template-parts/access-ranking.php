<!-- ランキング -->
<?php
    require(__DIR__ . '/../setting.php');
    // 週間ランキング用SQL
    $weekly_access_ranking_sql = "
        SELECT 
            staffs.id AS staff_id,
            staffs.name AS staff_name, 
            staffs.post AS staff_post, 
            staff_images.image_url AS staff_image, 
            shops.name AS shop_name,
            COUNT(access.id) AS access_count
        FROM 
            access
        JOIN 
            staffs ON access.staff_id = staffs.id
        LEFT JOIN 
            staff_images ON staffs.id = staff_images.staff_id AND staff_images.subject_id = 1
        JOIN 
            shops ON access.shop_id = shops.id
        WHERE 
            access.shop_id = :shop_id
        AND 
            access.created_at >= NOW() - INTERVAL 7 DAY
        GROUP BY 
            staffs.id
        ORDER BY 
            access_count DESC
    ";

    // 月間ランキング用SQL
    $monthly_access_ranking_sql = "
        SELECT 
            staffs.id AS staff_id,
            staffs.name AS staff_name, 
            staffs.post AS staff_post, 
            staff_images.image_url AS staff_image, 
            shops.name AS shop_name,
            COUNT(access.id) AS access_count
        FROM 
            access
        JOIN 
            staffs ON access.staff_id = staffs.id
        LEFT JOIN 
            staff_images ON staffs.id = staff_images.staff_id AND staff_images.subject_id = 1
        JOIN 
            shops ON access.shop_id = shops.id
        WHERE 
            access.shop_id = :shop_id
        AND 
            access.created_at >= NOW() - INTERVAL 30 DAY
        GROUP BY 
            staffs.id
        ORDER BY 
            access_count DESC
    ";

    // 週間ランキング取得
    $weekly_stmt = $pdo->prepare($weekly_access_ranking_sql);
    $weekly_stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
    $weekly_stmt->execute();
    $weekly_ranking_list = $weekly_stmt->fetchAll(PDO::FETCH_ASSOC);

    // 月間ランキング取得
    $monthly_stmt = $pdo->prepare($monthly_access_ranking_sql);
    $monthly_stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
    $monthly_stmt->execute();
    $monthly_ranking_list = $monthly_stmt->fetchAll(PDO::FETCH_ASSOC);

    //アクセスランキング設定
    $shop_sql = "SELECT access_ranking FROM shops WHERE id = :shop_id";
    $shop = $pdo->prepare($shop_sql);
    $shop->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
    $shop->execute();
    $shop_ar = $shop->fetch(PDO::FETCH_ASSOC);

    $ar_max_initial_display = 7; // 初期表示数
    $ar_increment_count = 4; // 追加表示数

    // to script.php
    $ar_num = array(
        'ar_max_initial_display' => $ar_max_initial_display,
        'ar_increment_count' => $ar_increment_count,
    );
    set_query_var('ar_num', $ar_num);
    ?>

    <?php if($shop_ar['access_ranking'] == 1 && ($weekly_ranking_list || $monthly_ranking_list) && $change_content == "ranking") { ?>
    <section class="ranking">
        <div class="ranking__inner">
            <h2 class="title_style">A C C E S S&nbsp;&nbsp;R A N K I N G</h2>
            <h3 class="sub_title_style">アクセスランキング</h3>

            <div class="tab">
                <ul>
                    <li>
                        <a href="#" class="tab-link access-tab-link active" data-index="0">
                            週間
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tab-link access-tab-link" data-index="1">
                            月間
                        </a>
                    </li>
                </ul>
            </div>

            <div class="rank_container">
                <!-- 週間ランキング -->
                <div class="rank_content tab-content access-rank-content" data-index="0">
                    <?php if ($weekly_ranking_list) { ?>
                        <?php foreach ($weekly_ranking_list as $index => $rank) { ?>
                            <?php 
                            $ar_visible_class = ($index < 7) ? '' : 'hidden-rank'; 
                            if ($index >= 11) break; 
                            ?>
                            <div class="rank_item <?= $ar_visible_class; ?>">
                                <a href="<?= site_url('profile');?>/?staff=<?php echo $rank['staff_id'];?>">
                                    <h4>No.<span><?= $index + 1; ?></span></h4>
                                    <img src="<?= htmlspecialchars($rank['staff_image']) ? htmlspecialchars($rank['staff_image']) : wp_get_attachment_url( $no_img ); ?>" alt="<?= htmlspecialchars($rank['staff_name']); ?>">
                                    <p class="post"><?= htmlspecialchars($rank['staff_post'] ?: ''); ?></p>
                                    <p class="staff_name"><?= htmlspecialchars($rank['staff_name']); ?></p>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>

                <!-- 月間ランキング -->
                <div class="rank_content tab-content access-rank-content" data-index="1" style="display: none;">
                    <?php if ($monthly_ranking_list) { ?>
                        <?php foreach ($monthly_ranking_list as $index => $rank) { ?>
                            <?php 
                            $ar_visible_class = ($index < 7) ? '' : 'hidden-rank'; 
                            if ($index >= 11) break; 
                            ?>
                            <div class="rank_item <?= $ar_visible_class; ?>">
                                <a href="<?= site_url('profile');?>/?staff=<?php echo $rank['staff_id'];?>">
                                    <h4>No.<span><?= $index + 1; ?></span></h4>
                                    <img src="<?= htmlspecialchars($rank['staff_image']) ? htmlspecialchars($rank['staff_image']) : wp_get_attachment_url( $no_img ); ?>" alt="<?= htmlspecialchars($rank['staff_name']); ?>">
                                    <p class="post"><?= htmlspecialchars($rank['staff_post'] ?: ''); ?></p>
                                    <p class="staff_name"><?= htmlspecialchars($rank['staff_name']); ?></p>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <?php if($before_btn == "view") { ?>
                <a id="ar-view-more-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="#"><span>view more</span></a>

                <?php if($after_btn == "staff") { ?>
                    <a id="ar-after-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('staff'); ?>/"><span>staff page</span></a>
                <?php } else { ?>
                    <a id="ar-after-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('ranking'); ?>/"><span>ranking page</span></a>
                <?php } ?>
            <?php } else { ?>
                <a class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('staff'); ?>/"><span>staff page</span></a>
            <?php } ?>
        </div>
    </section>
<?php } ?>
