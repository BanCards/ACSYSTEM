<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

if (!isLoggedIn()) return;
//if (!hasPermission(getLoginUserRole())) return;

$record = $_POST['record'];

foreach($record as $it) {
    if($it !== $record['timestamp']) $it = translate($it);
    echo "{$it}<br>";
}

//TODO(関数追加！！！！！！！！！！)
echo getUserCard(85) . "<br>";
echo getUserEmail(85) . "<br>";
echo getUserName(85) . "<br>";
echo getUserClass(85) . "<br>";
echo getUserRole(85) . "<br>";