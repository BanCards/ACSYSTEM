<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$user_id = getLoginUUID();
$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = translate($_POST['reason']);

addUserRecord($user_id, $timestamp, $status, $comment);
