<?php echo $css;?>
<div id="header">
  <div id="header_left">
    <div id="header_logo">
      <a href="./"><img src="./images/common/logo.gif" alt="PR39" /></a>
    </div>
    <div id="header_explain">
      <p>オリジナル付箋作成、名入れふせん印刷－格安付箋制作、激安ふせん製作専門店</p>
    </div>
  </div>
  <div id="header_right">
    <a href="./sample.php">
      <div id="seikyu">
        無料サンプル請求
        <div id="triangle-bottomright4"></div>
      </div>
    </a>
    <a href="./inquire.php">
      <div id="inquiry">
        お問い合わせ
        <div id="triangle-bottomright4"></div>
      </div></a>
  </div>
  <div class="clear_div"></div>
  <div id="navi">
    <ul id="<?php echo $isMobile;?>">
      <li id="first_navi">
        <a href="./category.php?id=1">カバーなし付箋</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li>
        <a href="./category.php?id=2">カバーあり付箋</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li>
        <a href="./original.php">オリジナル型抜き付箋</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li>
        <a href="./category.php?id=4">ハードカバー付箋</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li <?php echo $addClass?>>
        <a href="./category.php?id=5">
          <p <?echo $li5p1;?>>&nbsp;&nbsp;&nbsp;&nbsp;パソコン ・</p>
          <p style="margin-top: -1.2em;">スマートフォン</p></a>
        <div id="triangle-bottomright" <?echo $li5Arrow;?>></div>
      </li>
      <li>
        <a href="./category.php?id=6">NEWアイテム</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li>
        <a href="./category.php?id=7">バックハンガー</a>
        <div id="triangle-bottomright"></div>
      </li>
      <li style="margin-left: 6px;">
        <a href="./category.php?id=10">カレンダー</a>
        <div id="triangle-bottomright"></div>
      </li>
    </ul>
  </div>
  <div class="clear_div"></div>
</div>