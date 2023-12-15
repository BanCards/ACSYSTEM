<?php
include('Functions/Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

/**
 *  CopyRight, © 2023 Attendance Check System by ACSystem Team All rights reserved.
 *
 *  System for school.
 *
 *  @version 2.2.3
 *  @author BanCards
 *  @link https://github.com/BanCards/ACSystem
 */
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="CSS/Common.css">
  <link rel="stylesheet" href="CSS/Index.css">
</head>

<body>
  <div class="content">

    <!-- ヘッダー -->
    <?php sendHeaders(); ?>

    <!-- メイン -->
    <div class="main">

      <?php
      //クイックアクセス
      sendQuickAccesses();
      //お知らせ
      sendNotifications(getNotifications());
      ?>

    </div>

    <!-- フッター -->
    <?php sendFooters() ?>

  </div>

  <div class="pop"></div>

  <script src="JavaScript/PopUp.js"></script>
  <script src="JavaScript/DisableAutoComplete.js"></script>
</body>

</html>