<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Success</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="../../CSS/LoadInformationSuccess.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="loadSuccess-title"><?php echo getSuccess() ?></h1>
                <div class="loadSuccess-Items">

                    <div class="submit-button">
                        <a href="../../Index.php"><button type="button">ホームに戻る</button></a>
                    </div>

                </div>
            </div>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>
</body>

</html>