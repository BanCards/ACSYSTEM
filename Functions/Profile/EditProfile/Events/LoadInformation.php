<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$key = str_replace('_info', '', $_SESSION['editItem']);
$value = $_POST['new-item-value'];

unset($_SESSION['editItem']);

if (empty($value)) {
    Error("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_");
    return;
}

$validFields = ['card_id', 'class', 'name', 'email', 'password'];

// $key が有効なフィールドであるか確認
if (!(in_array($key, $validFields))) {
    Error("無効なフィールド", "指定されたフィールドは更新できません。", "22D_");
    return;
}
$pdo = getDatabaseConnection();
$uuid = getUUID();

if ($pdo == null) return;

$updateQuery = "UPDATE users SET $key = :value WHERE id = :uuid";
$updateStmt = $pdo->prepare($updateQuery);
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

    Success("値を更新しました");
    return;
} else {
    Error("情報更新エラー", "情報を更新できませんでした。", "22D_");
    return;
}
