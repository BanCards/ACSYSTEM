<?php
include('../../../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = translate($_POST['reason']);

if(!(isRequesting(getLoginUUID()))) {
    registerAttend(getLoginUUID(), 1, $timestamp, $status, $comment);
} else {
    setError("現在申請中のレコードがあります","ご不明な点はコンタクトにて受け付けております。","13RR");
}