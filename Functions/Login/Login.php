<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");
    header('Location:LoadInformationError.php');
    return;
}

if (isLoggedIn())
    setError("ログイン情報エラー", "ログアウトしてください。", "12A_");
?>

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
                        <a href="Login.html">
                            <i class="fas fa-sign-in-alt"></i> ログアウト
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

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
                        <a href="../createAccount/ReadCard.html"><button type="button" class="createAccountButton">
                                アカウントを新規作成</button></a>
                    </div>

                    <!-- キー入力をロード時に有効に -->
                    <script>
                        window.onload = function () {
                            var element = document.getElementById('name');
                            element.focus();
                        }
                    </script>

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