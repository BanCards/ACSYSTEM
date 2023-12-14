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
                        <div class="accountIndex">
                            アカウント番号 : <strong class="AccountIndexHolder">
                                <?php echo $_POST['cardID']; ?>
                            </strong>
                        </div>
                    </div>

                    <div class="form-item_required">
                        <select name="class" required>
                            <option value="1B">1年B組</option>
                            <option value="2B">2年B組</option>
                        </select>
                    </div>

                    <div class="form-item_required">
                        <input type="text" name="name" value="" placeholder="ユーザー名 (2文字～16文字)" />
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

                    <div class="createAccount-items">

                        <div class="createAccount-item">
                            <a href="ReadCard.php"><button type="button" class="loginButton">カード再読み込み</button></a>
                        </div>

                        <div class="createAccount-item">
                            <a href="../Login/Login.php">
                                <button type="button" class="loginButton">ログイン</button></a>
                        </div>
                    </div>

                </form>
            </div>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="/ACSystem/JavaScript/PopUp.js"></script>
    <script src="JavaScript/ValidateCheck.js"></script>
</body>

</html>