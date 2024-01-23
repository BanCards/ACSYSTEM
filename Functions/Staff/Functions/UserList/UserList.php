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

$users = getAllUserList();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - User List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/UsersList.css">
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
                        if (empty($users)) {
                            echo "<tr class='not-attend-record'><td>情報なんてないよ。 :(</td></tr>";
                        } else {
                            echo <<<HTML
                                <thead>
                                    <tr>
                                        <th class="table-header" id="user_card_id">
                                            <p>カード情報</p>
                                        </th>
                                        <th class="table-header" id="user_class">
                                            <p>クラス</p>
                                        </th>
                                        <th class="table-header" id="user_name">
                                            <p>名前</p>
                                        </th>
                                        <th class="table-header" id="user_email">
                                            <p>メードアドレス</p>
                                        </th>
                                        <th class="table-header" id="user_role">
                                            <p>権限</p>
                                        </th>
                                        <th class="table-header" id="__blank"></th>
                                    </tr>
                                </thead>
                                <tbody>
                            HTML;

                            foreach ($users as $user) {
                                echo "<tr class='table-content'>";
                                foreach ($user as $key => $value) {
                                    if ($key == 'id' || $key == 'password') continue;
                                    echo "<td class='record-item'>$value</td>";
                                }
                                echo "
                                <form action='../UserProfile/UserProfile.php' method='POST' name='SendUserForm{$user['id']}'>
                                    <td class='record-item'>
                                        <input type='hidden' name='uuid' value='{$user['id']}'>
                                        <a href='javascript:SendUserForm{$user['id']}.submit()' class='detail-button'>詳細</a>
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

    <div class="pop"></div>

    <script src="../../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../../JavaScript/PopUp.js"></script>
</body>

</html>