<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

//TODO(申請処理)
if (isAttended(getLoginUUID())) {
    setError("本日は出席済みです。", "出席回数は一日一回のみです。", "13AT");
    return;
}

$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = translate($_POST['reason']);

addUserRecord(getLoginUUID(), $timestamp, $status, $comment);