<?php
include('../../../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

if (!(hasPermission(getLoginUUID()))) {
    setError("権限がありません。", "もう一度ご確認ください。", "12P");
    return;
}

$uuid = $_POST['uuid'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Profile.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <form action="UserRecord.php" method="POST">
                <div class="form">
                    <h1 class="profile-title"><?php echo getUserName($uuid) ?>のプロフィール</h1>

                    <div class="profile-items">

                        <div class="profile-item">
                            カード情報 : <strong>
                                <?php echo getUserCard($uuid) ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            クラス : <strong>
                                <?php echo getUserClass($uuid) ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            名前 : <strong>
                                <?php echo getUserName($uuid) ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            メールアドレス : <strong>
                                <?php echo getUserEmail($uuid) ?>
                            </strong>
                        </div>

                        <?php echo "<input type='hidden' name='uuid' value='{$uuid}'>"; ?>

                    </div>

                    <div class="user-profile-items">

                        <div class="user-profile-item">
                            <button type="submit" class="a">出席状況を見る</button>
                        </div>

                        <div class="user-profile-item">
                            <a href="../UserList/UserList.php"><button type="button" class="b">戻る</button></a>
                        </div>

                    </div>

                </div>
            </form>
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="../../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../../JavaScript/PopUp.js"></script>
</body>

</html>