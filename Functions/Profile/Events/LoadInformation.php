<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//DB
$hostname = "localhost";
$database = "acsystem";
$mysql_user = "root";
$mysql_password = '';
$dsn = "mysql:dbname=$database;host=$hostname;";

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A_");
    header('../Location:LoadInformationError.php');
    return;
}

//DB接続 try catch(e) -> エラー出力
try {
    $pdo = new PDO($dsn, $mysql_user, $mysql_password);

    $user_id = getUUID();
    $table = "attendance";
    $idColumn = "card_id";

    $sql = "SELECT timestamp, status, comment FROM attendance WHERE user_id = :user_id ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;

    uploadUserAttendRecords($result);
    header('Location:../Record.php');

    return;

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
    header('../Location:LoadInformationError.php');
    return;
}
