<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

$key = str_replace('_info', '', $_SESSION['editItem']);
$oldValue = $_POST['current-item-value'];
$newValue = $_POST['new-item-value'];

unset($_SESSION['editItem']);

if (empty($newValue) || empty($oldValue)) {
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
$stmt = $conn->prepare($query);
$stmt->bindValue(':uuid', $uuid, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch();

if (!$result) {
    setError("情報エラー", "ACSystemチームまでご連絡ください。", "21D_");

    return;
}

$outputs_directory = "../../../../Outputs/";
$filename = date("Y/m/d") . "_変更履歴.txt";
$message = getUserName() . "が" . $key . "を" . $result[$key] . "から更新しました  :  " . $newValue;

if (!is_dir($outputs_directory)) {
    mkdir($outputs_directory, 0777, true);
}


if (file_exists($txt_filename)) {
    $existing_data = file_get_contents($txt_filename);
    $existing_data .= "\n" . $message;
} else {
    $existing_data = $message;
}

file_put_contents($txt_filename, $existing_data);

header("Location: http://localhost/ACSystem/Functions/Profile/EditProfile/SelectEditItem.php");
