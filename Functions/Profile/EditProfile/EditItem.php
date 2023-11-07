<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$item = $_GET['edit-item'];
$_SESSION['editItem'] = $item;
$itemTrans = "";

if ($item == 'card_info') {
  $itemTrans = "カード情報";
} elseif ($item == 'class_info') {
  $itemTrans = "クラス情報";
} elseif ($item == 'name_info') {
  $itemTrans = "名前情報";
} elseif ($item == 'mail_info') {
  $itemTrans = "メールアドレス情報";
} elseif ($item == 'password_info') {
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
  <link rel="stylesheet" href="../CSS/EditItem.css" />
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
            <a href="#">
              <i class="fas fa-question-circle"></i> ヘルプ
            </a>
          </li>
          <li class="logout">
            <a href="#">
              <i class="fas fa-sign-in-alt"></i> ログアウト
            </a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- メイン -->
    <div class="main">
      <div class="form" id="new-item-form">

        <form action="Events/LoadInformation.php" method="POST">
          <h1 class="profile-title"><?php echo getUserName() ?>のプロフィールを編集</h1>

          <div class="form-item_required">
            <?php
            if ($item == "card_info") {
              echo getUserCard();
            } else if ($item == "class_info") {
              echo getUserClass();
            } else if ($item == "name_info") {
              echo getUserName();
            } else if ($item == "mail_info") {
              echo getUserEmail();
            } else if ($item == "password_info") {
              echo "<input type='password' name='current-item-value' value='' minlength='3' maxlength='16' placeholder='現在の値' />";
            }
            ?>
          </div>

          <div class="profile-item" id="new-item-value">
            新しい<?php echo $itemTrans ?>を設定してください
          </div>

          <div class="form-item_required">

            <?php
            if ($item == "card_info") {
              echo "<input type='text' name='new-item-value' value='' id='cardID' pattern='[0-9]*' placeholder='新しいカード情報を読み込み' />";
            } else if ($item == "class_info") {
              echo
              "<select name='new-item-value' required>
                <option value='1B'>1年B組</option>
                <option value='2B'>2年B組</option>
              </select>";
            } else if ($item == "name_info") {
              echo "<input type='text' name='new-item-value' value='' minlength='3' maxlength='16' placeholder='新しい値' />";
            } else if ($item == "mail_info") {
              echo "<input type='email' name='new-item-value' value='' pattern='[\\w\\-._]+@[\\w\\-._]+\\.[A-Za-z]+'' placeholder='新しい値' />";
            } else if ($item == "password_info") {
              echo "<input type='password' name='new-item-value' value='' minlength='3' maxlength='16' placeholder='新しい値' />";
            }
            ?>

          </div>

          <div class="attendance-items">

            <div class="submit-button">
              <a href="SelectEditItem.php"><button type="button" id="cancel-edit">キャンセル</button></a>
            </div>

            <div class="submit-button">
              <button type="submit">決定</button>
            </div>

          </div>

        </form>

      </div>
    </div>

    <!-- フッター -->
    <div class="footer">
      <div class="copyright">
        <p>
          Copyright &copy; 2023 Attendance Check System by ACSystem Team All rights reserved.
        </p>
      </div>
    </div>

  </div>
</body>

</html>