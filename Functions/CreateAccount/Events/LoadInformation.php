<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//入力値受け取り
$cardID = $_SESSION['cardID'];
$class = $_POST['class'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['rePassword'];

unset($_SESSION['cardID']);

/*
    重複チェック
    もしusersに$valueと重複するレコードがあるならtrueを返す
*/
function isDuplicate($pdo, $column, $value)
{
    $table = "users";
    $query = "SELECT * FROM $table WHERE $column = :value";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
}

//リクエストメソッドを確認
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setError("サーバーエラーが発生しました。", "ACSystemチームまでご連絡ください。", "14M_");
    header('Location:../LoadInformationError.php');
    return;
}

//空白文字チェック
if (empty($name) || empty($email) || empty($password)) {
    setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_");
    header('Location:../LoadInformationError.php');
    return;
}

//パスワードの長さがオバーフローするかチェック
if (mb_strlen($name) >= 32) {
    setError("名前が長すぎます。", "32字以内に収めてください。", "13LN_");
    header('Location:../LoadInformationError.php');
    return;
}

//パスワードの長さがオバーフローするかチェック
if (mb_strlen($password) >= 32) {
    setError("パスワードが長すぎます。", "32字以内に収めてください。", "13LP_");
    header('Location:../LoadInformationError.php');
    return;
}

//パスワードが一致するかチェック
if (!($password === $repassword)) {
    setError("パスワードが一致しません。", "パスワードをご確認の上、再度記入してください。", "13IP_");
    header('Location:../LoadInformationError.php');
    return;
}

$pdo = getDatabaseConnection();

if ($pdo == null) {
    header('Location:../LoadInformationError.php');
    return;
}

//カード番号重複チェック
$isDuplicateCardID = '';
$isDuplicateCardID = isDuplicate($pdo, "card_id", $cardID);
if ($isDuplicateCardID) {
    $pdo = null;
    setError("カード情報が既に登録されています。", "使用されているアカウント番号 : <strong>" . $cardID . "</strong>", "11C_");
    header('Location:../LoadInformationError.php');
    return;
}

//メールアドレス重複チェック
$isDuplicateMail = '';
$isDuplicateMail = isDuplicate($pdo, "email", $email);
if ($isDuplicateMail) {
    $pdo = null;
    setError("メールアドレスが既に登録されています。", "使用されているメールアドレス : <strong>" . $email . "</strong>", "11E_");
    header('Location:../LoadInformationError.php');
    return;
}

//正常動作
if (!$isDuplicateMail && !$isDuplicateCardID) {
    $insertQuery = "INSERT INTO `users` (`card_id`, `class`, `name`, `email`, `password`) VALUES (:cardID, :class, :name, :email, :password)";

    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindValue(':cardID', $cardID, PDO::PARAM_STR);
    $insertStmt->bindValue(':class', $class, PDO::PARAM_STR);
    $insertStmt->bindValue(':name', $name, PDO::PARAM_STR);
    $insertStmt->bindValue(':email', $email, PDO::PARAM_STR);
    $insertStmt->bindValue(':password', $password, PDO::PARAM_STR);

    if ($insertStmt->execute()) {

        // queryクエリの準備と実行
        $query = "SELECT * FROM `users` WHERE `name` = :nameValue AND `password` = :passwordValue";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':nameValue', $name, PDO::PARAM_STR);
        $stmt->bindValue(':passwordValue', $password, PDO::PARAM_STR);
        $stmt->execute();

        // 結果を取得
        $result = $stmt->fetch();

        login($result['id'], $result['card_id'], $result['class'], $result['name'], $result['email'], $result['role']);

        header('Location:../LoadInformationSuccess.php');

        return;
    } else {
        setError("ユーザーの登録中に問題が発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
        header('Location:../LoadInformationError.php');
        return;
    }
}
