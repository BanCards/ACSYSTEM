<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if(!isLoggedIn()) return;

isEmptyItems($_SESSION['contactTitle'], $_SESSION['contactContents']);

$time = DateTime::createFromFormat("Y-m-d H:i:s", getCurrentTime())->format("Ymd");
$file = '../Contacts/' . $time . ".txt";

$title =  $_SESSION['contactTitle'];
$messages =  $_SESSION['contactContents'];

$contents = "\n[From] " . getUserName() . " - " . getUserEmail() . "\n[Time] " . getCurrentTime() . "\n[Title] " . $title . "\n[Messages] " . $messages . "\n";

if (!file_exists('data.txt')) {
    file_put_contents($file, $contents, FILE_APPEND | LOCK_EX);
} else {
    $fp = fopen($file, 'w');
    fputs($fp, $contents);
    fclose($fp);
}

setSuccess("内容を送信しました");
