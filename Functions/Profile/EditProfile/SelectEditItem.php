<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (empty(getUUID())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return false;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Edit Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/Common.css">
    <link rel="stylesheet" href="../CSS/EditProfile.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="profile-title"><?php echo getUserName() ?>のプロフィールを編集</h1>

                <div class="profile-items">

                    <div class="profile-item">
                        メールアドレス : <strong>
                            <?php echo getUserEmail(); ?>
                        </strong>
                        <a href="EditItem.php?edit-item=email_info" id="edit-button" name="edit-item" value="email_info">編集</a>
                    </div>

                    <div class="profile-item">
                        パスワード : **********
                        <a href="EditItem.php?edit-item=password_info" id="edit-button" name="edit-item" value="password_info">編集</a>
                    </div>

                    <div class="attendance-item">
                        <a href="../Profile.php"><button type="button" id="cancel-edit">キャンセル</button></a>
                    </div>

                </div>

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