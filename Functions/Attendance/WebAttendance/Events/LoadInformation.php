<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("情報エラー", "ログインしてください。", "13L_");
    header("Location: ../../LoadInformationError.php");
}

//値
$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = $_POST['comment'];

$pdo = getDatabaseConnection();

if ($pdo == null) {
    header("Location: ../../LoadInformationError.php");
    return;
}

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
        header("Location: ../../LoadInformationSuccess.php");
        return;
    } else {
        setError("実行中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
        header("Location: ../../LoadInformationError.php");
        return;
    }
} else {
    setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U_");
    header("Location: ../../LoadInformationError.php");
    return;
}
