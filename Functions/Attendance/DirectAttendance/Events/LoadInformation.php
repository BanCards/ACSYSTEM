<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//DB
$hostname = "localhost";
$database = "acsystem";
$mysql_user = "root";
$mysql_password = '';
$dsn = "mysql:dbname=$database;host=$hostname;";

function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");
    header('../../Location:LoadInformationError.php');
    return;
}

$cardID = $_POST['cardID'];

//DB接続 try catch(e) -> エラー出力
try {
    $pdo = new PDO($dsn, $mysql_user, $mysql_password);

    $sql = "SELECT id FROM users WHERE card_id = :cardID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cardID', $cardID, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $uuid = $result['id'];
        $timestamp = getCurrentTime();
        $status = "attend";
        $comment = "カードによる出席";

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
            setError("ユーザーの登録中に問題が発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
            return;
        }
    } else {
        $pdo = null;
        setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "13U_");
        return;
    }

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
    return;
}
