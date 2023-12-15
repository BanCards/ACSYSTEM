<?php
include('../../Utils/Utils.php');

$item = $_GET['edit-item'];
$_SESSION['editItem'] = $item;
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
      <div class="form" id="new-item-form">

        <form action="Events/LoadInformation.php" method="POST" id="newItem-form">
          <h1 class="profile-title"><?php echo getLoginUserName() ?>のプロフィールを編集</h1>

          <div class="profile-item" id="new-item-value">
            新しい<?php echo translate($item) ?>を設定してください
          </div>

          <div class="form-item_required editItem">
            <?php
            if ($item == "email_info")
              echo "現在の値 : " . getLoginUserEmail();
            else if ($item == "password_info")
              echo "<input type='password' name='current-item-value' value='' placeholder='現在の値' />";
            ?>
          </div>

          <div class="form-item_required editItem" id="item-value">

            <?php
            if ($item == "email_info")
              echo "<input type='email' name='new-item-value' value='' pattern='[\\w\\-._]+@[\\w\\-._]+\\.[A-Za-z]+'' placeholder='新しい値' />";
            else if ($item == "password_info")
              echo "<input type='password' name='new-item-value' value='' placeholder='新しい値' />";
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
    <?php sendFooters() ?>

    <?php
    if ($item == "password_info")
      echo
      "
      <div class='pop'></div>
      <script src='../../../JavaScript/PopUp.js'></script>
        <script src='JavaScript/Validate.js'></script>";
    ?>
  </div>
</body>

</html>