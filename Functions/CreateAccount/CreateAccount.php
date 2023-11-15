<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

isEmptyItems($_POST['cardID']);

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
                <form class="createAccount-form" action="Events/LoadInformation.php" method="post">

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
                        <input type="text" name="name" value="" minlength="3" maxlength="64" placeholder="ユーザー名" />
                    </div>

                    <div class="form-item_required">
                        <input type="mail" name="email" value="" pattern="[\w\-._]+@[\w\-._]+\.[A-Za-z]+" placeholder="メールアドレス" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="password" value="" minlength="8" maxlength="64" placeholder="パスワード" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="rePassword" value="" minlength="8" maxlength="64" placeholder="再パスワード" />
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
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; 2023 Attendance Check System by ACSystem Team All rights reserved.</p>
            </div>
        </div>

    </div>
</body>

</html>