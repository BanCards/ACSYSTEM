<?php
include('../../../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$uuid = $_POST['uuid'];
$record = $_POST['record'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Edit Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/Common.css">
    <link rel="stylesheet" href="../../CSS/SelectEditRecord.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <form action="">
                    <h1 class="profile-title"><?php echo getUserName($uuid) ?>の出欠を編集</h1>

                    <div class="profile-items">

                        <div class="profile-item">
                            日付 : <strong><?php echo $record['timestamp'] ?></strong>
                            <a href="EditRecord.php?edit-item=time_info" id="edit-button">編集</a>
                        </div>

                        <div class="profile-item">
                            状態 : <strong><?php echo translate($record['status']) ?></strong>
                            <a href="EditRecord.php?edit-item=status_info" id="edit-button">編集</a>
                        </div>

                        <div class="profile-item">
                            備考 : <strong><?php echo $record['comment'] ?></strong>
                            <a href="EditRecord.php?edit-item=comment_info" id="edit-button">編集</a>
                        </div>

                        <div class="attendance-item">
                            <a href="#"><button type="button" id="cancel-edit">キャンセル</button></a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

</body>

</html>