<?php
include('Functions/Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
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

      <!-- アイテム -->
      <div class="item">
        <!--TODO-->
          <a href="Functions/Attendance/DirectAttendance/DirectAttendance.php"><button>カードで出席</button></a>
          <a href="Functions/Attendance/WebAttendance/WebAttendance.php"><button>WEBから出席</button></a>
          <a href="Functions/Login/Login.php"><button>ログインする</button></a>
          <a href="Functions/Logout/Logout.php"><button>ログアウトする</button></a>
          <a href="Functions/Profile/Profile.php"><button>プロフィールを見る</button></a>
      </div>

      <!-- アイテム -->
      <div class="notification">
        <h3 class="notification-title">お知らせ</h3>
        <ul class="news-list">
          <li>
            <p class="date">2023/10/24</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">ver 2.1.0 が公開されました。</p>
          </li>
          <li>
            <p class="date">2023/10/12</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">ver 2.0.0 が公開されました。</p>
          </li>
          <li>
            <p class="date">2023/07/21</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">ver 1.3.0 が公開されました。</p>
          </li>
          <li>
            <p class="date">2023/07/20</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">ver 1.2.0 が公開されました。</p>
          </li>
          <li>
            <p class="date">2023/07/20</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">データベースを更新しました。</p>
          </li>
          <li>
            <p class="date">2023/06/29</p>
            <p class="category"><span>アップデート</span></p>
            <p class="title">ver 1.1.0 が公開されました。</p>
          </li>
        </ul>
      </div>

    </div>

    <!-- フッター -->
    <div class="footer">
      <div class="copyright">
        <p>Copyright &copy; 2023 Attendance Check System by ACSystem Team All rights reserved.</p>
      </div>
    </div>

  </div>

</body>

</html>