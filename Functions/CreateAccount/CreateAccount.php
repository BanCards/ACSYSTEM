<?php
include('../Utils/Utils.php');

if (isEmptyItems($_POST['cardID'])) return;

$_SESSION['cardID'] = $_POST['cardID'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Register Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/CreateAccount.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="createAccount-title">アカウント作成</h1>
                <form class="createAccount-form" action="Events/LoadInformation.php" method="post" id="createAccount-form">

                    <div class="form-item_required">
                        <select name="class" required>
                            <option value="1B">1年B組</option>
                            <option value="2B">2年B組</option>
                        </select>
                    </div>

                    <div class="form-item_required">
                        <input type="text" name="upper_name" value="" placeholder="性 (例 : 田中)" />
                    </div>

                    <div class="form-item_required">
                        <input type="text" name="lower_name" value="" placeholder="名 (例 : 太郎)" />
                    </div>

                    <div class="form-item_required">
                        <input type="mail" name="email" value="" pattern="[\w\-._]+@[\w\-._]+\.[A-Za-z]+" placeholder="メールアドレス" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="password" value="" placeholder="パスワード (8文字～32文字)" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="confirm_password" value="" placeholder="確認用パスワード (8文字～32文字)" />
                    </div>

                    <div class="submit-button">
                        <button type="submit" name="createAccountButton" class="createAccountButton">作成</button>
                    </div>

                    <a href="../Login/Login.php">
                        <button type="button" class="loginButton">ログイン</button>
                    </a>

                </form>
            </div>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../JavaScript/PopUp.js"></script>
    <script src="/ACSystem/JavaScript/PopUp.js"></script>
    <script src="JavaScript/ValidateAccount.js"></script>
</body>

</html>