<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$maxValueLength = 3;
$minValueLength = 16;

$item = $_GET['edit-item'];

if ($item == 'card_info') {
  $itemTrans = "カード情報";
} else if ($item == 'class_info') {
  $itemTrans = "クラス情報";
} else if ($item == 'name_info') {
  $itemTrans = "名前情報";
} else if ($item == 'mail_info') {
  $itemTrans = "メールアドレス情報";
} else if ($item == 'password_info') {
  $itemTrans = "パスワード情報";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Read Card</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../../CSS/Common.css" />
  <link rel="stylesheet" href="../CSS/EditProfile.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <div class="header">
      <h2>ACSYSTEM</h2>

      <!-- ナビゲーション -->
      <nav class="navigation">
        <ul>
          <li class="top">
            <a href="../../Index.html">
              <i class="fas fa-home"></i> ホーム
            </a>
          </li>
          <li class="profile">
            <a href="../Profile/Profile.php">
              <i class="fas fa-user"></i> プロフィール
            </a>
          </li>
          <li class="contact">
            <a href="../Contact/Contact.html">
              <i class="fas fa-info-circle"></i> コンタクト
            </a>
          </li>
          <li class="help">
            <a href="#"> <i class="fas fa-question-circle"></i> ヘルプ </a>
          </li>
          <li class="logout">
            <a href="#"> <i class="fas fa-sign-in-alt"></i> ログアウト </a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- メイン -->
    <div class="main">
      <div class="form" id="new-item-form">
        <h1 class="profile-title"><?php echo getUserName() ?>のプロフィールを編集</h1>

        <div class="profile-item" id="new-item-value">
          <?php echo $itemTrans . "を新しい値に設定してください"; ?>
        </div>

        <?php
        $item = $_GET['edit-item'];

        if ($item == 'card_info') {
          //カード情報
          echo
          " <div class='form-item_required'>
              <input type='text' name='cardID' id='cardID' pattern='[0-9]*' placeholder='カードを読み込ませてください' />
            </div>";
        } else if ($item == 'class_info') {
          //クラス情報
          echo "<div class='form-item_required'>
          <select name='class' required>
              <option value='1B'>1年B組</option>
              <option value='2B'>2年B組</option>
          </select>
      </div>";
        } else if ($item == 'name_info') {
          //名前情報
          echo
          " <div class='form-item_required'>
              <input type='text' name='new-item-value' value='' minlength='3' maxlength='16' placeholder='新しい値' />
            </div>";
        } else if ($item == 'mail_info') {
          //メール情報
          echo
          " <div class='form-item_required'>
          <input type='mail' name='email' value='' pattern='[\w\-._]+@[\w\-._]+\.[A-Za-z]+' placeholder='新しい値' />
            </div>";
        } else if ($item == 'password_info') {
          //パスワード情報
          echo
          " <div class='form-item_required'>
          <input type='password' name='password' value='' minlength='8' maxlength='16' placeholder='新しい値' />
            </div>";
        }
        ?>

        <div class="attendance-item">
          <a href="SelectEditItem.php"><button type="button" id="cancel-edit">キャンセル</button></a>
        </div>

      </div>

    </div>

    <!-- フッター -->
    <div class="footer">
      <div class="copyright">
        <p>
          Copyright &copy; 2023 Attendance Check System by ACSystem Team All
          rights reserved.
        </p>
      </div>
    </div>
  </div>
</body>

</html>