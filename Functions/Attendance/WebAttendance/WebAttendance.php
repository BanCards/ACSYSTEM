<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    Error("ログイン情報エラー", "ログインしてください。", "12A_");
    return;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Web Attend</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/Common.css">
    <link rel="stylesheet" href="../CSS/Attendance.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">

            <div class="form">
                <form action="Events/LoadInformation.php" method="POST">
                    <h1 class="attendance-title">選択をしてください</h1>

                    <div class="attendance-items">

                        <div class="attendance-item">
                            <select name="status" required>
                                <option value="absent">欠席</option>
                                <option value="lateness">遅刻</option>
                                <option value="leave_early">早退</option>
                                <option value="official_absence">公欠</option>
                                <option value="other">その他</option>
                            </select>
                        </div>

                        <div class="attendance-item">
                            <textarea name="comment" cols="30" rows="10" placeholder="理由(記入は自由です)"></textarea>
                        </div>


                        <div class="attendance-item">
                            <button type="submit">提出</button>
                        </div>

                        <div class="attendance-item">
                            <a href="../../../Index.php"><button type="button">戻る</button></a>
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