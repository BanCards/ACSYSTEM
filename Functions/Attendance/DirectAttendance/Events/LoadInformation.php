<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$cardID = $_POST['cardID'];

$user = getUserByCardID($cardID);
if (!$user) {
    setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U");
    return;
}

if (isAttended($user['id'])) {
    setError("本日は出席済みです。", "出席回数は一日一回のみです。", "13AT");
    return;
}

$timestamp = getCurrentTime();
$status = "attend";
$comment = "カードによる出席";

addUserRecord($user['id'], $timestamp, $status, $comment);