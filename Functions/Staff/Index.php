<?php
include('../../Functions/Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

if (!(hasPermission(getLoginUUID()))) {
    setError("権限がありません。", "もう一度ご確認ください。", "12P");
    return;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Index.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders(); ?>

        <!-- メイン -->
        <div class="main">

            <?php
            sendQuickAccessesForStaff();
            ?>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

</body>

</html>