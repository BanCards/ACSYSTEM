<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!isLoggedIn()) return;
//if (!hasPermission(getLoginUserRole())) return;

$user = $_SESSION['USERINFORMATION'];
$records = getUserRecord($user['id']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/UserRecord.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="attendrecord-title"><?php echo $user['name'] ?>のプロフィール</h1>

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
                                        <th class="table-header" id="__blank"></th>
                                    </tr>
                                </thead>
                                <tbody>
                            HTML;

                            foreach ($records as $record) {
                                echo "<tr class='table-content'>";
                                foreach ($record as $key => $value) {
                                    if ($key === 'id') continue;
                                    if ($key === 'timestamp') {
                                        $value = date("n月 j日 G時 i分", strtotime($value));
                                    } else {
                                        $value = translate($value);
                                    }
                                    echo "<td class='record-item'>$value</td>";
                                }
                                echo "
                                <form action='EditUserProfile/EditRecord.php' method='POST' name='SendUserRecord{$record['id']}'>
                                    <td class='record-item'>
                                        <input type='hidden' name='record[timestamp]' value='{$record['timestamp']}'>
                                        <input type='hidden' name='record[status]' value='{$record['status']}'>
                                        <input type='hidden' name='record[comment]' value='{$record['comment']}'>
                                        <a href='javascript:document.SendUserRecord{$record['id']}.submit()' class='detail-button'>変更</a>
                                    </td>
                                </form>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="form"></div>
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>
</body>

</html>