<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");
    header('Location:LoadInformationError.php');
    return;
}

if (!(isLoggedIn()))
    setError("ログイン情報エラー", "ログインしてください。", "12A_");

$records = getUserAttendRecords();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Attend Record</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Record.css">
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
                <h1 class="attendrecord-title"><?php echo getUserName() ?>のプロフィール</h1>

                <div class="attendance-items">
                    <table class="attendance-item">
                        <thead>
                            <tr>
                                <th class="table-header" id="day">
                                    <p>日付</p>
                                </th>
                                <th class="table-header" id="status">
                                    <p>状態</p>
                                </th>
                                <th class="table-header" id="comment">
                                    <p>備考</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($records)); //TODO(エラー出力)
                            else {
                                foreach ($records as $record) {
                                    echo "<tr class='table-content'>";
                                    foreach ($record as $key => $value) {
                                        if ($key == 'timestamp') {
                                            $value = date("n月 j日 G時 i分", strtotime($value));
                                        } else if ($value == 'attend') {
                                            $value = '出席';
                                        } else if ($value == 'absent') {
                                            $value = '欠席';
                                        } else if ($value == 'lateness') {
                                            $value = '遅刻';
                                        } else if ($value == 'leave_early') {
                                            $value = '早退';
                                        } else if ($value == 'official_absence') {
                                            $value = '公欠';
                                        }
                                        echo "<td class='record-item'>{$value}</td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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