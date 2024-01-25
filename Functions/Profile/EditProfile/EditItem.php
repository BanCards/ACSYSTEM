<?php
include('../../Utils/Utils.php');

$_SESSION['input_type'] = str_replace('_info', '', $_GET['edit-item']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Edit Profile</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../../CSS/Common.css" />
  <link rel="stylesheet" href="../CSS/EditItem.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <?php sendHeaders() ?>

    <!-- メイン -->
    <div class="main">
      <div class="form">

        <h1 class="profile-title"><?php echo getLoginUserName() ?>のプロフィールを編集</h1>
        <form action="Events/LoadInformation.php" method="POST" id="new-item-form">

          <?php sendEditProfileItems($_SESSION['input_type']) ?>

          <div class="attendance-items">
            <a href="SelectEditItem.php"><button type="button" id="cancel-edit-button">キャンセル</button></a>
            <button type="submit">決定</button>
          </div>

        </form>

      </div>
    </div>

    <!-- フッター -->
    <?php sendFooters() ?>

  </div>

  <div class="pop"></div>

  <script src="../../../JavaScript/DisableAutoComplete.js"></script>
  <script src="../../../JavaScript/PopUp.js"></script>
  <script src="JavaScript/ValidateInput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
</body>

</html>