<?php
session_start();

//日時
$date = date("ymdis");

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode;
    header('Location:LoadInvalid.php');
    return;
}

//引数の値がnullならsetError()を行う。　存在するならfalseを返す。
function isEmpty($value)
{
    global $date;
    if (empty($value)) {
        setError("情報エラー", "ACSystemチームまでご連絡ください。", "12A_" . $date);
        return true;
    }

    return false;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Register Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/Common.css">
    <link rel="stylesheet" href="Css/CreateAccount.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <div class="header">
            <h2>ACSYSTEM</h2>

            <!-- ナビゲーション -->
            <nav class="navigation">
                <ul>
                    <li class="top">
                        <a href="../../Index.html">
                            <i class="fas fa-home"></i> ホーム
                        </a>
                    </li>
                    <li class="profile">
                        <a href="../Profile/Profile.php">
                            <i class="fas fa-user"></i> プロフィール
                        </a>
                    </li>
                    <li class="contact">
                        <a href="../Contact/Contact.html">
                            <i class="fas fa-info-circle"></i> コンタクト
                        </a>
                    </li>
                    <li class="help">
                        <a href="#">
                            <i class="fas fa-question-circle"></i> ヘルプ
                        </a>
                    </li>
                    <li class="logout">
                        <a href="#">
                            <i class="fas fa-sign-in-alt"></i> ログアウト
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <h1 class="createAccount-title">アカウント作成</h1>
                <form class="createAccount-form" action="Events/LoadInformation.php" method="post">

                    <div class="form-item_required">
                        <div class="accountIndex">
                            アカウント番号 : <strong class="AccountIndexHolder">
                                <?php
                                if (!(isEmpty($_SESSION['cardID']))) {
                                    echo htmlspecialchars($_SESSION['cardID']);
                                }
                                ?>
                            </strong>
                        </div>
                    </div>

                    <div class="form-item_required">
                        <input type="text" name="name" value="" maxlength="64" placeholder="ユーザー名" />
                    </div>

                    <div class="form-item_required">
                        <input type="mail" name="email" value="" pattern="[\w\-._]+@[\w\-._]+\.[A-Za-z]+"
                            placeholder="メールアドレス" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="password" value="" maxlength="64" placeholder="パスワード" />
                    </div>

                    <div class="form-item_required">
                        <input type="password" name="rePassword" value="" maxlength="64" placeholder="再パスワード" />
                    </div>

                    <div class="submit-button">
                        <button type="submit" name="createAccountButton" class="createAccountButton">作成</button>
                    </div>

                    <div class="submit-button">
                        <a href="ReadCard.html"><button type="button" class="loginButton">カード再読み込み</button></a>
                    </div>

                    <div class="submit-button">
                        <a href="../Login/Login.html">
                            <button type="button" class="loginButton">ログイン</button></a>
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