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
$name = $_POST['name'];
$password = $_POST['password'];

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");
    header('Location:../LoadInformationError.php');
    return;
}

//リクエストメソッドを確認
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setError("サーバーエラーが発生しました。", "ACSystemチームまでご連絡ください。", "14M_");
    return;
}

//空白文字チェック
if (empty($name) || empty($password)) {
    setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_");
    return;
}

//DB接続 try catch(e) -> エラー出力
try {
    $pdo = new PDO($dsn, $mysql_user, $mysql_password);

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

    //一致する結果が存在するかどうか確認
    if (!($result)) {
        $pdo = null;
        setError("ユーザー名またはパスワードが間違っています。", "もう一度ご確認ください。", "13L_");
        return;
    }

    //ログイン情報をセッション間で引き渡す。
    login($result['id'], $result['card_id'], $result['name'], $result['email'], $result['role']);

    header('Location:../LoadInformationSuccess.html');

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
    echo $e;
    return;
}
