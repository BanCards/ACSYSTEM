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

                        <div class="attendance-item-parent">
                            <select class="status" name="status" required>
                                <option value="absent">欠席</option>
                                <option value="lateness">遅刻</option>
                                <option value="leave_early">早退</option>
                                <option value="official_absence">公欠</option>
                                <option value="other">その他</option>
                            </select>
                        </div>

                        <div class="attendance-item-child">
                            <select class="absent-reason" name="" required>
                                <option value="illness">病気</option>
                                <option value="accident">事故</option>
                            </select>

                            <select class="lateness-reason" name="" required>
                                <option value="traffic_issues">交通の問題</option>
                                <option value="health_issues">体調不良</option>
                                <option value="family_matters">家庭事情</option>
                                <option value="forgetfulness">忘れ物</option>
                            </select>

                            <select class="leave_early-reason" name="" required>
                                <option value="health_issues">体調不良</option>
                                <option value="family_matters">家庭事情</option>
                                <option value="scheduled_appointment">必要な予定</option>
                            </select>

                            <select class="official_absence-reason" name="" required>
                                <option value="company_visit">企業に関する事情</option>
                                <option value="academic_research">学校行事</option>
                            </select>

                        </div>

                        <div class="attendance-item">
                            <button type="submit" id="submit-button">提出</button>
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

    <script src="JS/SwitchSelectItem.js"></script>
</body>

</html>