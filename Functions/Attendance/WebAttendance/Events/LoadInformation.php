<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//DB
$hostname = "localhost";
$database = "acsystem";
$mysql_user = "root";
$mysql_password = '';
$dsn = "mysql:dbname=$database;host=$hostname;";

if (!(isLoggedIn())) {
    setError("情報エラー", "ログインしてください。", "13L_");
    header("Location: ../../LoadInformationError.php");
}

//DB接続 try catch(e) -> エラー出力
try {
    $pdo = new PDO($dsn, $mysql_user, $mysql_password);

    $uuid = getUUID();

    $sql = "SELECT id FROM users WHERE id = :uuid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':uuid', $uuid, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $timestamp = getCurrentTime();
        $status = $_POST['status'];
        $comment = $_POST['comment'];

        $insertQuery = "INSERT INTO attendance (user_id, timestamp, status, comment) VALUES (:uuid, :timestamp, :status, :comment)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_INT);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);


        if ($stmt->execute()) {
            $pdo = null;
            header("Location: ../../LoadInformationSuccess.php");
            return;
        } else {
            $pdo = null;
            setError("実行中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
            header("Location: ../../LoadInformationError.php");
            return;
        }
    } else {
        $pdo = null;
        setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U_");
        header("Location: ../../LoadInformationError.php");
        return;
    }

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
    header("Location: ../../LoadInformationError.php");
    return;
}
