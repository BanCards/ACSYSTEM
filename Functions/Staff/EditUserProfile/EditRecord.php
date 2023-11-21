<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!isLoggedIn()) return;
//if (!hasPermission(getUserRole())) return;

$record = $_POST['record'];

foreach($record as $it) {
    if($it !== $record['timestamp']) $it = translate($it);
    echo "{$it}<br>";
}