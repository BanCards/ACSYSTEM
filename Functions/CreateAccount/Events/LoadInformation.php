<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//DB
$hostname = "localhost";
$database = "acsystem";
$mysql_user = "root";
$mysql_password = '';
$dsn = "mysql:dbname=$database;host=$hostname;";

//入力値受け取り
$cardID = $_SESSION["cardID"];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['rePassword'];

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");;
    header('Location:../LoadInformationError.php');
    return;
}

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
    return;
}

//空白文字チェック
if (empty($name) || empty($email) || empty($password)) {
    setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_");
    return;
}

//パスワードの長さがオバーフローするかチェック
if (mb_strlen($name) >= 32) {
    setError("名前が長すぎます。", "32字以内に収めてください。", "13LN_");
    return;
}

//パスワードの長さがオバーフローするかチェック
if (mb_strlen($password) >= 32) {
    setError("パスワードが長すぎます。", "32字以内に収めてください。", "13LP_");
    return;
}

//パスワードが一致するかチェック
if (!($password === $repassword)) {
    setError("パスワードが一致しません。", "パスワードをご確認の上、再度記入してください。", "13IP_");
    return;
}

//DB接続 try catch(e) -> エラー出力
try {
    $pdo = new PDO($dsn, $mysql_user, $mysql_password);

    //カード番号重複チェック
    $isDuplicateCardID = '';
    $isDuplicateCardID = isDuplicate($pdo, "card_id", $cardID);
    if ($isDuplicateCardID) {
        $pdo = null;
        setError("カード情報が既に登録されています。", "使用されているアカウント番号 : <strong>" . $cardID . "</strong>", "11C_");
        return;
    }

    //メールアドレス重複チェック
    $isDuplicateMail = '';
    $isDuplicateMail = isDuplicate($pdo, "email", $email);
    if ($isDuplicateMail) {
        $pdo = null;
        setError("メールアドレスが既に登録されています。", "使用されているメールアドレス : <strong>" . $email . "</strong>", "11E_");
        return;
    }

    //正常動作
    if (!$isDuplicateMail && !$isDuplicateCardID) {
        $insertQuery = "INSERT INTO `users` (`id`, `card_id`, `name`, `email`, `password`) VALUES (NULL, :cardID, :name, :email, :password)";

        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->bindValue(':cardID', $cardID, PDO::PARAM_STR);
        $insertStmt->bindValue(':name', $name, PDO::PARAM_STR);
        $insertStmt->bindValue(':email', $email, PDO::PARAM_STR);
        $insertStmt->bindValue(':password', $password, PDO::PARAM_STR);

        if ($insertStmt->execute()) {

            $table = "users";
            $nameColumn = "name";
            $passwordColumn = "password";

            // SQLクエリの準備と実行
            $query = "SELECT * FROM $table WHERE $nameColumn = :nameValue AND $passwordColumn = :passwordValue";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':nameValue', $name, PDO::PARAM_STR);
            $stmt->bindValue(':passwordValue', $password, PDO::PARAM_STR);
            $stmt->execute();

            // 結果を取得
            $result = $stmt->fetch();

            //ログイン情報をセッション間で引き渡す。
            setUUID($result['id']);
            setUserCard($result['card_id']);
            setUserName($result['name']);
            setUserEmail($result['email']);
            setUserRole($result['role']);

            unset($_SESSION['cardID']);

            $pdo = null;
            header('Location:../LoadInformationSuccess.php');

            return;
        } else {
            $pdo = null;
            setError("ユーザーの登録中に問題が発生しました。", "ACSystemチームまでご連絡ください。", "13CA_");
            return;
        }
    }

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
    return;
}
