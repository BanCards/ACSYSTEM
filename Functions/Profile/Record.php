<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (empty(getUUID())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return false;
}

$records = getUserRecord(getUUID());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Record.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="attendrecord-title"><?php echo getUserName() ?>のプロフィール</h1>

                <div class="attendance-items">
                    <table class="attendance-item">
                        <?php
                        if (empty($records)) {
                            echo "<tr class='not-attend-record'><td>情報なんてないよ。 :(</td></tr>";
                        } else {
                            echo <<<HTML
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
                            HTML;

                            foreach ($records as $record) {
                                echo "<tr class='table-content'>";
                                foreach ($record as $key => $value) {
                                    if($key === 'id') continue;
                                    if ($key === 'timestamp') {
                                        $value = date("n月 j日 G時 i分", strtotime($value));
                                    } else {
                                        $value = translate($value);
                                    }
                                    echo "<td class='record-item'>$value</td>";
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