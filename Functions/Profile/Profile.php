<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if(!isLoggedIn()) return;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Profile.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="profile-title"><?php echo getUserName() ?>のプロフィール</h1>

                <div class="profile-items">

                    <div class="profile-item">
                        カード情報 : <strong>
                            <?php echo getUserCard(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        クラス : <strong>
                            <?php echo getUserClass(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        名前 : <strong>
                            <?php echo getUserName(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        メールアドレス : <strong>
                            <?php echo getUserEmail(); ?>
                        </strong>
                    </div>

                </div>

                <div class="attendance-items">
                    <div class="attendance-item">
                        <a href="Record.php"><button type="button">出席状況を見る</button></a>
                    </div>

                    <div class="attendance-item">
                        <a href="EditProfile/SelectEditItem.php"><button type="button">プロフィール編集</button></a>
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