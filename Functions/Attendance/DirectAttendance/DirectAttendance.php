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
        <form class="attendance-form" action="Events/LoadInformation.php" method="post" id="attendance-form">
          <input type="number" name="cardID" id="cardID" />
        </form>
      </div>
      <img src="../Images/read-card.png" alt="">
      <div class="loading-message">カードを読み込んでください...</div>
    </div>

    <!-- フッター -->s
    <?php sendFooters() ?>

  </div>

  <div class="pop"></div>

  <script src="../../../JavaScript/DisableAutoComplete.js"></script>
  <script src="../../../JavaScript/PopUp.js"></script>
  <script src="JavaScript/ConvertHalfWidth.js"></script>
  <script src="JavaScript/EnableKeyInput.js"></script>
  <script src="JavaScript/ValidateCard.js"></script>
</body>

</html>