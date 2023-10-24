<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/RegisterSuccess.css">
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
                <h1 class="successRegister-title">ユーザーが正常に登録されました</h1>
                <div class="successRegister-Items">

                    <div class="successRegister-item">
                        <div class="item">
                            アカウント番号 : <strong class="AccountIndexHolder">
                                <?php
                                echo htmlspecialchars($_SESSION['cardID']);
                                unset($_SESSION['cardID']);
                                ?>
                            </strong>
                        </div>
                    </div>

                    <div class="successRegister-item">
                        <div class="item">
                            お名前 : <strong class="AccountIndexHolder">
                                <?php
                                echo htmlspecialchars($_SESSION['name']);
                                unset($_SESSION['name']);
                                ?>
                            </strong>
                            様
                        </div>
                    </div>

                    <div class="successRegister-item">
                        <div class="item">
                            メールアドレス : <strong class="AccountIndexHolder">
                                <?php
                                echo htmlspecialchars($_SESSION['email']);
                                unset($_SESSION['email']);
                                ?>
                            </strong>
                        </div>
                    </div>

                    <div class="submit-button">
                        <a href="../../Index.html"><button type="button">確認</button></a>
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