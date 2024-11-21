<!-- ランキング -->
<?php
    require(__DIR__ . '/../setting.php');
    $staff_ranking_sql = "
        SELECT 
            staff_rankings.*, 
            ranking_categories.category, 
            ranking_categories.title, 
            staffs.name AS staff_name, 
            staffs.post AS staff_post, 
            staffs.performance AS staff_performance, 
            staff_images.image_url AS staff_image, 
            shops.name AS shop_name
        FROM 
            staff_rankings
        JOIN 
            ranking_categories 
            ON staff_rankings.ranking_category_id = ranking_categories.id
        JOIN 
            staffs 
            ON staff_rankings.staff_id = staffs.id
        LEFT JOIN 
            staff_images 
            ON staffs.id = staff_images.staff_id 
            AND staff_images.subject_id = 1 
        JOIN 
            shops 
            ON staff_rankings.subject_id = shops.id
        WHERE 
            staff_rankings.subject_id = " . $shop_id . "
        AND 
            staff_rankings.subject_name = 'shop'
        ORDER BY 
            ranking_categories.priority ASC, 
            staff_rankings.rank ASC
    ";
    $staff_ranking_list = $pdo->prepare($staff_ranking_sql);
    $staff_ranking_list->execute();
    $staff_ranking_list = $staff_ranking_list->fetchAll(PDO::FETCH_ASSOC);

    $categories = array_unique(array_column($staff_ranking_list, 'category'));
    
    $sr_max_initial_display = 7; // 初期表示数
    $sr_increment_count = 4; // 追加表示数

    // to script.php
    $sr_num = array(
        'sr_max_initial_display' => $sr_max_initial_display,
        'sr_increment_count' => $sr_increment_count,
    );
    set_query_var('sr_num', $sr_num);
?>

    <?php if($staff_ranking_list && $change_content == "ranking") { ?>
    <section class="ranking">
        <div class="ranking__inner">
            <h2 class="title_style">O F F I C I A L&nbsp;&nbsp;R A N K I N G</h2>
            <h3 class="sub_title_style">オフィシャルランキング</h3>

            <div class="tab">
                <ul>
                    <?php 
                    $category_tabs = array_unique(array_column($staff_ranking_list, 'category'));
                    foreach ($category_tabs as $index => $category) { 
                        $first_rank = current(array_filter($staff_ranking_list, function($rank) use ($category) {
                            return $rank['category'] === $category;
                        }));
                        ?>
                        <li>
                            <a href="#" class="tab-link staff-tab-link" data-index="<?= $index; ?>" data-title="<?= htmlspecialchars($first_rank['title']); ?>">
                                <?= htmlspecialchars($category); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="rank_container">
                <h2 id="ranking-title" class="staff-ranking-title"><?= htmlspecialchars($staff_ranking_list[0]['title']); ?></h2>
                <?php foreach ($category_tabs as $index => $category) { ?>
                    <div class="rank_content tab-content staff-rank-content" data-index="<?= $index; ?>" style="display: none;">
                        <?php
                        $filtered_ranks = array_filter($staff_ranking_list, function($rank) use ($category) {
                            return $rank['category'] === $category;
                        });

                        $current_rank = 1;
                        $rank_counter = 0;
                        $sr_total_ranks = count($filtered_ranks);

                        foreach ($filtered_ranks as $rank) {
                            if ($rank_counter >= 15) {
                                break;
                            }

                            while ($current_rank < $rank['rank']) { 
                                if ($rank_counter >= 15) {
                                    break;
                                }
                                ?>
                                <div class="rank_item">
                                    <a href="#" class="no-link">
                                        <h4>No.<span><?= $current_rank; ?></span></h4>
                                        <img src="<?php echo wp_get_attachment_url( $no_img );  ?>" alt="画像未登録時の代替え画像の<?php echo $store_name; ?>のロゴバナー">
                                        <p class="staff_name">No Name</p>
                                    </a>
                                </div>
                                <?php 
                                $current_rank++;
                                $rank_counter++;
                            }
                            if ($rank_counter >= 15) {
                                break;
                            }

                            $sr_visible_class = ($rank_counter < $sr_max_initial_display) ? '' : 'hidden-rank';
                            ?>
                            <div class="rank_item <?= $sr_visible_class; ?>">
                                <a href="<?= site_url('profile');?>/?staff=<?php echo $rank['staff_id'];?>">
                                    <h4>No.<span><?= htmlspecialchars($rank['rank']); ?></span></h4>
                                    <img src="<?= htmlspecialchars($rank['staff_image']) ? htmlspecialchars($rank['staff_image']) : wp_get_attachment_url( $no_img ); ?>" alt="<?= htmlspecialchars($rank['staff_name']); ?>">
                                    <p class="post"><?= htmlspecialchars($rank['staff_post'] ? $rank['staff_post'] : ''); ?></p>
                                    <p class="staff_name"><?= htmlspecialchars($rank['staff_name']); ?></p>
                                </a>
                            </div>
                            <?php
                            $current_rank = $rank['rank'] + 1;
                            $rank_counter++;
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>

            <?php if($before_btn == "view") { ?>
                <a id="sr-view-more-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="#"><span>view more</span></a>

                <?php if($after_btn == "staff") { ?>
                    <a id="sr-after-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('staff'); ?>/"><span>staff page</span></a>
                <?php } else { ?>
                    <a id="sr-after-btn" class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('ranking'); ?>/"><span>ranking page</span></a>
                <?php } ?>
            <?php } else { ?>
                <a class="ranking__arcives-link--<?php echo $button_shape_thema_type; ?> button_style border_color" href="<?= site_url('staff'); ?>/"><span>staff page</span></a>
            <?php } ?>
        </div>
    </section>
<?php } ?>
