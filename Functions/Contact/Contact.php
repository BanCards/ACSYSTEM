<?php
include('../Utils/Utils.php');

if (!(isLoggedIn())) {
  setError("ログイン情報エラー", "ログインしてください。", "12A");
  return;
}
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
    <?php sendFooters() ?>

  </div>

</body>

</html>