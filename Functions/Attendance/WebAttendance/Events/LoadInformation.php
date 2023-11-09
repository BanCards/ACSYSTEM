<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    Error("情報エラー", "ログインしてください。", "13L_");
    return;
}

//値
$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = translate($_POST['reason']);

$pdo = getDatabaseConnection();

if ($pdo == null) return;

$uuid = getUUID();

$query = "SELECT id FROM users WHERE id = :uuid";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':uuid', $uuid, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $insertQuery = "INSERT INTO attendance (user_id, timestamp, status, comment) VALUES (:uuid, :timestamp, :status, :comment)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':uuid', $uuid, PDO::PARAM_INT);
    $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);


    if ($stmt->execute()) {
        Success("処理が完了しました");
        return;
    } else {
        Error("実行中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
        return;
    }
} else {
    Error("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U_");
    return;
}
