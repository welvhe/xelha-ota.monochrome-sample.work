<?php
  require(__DIR__ . '/../database.php');

  $about_bg_color = scf::get('アバウト背景色');
  $about_title = scf::get('アバウトタイトル', 34);
  $about_title_color = scf::get('アバウトタイトル文字色');
  $about = scf::get('アバウト', 34);
  $about_color = scf::get('アバウト文字色');
  $about_border = scf::get('アバウト線', 34);
?>

<style type="text/css">
  .about {
    background-color: <?= $about_bg_color; ?>;
    color: <?= $about_color; ?>;
  }
  
  .about_inner {
    border-top: 1px solid <?= $about_border; ?>;
    border-bottom: 1px solid <?= $about_border; ?>;
  }
</style>

<?php if ($about || $about_title) { ?>
  <div class="about">
    <div class="about_inner">
      <?php if ($about_title) { ?>
        <h2><?= nl2br($about_title); ?></h2>
      <?php } ?>
      <?php if ($about) { ?>
        <p><?= nl2br($about); ?></p>
      <?php } ?>
    </div>
  </div>
<?php } ?>
