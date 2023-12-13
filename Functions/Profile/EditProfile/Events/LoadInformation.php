<?php
include('../../../Utils/Utils.php');

$key = str_replace('_info', '', $_SESSION['editItem']);
$value = $_POST['new-item-value'];

unset($_SESSION['editItem']);

if (isEmptyItems($value)) return;

$validFields = ['email', 'password'];

// $key が有効なフィールドであるか確認
if (!(in_array($key, $validFields))) {
    setError("無効なフィールド", "指定されたフィールドは更新できません。", "22D");
    return;
}

$pdo = getDatabaseConnection();
$uuid = getLoginUUID();

if ($key == 'email') {
    if (getUserEmail($uuid) == $value) {
        setError("同一の値です。", "同じ値を登録することはできません。", "13SP");
        return;
    }

    if (isDuplicatedRecord("users", "email", $value)) {
        setError("メールアドレスが既に登録されています。", "使用されているメールアドレス : <strong>" . $email . "</strong>", "11E");
        return;
    }
}

if ($key == "password") {
    $currentPassword =  $_POST['current-item-value'];
    $currentPassword = md5($currentPassword);

    if (isEmptyItems($currentPassword)) return;
    if ($currentPassword == md5($value)) {
        setError("同一の値です。", "同じ値を登録することはできません。", "13SP");
        return;
    }

    $selectQuery = "SELECT * FROM users WHERE id = :uuid";
    $selectStmt = $pdo->prepare($selectQuery);
    $selectStmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
    $selectStmt->execute();

    $result = $selectStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['password'] != $currentPassword) {
        setError("現在のパスワードが一致しません。", "パスワードをご確認の上、再度記入してください。", "13IP");
        return;
    }
}

$updateQuery = "UPDATE users SET $key = :value WHERE id = :uuid";
$updateStmt = $pdo->prepare($updateQuery);
if ($key == "password") $value = md5($value);
$updateStmt->bindValue(':value', $value, PDO::PARAM_STR);
$updateStmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);

if ($updateStmt->execute()) {

    $selectQuery = "SELECT * FROM users WHERE id = :uuid";
    $selectStmt = $pdo->prepare($selectQuery);
    $selectStmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
    $selectStmt->execute();

    $result = $selectStmt->fetch(PDO::FETCH_ASSOC);

    logout();
    login($result['id'], $result['card_id'], $result['class'], $result['name'], $result['email'], $result['role']);

    $mail_title = "アカウント情報の更新が完了しました";
    $mail_message = "
    こんにちは {$result['name']} 様,

    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。

    アカウント情報の変更が正常に完了しました。
    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。

    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。

    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。

    どうぞよろしくお願いいたします。



    ACSystem Teamより";

    sendMail(1, $result['id'], $mail_title, $mail_message);

    setSuccess("値を更新しました");
    return;
} else {
    setError("情報更新エラー", "情報を更新できませんでした。", "22D");
    return;
}
