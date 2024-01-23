<?php
include('../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$data = calcAttendRate(getLoginUUID());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Profile.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="profile-title"><?php echo getLoginUserName() ?>のプロフィール</h1>

                <div class="profile-items">

                    <div class="profile-item">
                        カード情報 : <strong>
                            <?php echo getLoginUserCard(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        クラス : <strong>
                            <?php echo getLoginUserClass(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        名前 : <strong>
                            <?php echo getLoginUserName(); ?>
                        </strong>
                    </div>

                    <div class="profile-item">
                        メールアドレス : <strong>
                            <?php echo getLoginUserEmail(); ?>
                        </strong>
                    </div>

                </div>

                <div class="attendance-items">
                    <div class="attendance-item">
                        <a href="Record.php"><button type="button">出席状況を見る</button></a>
                    </div>

                    <div class="attendance-item">
                        <a href="EditProfile/SelectEditItem.php"><button type="button">プロフィール編集</button></a>
                    </div>
                </div>

            </div>

            <div class="attend-percentage">
                <canvas id="circle"></canvas>
            </div>
            <script>
                var data = <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>;
            </script>
            <script src="JavaScript/Circle.js"></script>

        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../JavaScript/PopUp.js"></script>
</body>

</html>