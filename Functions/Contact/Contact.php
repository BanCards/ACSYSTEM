<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if(!isLoggedIn()) return;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Contact</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../CSS/Common.css" />
  <link rel="stylesheet" href="CSS/Contact.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <?php sendHeaders() ?>

    <!-- メイン -->
    <div class="main">
      <div class="form">
        <h1 class="contact-title">コンタクト</h1>
        <form class="contact-form" action="ConfirmContact.php" method="GET">

          <div class="form-item_required">
            <input type="text" name="contactTitle" value="" placeholder="タイトル" maxlength="30">
          </div>

          <div class="form-item_required">
            <textarea name="contactContents" value="" placeholder="お問い合わせ内容" maxlength="390"></textarea>
          </div>

          <div class="submit-button">
            <button type="submit">確認</button>
          </div>
        </form>
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