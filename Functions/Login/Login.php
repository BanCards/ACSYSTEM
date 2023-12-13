<?php include('../Utils/Utils.php') ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Login.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="login-title">ログイン</h1>
                <form class="login-form" action="Events/LoadInformation.php" method="post">

                    <div class="form-item_required">
                        <input type="text" name="name" value="" maxlength="64" id="name" placeholder="ユーザー名" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="password" value="" maxlength="64" placeholder="パスワード" />
                    </div>

                    <div class="submit-button">
                        <button type="submit" class="loginButton">ログイン</button>
                    </div>

                    <div class="submit-button">
                        <a href="../CreateAccount/ReadCard.php"><button type="button" class="createAccountButton">
                                アカウントを新規作成</button></a>
                    </div>

                </form>
            </div>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <script src="JavaScript/EnableKeyInput.js"></script>
</body>

</html>