<?php include('../Utils/Utils.php') ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Read Card</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../CSS/Common.css" />
  <link rel="stylesheet" href="CSS/ReadCard.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <?php sendHeaders() ?>

    <!-- メイン -->
    <div class="main">
      <div class="dummy_form">
        <form class="createAccount-form" action="CreateAccount.php" method="post" id="createAccount-readCard">
          <input type="number" name="cardID" id="cardID" />
        </form>
      </div>
      <div class="image">
        <img src="../../Images/ICTouch.png">
      </div>
    </div>

    <!-- フッター -->
    <?php sendFooters() ?>

  </div>

  <div class="pop"></div>

  <script src="../../JavaScript/DisableAutoComplete.js"></script>
  <script src="../../JavaScript/PopUp.js"></script>
  <script src="JavaScript/ConvertHalfWidth.js"></script>
  <script src="JavaScript/EnableKeyInput.js"></script>
  <script src="JavaScript/ValidateCard.js"></script>
</body>

</html>