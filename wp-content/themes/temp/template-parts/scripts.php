<!-- shop photo modal -->
<script src="<?php echo get_template_directory_uri(); ?>/js/spotlight/spotlight.bundle.js"></script>

<!-- eyecatch motion -->
<?php 
  $eyecatch_thema_type = scf::get('アイキャッチのテーマタイプ', 34);
  $eyecatch_movie_sp_aspect_retio = scf::get('◎アイキャッチ動画■モーション画像比率（SP用）', 34);
  $eyecatch_imgs_motion01 = scf::get('■モーション画像①', 34);
  $eyecatch_imgs_motion02 = scf::get('■モーション画像②', 34);
  $eyecatch_imgs_motion03 = scf::get('■モーション画像③', 34);
  $eyecatch_imgs_motion04 = scf::get('■モーション画像④', 34);
  $eyecatch_imgs_motion05 = scf::get('■モーション画像⑤', 34);
  $eyecatch_imgs_motion06 = scf::get('■モーション画像⑥', 34);
  $eyecatch_imgs_motion07 = scf::get('■モーション画像⑦', 34);
  $eyecatch_imgs_motion08 = scf::get('■モーション画像⑧', 34);
  $eyecatch_imgs_motion09 = scf::get('■モーション画像⑨', 34);
  $eyecatch_imgs_motion10 = scf::get('■モーション画像⑩', 34);
  $eyecatch_imgs_over_motion = scf::get('◎動画■モーションの上にのるロゴ画像', 34);
  $eyecatch_imgs_over_motion_width = scf::get('◎動画■モーションの上にのる画像の横幅', 34);
  $sp_eyecatch_imgs_over_motion_width = scf::get('◎動画■モーションの上にのるロゴ画像の横幅（SP用）', 34);
  $eyecatch_imgs_over_motion_link_url = scf::get('◎動画■モーションの上のロゴにつけるリンクURL', 34);
  $eyecatch_display_link = scf::get('◎動画■モーションの上のリンクボタン', 34);
  $eyecatch_fv_link = scf::get('◎動画■モーションの上のリンクボタンURL', 34);
  $eyecatch_fv_link_txt = scf::get('◎動画■モーションの上のリンクボタンの文章', 34);
  $eyecatch_fv_link_width = scf::get('◎動画■モーションの上のリンクボタンの横幅', 34);
  $eyecatch_fv_link_width_sp = scf::get('◎動画■モーションの上のリンクボタンの横幅（SP用）', 34);
  $eyecatch_fv_link_top = scf::get('◎動画■モーションの上のリンクボタンの位置', 34);
  $eyecatch_fv_link_top_sp = scf::get('◎動画■モーションの上のリンクボタンの位置（SP用）', 34);
  $overlay = scf::get('オーバレイ', 34);
?>

<?php if ($eyecatch_thema_type === '■モーション01--flash' || $eyecatch_thema_type === '■モーション02--blur' || $eyecatch_thema_type === '■モーション03--zoom-out') { ?>
  <?php for ($i = 1; $i <= 10; $i++) { ?>
    <input id="for_motion<?php echo $i; ?>" type="hidden" name="<?php echo wp_get_attachment_url(${"eyecatch_imgs_motion" . sprintf("%02d", $i)}); ?>">
  <?php } ?>

  <input id="thema_url" type="hidden" name="<?php echo get_template_directory_uri(); ?>">
  <script type="text/javascript">
    $(function() {
      var images = [];
      for (var i = 1; i <= 10; i++) {
        var img = $("#for_motion" + i).attr('name');
        if (img) {
          images.push({ src: img });
        }
      }

      var thema_url = $("#thema_url").attr('name');
      thema_url += '/img/overlays/<?php global $overlay; echo $overlay; ?>.png'

      $('.eyecatch--motion').vegas({
        <?php if ($eyecatch_thema_type === '■モーション01--flash') { ?>
          slides: images,
          delay: 5000, //スライドまでの時間
          timer: false, //タイマーバーの表示/非表示
          overlay: thema_url, //オーバーレイする画像
          animation: 'random', //アニメーションを設定
          transition: 'flash2', //スライド間のエフェクト
          shuffle: true, //シャッフル
          transitionDuration: 2000 //エフェクト時間
        <?php } elseif ($eyecatch_thema_type === '■モーション02--blur') { ?>
          slides: images,
          delay: 5000,
          timer: false,
          overlay: thema_url,
          animation: 'kenburns',
          transition: 'blur',
          shuffle: true,
          transitionDuration: 2000
        <?php } elseif ($eyecatch_thema_type === '■モーション03--zoom-out') { ?>
          slides: images,
          delay: 5000,
          timer: false,
          overlay: thema_url,
          animation: 'kenburns',
          transition: 'zoomOut',
          shuffle: true,
          transitionDuration: 3500
        <?php } ?>
        });
    });
  </script>
<?php } ?>

<!-- SNS view more -->
<script type="text/javascript">
  $(function() {
    $('.sns ul:not(ul:first-of-type)').css('display', 'none');
    $('.more').nextAll('.more').css('display', 'none');
    $('.more').on('click', function() {
      $(this).css('display', 'none');
      $(this).next('ul').slideDown('fast');
      $(this).nextAll('.more:first').css('display', 'flex');
    });
  });
</script>

<!-- SNS modal -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#sns-modal-window').on('touchstart', onTouchStart);
    $('#sns-modal-window').on('touchmove', onTouchMove);
    var direction, position;

    function onTouchStart(event) {
      position = getPosition(event);
      direction = '';
    }

    function onTouchMove(event) {
      if (position - getPosition(event) > 70) {
        direction = 'left';
      } else if (position - getPosition(event) < -70) {
        direction = 'right';
      }
    }

    function getPosition(event) {
      return event.originalEvent.touches[0].pageX;
    }
  
    $('.sns ul li').on('click', function() {
      $('#sns-modal-window').addClass('show');
      $("body").css('overflow', 'hidden');
      
      var target = $(this).attr('class').split(" ")[0];
      target = "." + target;
      var pos01 = $("#sns-modal-window ul li" + target).position().top;
      $("#sns-modal-window div").scrollTop(pos01 + 20);
    });

    $('#sns-modal-window .modal_inner').on('click', function(event) {
      event.stopPropagation();
    });

    $('#sns-modal-window div b').on('click', function() {
      $('#sns-modal-window').removeClass('show');
      $("body").css('overflow', 'auto');
    });
    
    $(document).on('click', '#sns-modal-window', function() {
      $('#sns-modal-window').removeClass('show');
      $("body").css('overflow', 'auto');
    });
  });
</script>

<!-- SNS multimedia -->
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
  <?php for ($a = 1; $a <= 27; $a++) : ?>
    var player_<?php echo $a; ?> = new Plyr('#player_<?php echo $a; ?>');
  <?php endfor; ?>
</script>

<script>
  const snsSwiper = new Swiper(".swiper", {
    slidesPerView: 1,
    slidesPerGroup: 1,
    pagination: {
      el: ".swiper-pagination"
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
</script>

<script>
  <?php for($i = 1; $i <= 30; $i++) :?>
    document.addEventListener('DOMContentLoaded', function() {
      var video_<?= $i;?> = document.getElementById('player_<?= $i;?>');
      if(video_{{$i}}) {
        var observer_<?= $i;?> = new IntersectionObserver(function(entries) {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              video_<?= $i;?>.play().catch(error => {
                console.log('再生エラー:', error);
              });
              video_<?= $i;?>.muted = "muted";
            } else {
              video_<?= $i;?>.pause();
              video_<?= $i;?>.muted = "muted";
            }
          });
        }, {
          threshold: 0.5
        });
        observer_<?= $i;?>.observe(video_<?= $i;?>);
      }
    });
  <?php endfor; ?>
</script>

<!-- ranking tab-accordion -->
<?php if (empty($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] === '/') { ?>
  <script>
    $(document).ready(function() {
      // staff ranking
      <?php $sr_num = get_query_var('sr_num'); ?> // from staff-ranking.php
      const srMaxInitialDisplay = <?= $sr_num['sr_max_initial_display']; ?>;
      const srIncrementCount = <?= $sr_num['sr_increment_count']; ?>;

      let srTabState = {};

      $('.staff-tab-link:first').addClass('active');
      $('.staff-rank-content:first').show();
      $('.staff-ranking-title').text($('.staff-tab-link:first').data('title'));
      $('#sr-after-btn').hide();
      
      $('.staff-rank-content').each(function() {
        const index = $(this).data('index');
        srTabState[index] = {
          visibleItems: $(this).find('.rank_item:not(.hidden-rank)').length,
          totalItems: $(this).find('.rank_item').length
        };
      });

      $('.staff-tab-link').on('click', function(e) {
        e.preventDefault();
        
        let index = $(this).data('index');
        let newTitle = $(this).data('title');

        $('.staff-tab-link').removeClass('active');
        $(this).addClass('active');

        $('.staff-rank-content').hide();
        $(`.staff-rank-content[data-index="${index}"]`).fadeIn(500);

        $('.staff-ranking-title').text(newTitle);

        srCheckViewMoreVisibility(index);
      });

      $('#sr-view-more-btn').on('click', function(event) {
        event.preventDefault();
        
        let activeTab = $('.staff-rank-content:visible').data('index');
        let state = srTabState[activeTab];

        let hiddenItems = $(`.staff-rank-content[data-index="${activeTab}"] .rank_item.hidden-rank`);
        hiddenItems.slice(0, srIncrementCount).slideDown('fast').removeClass('hidden-rank');

        state.visibleItems += srIncrementCount;
        srCheckViewMoreVisibility(activeTab);
      });

      function srCheckViewMoreVisibility(tabIndex) {
        let state = srTabState[tabIndex];
        if (state.visibleItems >= state.totalItems) {
          $('#sr-view-more-btn').hide();
          $('#sr-after-btn').show();
        } else {
          $('#sr-view-more-btn').show();
          $('#sr-after-btn').hide();
        }
      }

      $('.rank_item.hidden-rank').css('display', 'none');
      srCheckViewMoreVisibility($('.staff-rank-content:visible').data('index'));

      // access ranking
      <?php $ar_num = get_query_var('ar_num'); ?> // from access-ranking.php
      const arMaxInitialDisplay = <?= $ar_num['ar_max_initial_display']; ?>;
      const arIncrementCount = <?= $ar_num['ar_increment_count']; ?>;

      let arTabState = {};

      $('.access-tab-link:first').addClass('active');
      $('.access-rank-content:first').show();
      $('#ar-after-btn').hide();

      $('.access-rank-content').each(function() {
        const index = $(this).data('index');
        arTabState[index] = {
          visibleItems: $(this).find('.rank_item:not(.hidden-rank)').length,
          totalItems: $(this).find('.rank_item').length
        };
      });

      $('.access-tab-link').on('click', function(e) {
        e.preventDefault();
        let index = $(this).data('index');

        $('.access-tab-link').removeClass('active');
        $(this).addClass('active');

        $('.access-rank-content').hide();
        $(`.access-rank-content[data-index="${index}"]`).fadeIn(500);

        arCheckViewMoreVisibility(index);
      });

      $('#ar-view-more-btn').on('click', function(event) {
        event.preventDefault();

        let activeTab = $('.access-rank-content:visible').data('index');
        let state = arTabState[activeTab];

        let hiddenItems = $(`.access-rank-content[data-index="${activeTab}"] .rank_item.hidden-rank`);
        hiddenItems.slice(0, arIncrementCount).slideDown('fast').removeClass('hidden-rank');

        state.visibleItems += arIncrementCount;
        arCheckViewMoreVisibility(activeTab);
      });

      function arCheckViewMoreVisibility(tabIndex) {
        let state = arTabState[tabIndex];
        if (state.visibleItems >= state.totalItems) {
          $('#ar-view-more-btn').hide();
          $('#ar-after-btn').show();
        } else {
          $('#ar-view-more-btn').show();
          $('#ar-after-btn').hide();
        }
      }

      $('.rank_item.hidden-rank').css('display', 'none');
      arCheckViewMoreVisibility($('.access-rank-content:visible').data('index'));

      $('.no-link').click(function(e) {
        e.preventDefault();
      });

    });
  </script>
<?php } else if (strpos($_SERVER['REQUEST_URI'], '/ranking') !== false) { ?>
  <!-- ランキングページタブ切り替え -->
  <script>
  $(document).ready(function() {
    // スタッフランキングのタブ切り替え
    $('.staff-tab-link:first').addClass('active');
    $('.staff-rank-content:first').show();
    $('.staff-ranking-title').text($('.staff-tab-link:first').data('title'));

    $('.staff-tab-link').click(function(e) {
      e.preventDefault();

      // タブリンクのアクティブクラスの切り替え
      $('.staff-tab-link').removeClass('active');
      $(this).addClass('active');

      // タブに対応するコンテンツを表示
      var index = $(this).data('index');
      $('.staff-rank-content').hide();
      $('.staff-rank-content[data-index="' + index + '"]').show();

      // タイトルを更新
      var newTitle = $(this).data('title');
      $('.staff-ranking-title').text(newTitle);
    });

    // アクセスランキングのタブ切り替え
    $('.access-tab-link').click(function(e) {
      e.preventDefault();

      // タブリンクのアクティブクラスの切り替え
      $('.access-tab-link').removeClass('active');
      $(this).addClass('active');

      // タブに対応するコンテンツを表示
      var index = $(this).data('index');
      $('.access-rank-content').hide();
      $('.access-rank-content[data-index="' + index + '"]').show();
    });

    $('.no-link').click(function(e) {
      e.preventDefault();
    });
  });
  </script>
<?php } ?>
