<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Direct Attend</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../../CSS/Common.css" />
  <link rel="stylesheet" href="../CSS/CardAttend.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <?php sendHeaders() ?>

    <!-- メイン -->
    <div class="main">
      <div class="form">
        <h1 class="attendance-title">カードで出席</h1>

        <form class="attendance-form" action="Events/LoadInformation.php" method="post">
          <div class="form-item_required">
            <input type="text" name="cardID" id="cardID" pattern="[0-9]*" placeholder="カードを読み込ませてください" />
          </div>
        </form>
      </div>
    </div>

    <!-- フッター -->
    <?php sendFooters() ?>

  </div>

  <script src="JavaScript/ConvertHalfWidth.js"></script>
  <script src="JavaScript/EnableKeyInput.js"></script>
</body>

</html>