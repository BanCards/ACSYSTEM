<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Error</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="../../CSS/LoadInformationError.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="loadError-title">
                    <?php echo getError('title') ?>
                </h1>

                <div class="loadError-items">

                    <div class="loadError-item">
                        <?php echo getError('message') ?>
                    </div>

                    <div class="loadError-item">
                        <?php echo getError('code') ?>
                    </div>

                    <div class="submit-button">
                        <a href="../../Index.php"><button type="button">ホームに戻る</button></a>
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