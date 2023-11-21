<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if(!isLoggedIn()) return;

$user = getUser($_POST['uuid']);
$_SESSION['USERINFORMATION'] = $user;
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
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <form action="UserRecord.php" method="POST">
                <div class="form">
                    <h1 class="profile-title"><?php echo $user['name'] ?>のプロフィール</h1>

                    <div class="profile-items">

                        <div class="profile-item">
                            カード情報 : <strong>
                                <?php echo $user['card_id'] ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            クラス : <strong>
                                <?php echo $user['class'] ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            名前 : <strong>
                                <?php echo $user['name'] ?>
                            </strong>
                        </div>

                        <div class="profile-item">
                            メールアドレス : <strong>
                                <?php echo $user['email'] ?>
                            </strong>
                        </div>

                    </div>

                    <div class="attendance-items">

                        <div class="attendance-item">
                            <button type="submit" class="a">出席状況を見る</button>
                        </div>

                        <div class="attendance-item">
                            <a href="#"><button type="button" class="a">プロフィール編集</button></a>
                        </div>

                    </div>

                    <div class="back-button">
                        <a href="SerchUser.php"><button type="button" class="b">戻る</button></a>
                    </div>

                </div>
            </form>
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