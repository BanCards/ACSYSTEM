<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Success</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/Common.css">
    <link rel="stylesheet" href="../CSS/Attended.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <div class="title">出席しました!</div>
                <div class="message">...<div id="countdown"></div>秒後に自動で戻ります。</div>
            </div>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <script src="JavaScript/CountDown.js"></script>
</body>

</html>