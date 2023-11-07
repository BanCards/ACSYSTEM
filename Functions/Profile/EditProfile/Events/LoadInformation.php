<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$key = str_replace('_info', '', $_SESSION['editItem']);
$value = $_POST['new-item-value'];

unset($_SESSION['editItem']);

if (empty($value)) {
    setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_");
    header("Location: ../LoadInformationError.php");
    return;
}

//card_id class name email password
if ($key == 'card') $key .= "_id";

$pdo = getDatabaseConnection();
$uuid = getUUID();

if ($pdo == null) {
    header('Location: ../../LoadInformation.php');
    return;
}

$query = "SELECT card_id, class, name, email, password FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindValue(1, $uuid, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch();

if (!$result) {
    setError("情報エラー", "ACSystemチームまでご連絡ください。", "21D_");
    return;
}

$outputs_directory = '../Outputs/';
$filename = date("Y/m/d") . "_変更履歴.txt";
$message = getUserName() . "が" . $key . "を" . $result[$key] . "から更新しました  :  " . $value;

// 既存のファイルにメッセージを追加
if (file_exists($filename)) {
    $existing_data = file_get_contents($filename);
    $existing_data .= "\n" . $message;
} else {
    $existing_data = $message;
}

file_put_contents($filename, $existing_data);

header("Location: http://localhost/ACSystem/Functions/Profile/EditProfile/SelectEditItem.php");
