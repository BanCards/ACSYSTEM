<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$cardID = $_POST['cardID'];

$pdo = getDatabaseConnection();
if (!$pdo) {
    header("Location:../../LoadInformationError.php");
    return;
}

$query = "SELECT id FROM users WHERE card_id = :cardID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':cardID', $cardID, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$pdo = null;

if ($result) {
    $user_id = $result['id'];
    $timestamp = getCurrentTime();
    $status = "attend";
    $comment = "カードによる出席";

    setUserRecord($user_id, $timestamp, $status, $comment);
} else {
    setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U");
    return;
}
