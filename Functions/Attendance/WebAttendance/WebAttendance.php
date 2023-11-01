<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A_");
    header('Location: ../LoadInformationError.php');
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/Common.css">
    <link rel="stylesheet" href="../CSS/Attendance.css">
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
                        <a href="../../../Index.html">
                            <i class="fas fa-home"></i> ホーム
                        </a>
                    </li>
                    <li class="profile">
                        <a href="../../Profile/Profile.php">
                            <i class="fas fa-user"></i> プロフィール
                        </a>
                    </li>
                    <li class="contact">
                        <a href="../../Contact/Contact.html">
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
                <form action="Events/LoadInformation.php" method="POST">
                    <h1 class="attendance-title">選択をしてください</h1>

                    <div class="attendance-items">

                        <div class="attendance-item">
                            <button type="submit" id="attend" name="status" value="attend">
                                出席
                            </button>
                        </div>

                        <div class="attendance-item">
                            <button type="submit" id="absent" name="status" value="absent">
                                欠席
                            </button>
                        </div>


                        <div class="attendance-item">
                            <a href="OtherAttendance.php">
                                <button type="button" id="report">
                                    報告
                                </button>
                            </a>
                        </div>

                    </div>
                </form>
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