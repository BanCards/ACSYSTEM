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
    header('Location:LoadInformationError.php');
    return;
}

//引数の値がnullならsetError()を行う。　存在するならfalseを返す。
function isEmpty($value)
{
    global $date;
    if (empty($value)) {
        setError("ログイン情報エラー", "ログインしてください。", "12A_" . $date);
        return true;
    }

    return false;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Profile.css">
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
                        <a href="Profile.php">
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
                <h1 class="profile-title">プロフィール</h1>

                <div class="profile-items">

                    <div class="profile-item">
                        カード情報 : <strong>
                            <?php
                            if (!(isEmpty($_SESSION['UserCard'])))
                                echo $_SESSION['UserCard'];
                            ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        名前 : <strong>
                            <?php
                            if (!(isEmpty($_SESSION['UserName'])))
                                echo $_SESSION['UserName'];
                            ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        メールアドレス : <strong>
                            <?php
                            if (!(isEmpty($_SESSION['UserEmail'])))
                                echo $_SESSION['UserEmail'];
                            ?>
                        </strong>
                    </div>

                </div>

                <div class="attendance-items">
                    <div class="attendance-item">
                        <a href="../Login/Login.html"><button type="button">出席状況を見る</button></a>
                    </div>

                    <div class="attendance-item">
                        <a href="../Login/Login.html"><button type="button">プロフィール編集</button></a>
                    </div>
                </div>

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