<?php include('../../Utils/Utils.php') ?>

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
      <div class="dummy_form">
        <form class="attendance-form" action="Events/LoadInformation.php" method="post">
          <input type="text" name="cardID" id="cardID" pattern="[0-9]*" placeholder="カードを読み込ませてください" />
        </form>
      </div>
      <div class="image">
        <img src="../../../Images/ICTouch.png">
      </div>
    </div>

    <!-- フッター -->s
    <?php sendFooters() ?>

  </div>

  <script src="JavaScript/ConvertHalfWidth.js"></script>
  <script src="JavaScript/EnableKeyInput.js"></script>
</body>

</html>