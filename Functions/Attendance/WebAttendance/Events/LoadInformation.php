<?php
include('../../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}

if (isAttended(getLoginUUID())) {
    setError("本日は出席済みです。", "出席回数は一日一回のみです。", "13AT");
    return;
}

$timestamp = getCurrentTime();
$status = $_POST['status'];
$comment = translate($_POST['reason']);

registerAttend(getLoginUUID(), 1, $timestamp, $status, $comment);
