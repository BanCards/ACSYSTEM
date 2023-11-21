<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if(!isLoggedIn()) return;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Logout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Logout.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="logout-title">ログアウトをしますか</h1>

                <div class="submit-button">
                    <a href="Events/LoadInformation.php"><button type="button" class="logoutButton">ログアウト</button></a>
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