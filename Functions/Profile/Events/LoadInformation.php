<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$pdo = getDatabaseConnection();

if ($pdo == null) return;

$user_id = getUUID();
$table = "attendance";
$idColumn = "card_id";

$query = "SELECT timestamp, status, comment FROM attendance WHERE user_id = :user_id ORDER BY timestamp DESC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;

uploadUserAttendRecords($result);
header('Location:../Record.php');

return;
