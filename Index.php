<?php
include('Functions/Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

/**
 *  CopyRight, © 2023 Attendance Check System by ACSystem Team All rights reserved.
 *
 *  System for school.
 *
 *  @version 2.1.0
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

      <!-- クイックアクセス -->
      <div class="access">
        <h3 class="access-title">クイックアクセス</h3>
        <div class="item">

          <a href="Functions/Attendance/DirectAttendance/DirectAttendance.php" class="btn btn--circle" id="record">
            <i class="fas fa-user-alt"></i>
            <br>
            <p>出席する</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>

          <a href="Functions/Attendance/WebAttendance/WebAttendance.php" class="btn btn--circle" id="report">
            <i class="fas fa-user-alt-slash"></i>
            <br>
            <p>欠席申請をする</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>

          <a href="Functions/Mail/Mail.php" class="btn btn--circle" id="mailbox">
            <i class="fas fa-envelope"></i>
            <br>
            <p>メールボックス</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>

          <a href="Functions/Profile/Record.php" class="btn btn--circle" id="record">
            <i class="fas fa-calendar-week"></i>
            <br>
            <p>履歴を見る</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>

          <a href="Functions/Staff/UserList.php" class="btn btn--circle" id="test">
            <i class="fas fa-id-card"></i>
            <br>
            <p>ユーザー欄</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>
        </div>
      </div>

      <!-- お知らせ -->
      <?php sendNotifications(getNotifications()) ?>

    </div>

    <!-- フッター -->
    <?php sendFooters() ?>

  </div>

</body>

</html>