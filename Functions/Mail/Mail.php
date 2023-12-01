<?php
include('../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$mails = getMailRecord(getLoginUUID());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/Mail.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="mailbox-title">メールボックス</h1>

                <div class="mailbox-items">
                    <table class="mailbox-item">
                        <?php
                        if (empty($mails)) {
                            echo "<tr class='not-mail-record'><td>情報なんてないよ。 :(</td></tr>";
                        } else {
                            echo <<<HTML
                                <thead>
                                    <tr>
                                        <th class="table-header" id="day">
                                            <p>日付</p>
                                        </th>
                                        <th class="table-header" id="from">
                                            <p>From.</p>
                                        </th>
                                        <th class="table-header" id="title">
                                            <p>件名</p>
                                        </th>
                                        <th class="table-header" id="__blank"></th>
                                    </tr>
                                </thead>
                                <tbody>
                            HTML;

                            foreach ($mails as $it) {
                                echo "<tr class='table-content'>";
                                foreach ($it as $key => $value) {
                                    if ($key === 'id' || $key === 'is_read') continue;
                                    if ($key === 'from_user_id') $value = getUserName($value);
                                    else if ($key === 'timestamp') $value = applyTimeFormat($value);
                                    echo "<td class='record-item'>$value</td>";
                                }
                                echo "
                                <form action='ViewMessage.php' method='POST' name='RequestOpenMail{$it['id']}'>
                                    <td class='record-item'>
                                        <input type='hidden' name='mail_id' value='{$it['id']}'>
                                        <input type='hidden' name='mail[time]' value='{$it['timestamp']}'>
                                        <input type='hidden' name='mail[from_user_id]' value='{$it['from_user_id']}'>
                                        <input type='hidden' name='mail[title]' value='{$it['title']}'>
                                        <a href='javascript:document.RequestOpenMail{$it['id']}.submit()' id='open-button'>開く</a>
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
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>
</body>

</html>