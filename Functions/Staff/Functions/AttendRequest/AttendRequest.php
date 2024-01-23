<?php
include('../../../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

if (!(hasPermission(getLoginUUID()))) {
    setError("権限がありません。", "もう一度ご確認ください。", "12P");
    return;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Attend Request</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/AttendRequest.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">

                <h1 class="userslist-title">ユーザーリスト</h1>

                <div class="userslist-items">
                    <table class="userslist-item">
                        <?php
                        if (getAllRequest() == null) {
                            echo "<tr class='not-attend-record'><td>リクエストなんてないよ。 :(</td></tr>";
                        } else {
                            echo <<<HTML
                                <thead>
                                    <tr>
                                        <th class="table-header" id="timestamp">
                                            <p>日時</p>
                                        </th>
                                        <th class="table-header" id="user_class">
                                            <p>クラス</p>
                                        </th>
                                        <th class="table-header" id="user_name">
                                            <p>名前</p>
                                        </th>
                                        <th class="table-header" id="user_status">
                                            <p>状態</p>
                                        </th>
                                        <th class="table-header" id="status_reason">
                                            <p>理由</p>
                                        </th>
                                        <th class="table-header" id="allow">
                                            <p>許可</p>
                                        </th>
                                        <th class="table-header" id="deny">
                                            <p>拒否</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                            HTML;

                            foreach (getAllRequest() as $request) {
                                echo "<tr class='table-content'>";
                                echo "<td class='record-item'>" . applyTimeFormat($request['timestamp']) . "</td>";
                                echo "<td class='record-item'>" . getUserClass($request['user_id']) . "</td>";
                                echo "<td class='record-item'>" . getUserName($request['user_id']) . "</td>";
                                echo "<td class='record-item'>" . translate($request['status']) . "</td>";
                                echo "<td class='record-item'>" . translate($request['comment']) . "</td>";
                                echo "<td class='record-item allow'> 許可 </td>";
                                echo "<td class='record-item deny'> 拒否 </td>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="back-to-index">
                <a href="../../Index.php"><button type="button" class="b">戻る</button></a>
            </div>
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="../../../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../../../JavaScript/PopUp.js"></script>
</body>

</html>