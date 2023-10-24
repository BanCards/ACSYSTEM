<?php
session_start();

//DB
$hostname = "localhost";
$database = "acsystem";
$mysql_user = "root";
$mysql_password = '';
$dsn = "mysql:dbname=$database;host=$hostname;";

//入力値受け取り
$name = $_POST['name'];
$password = $_POST['password'];

//日時
$date = date("ymdis");

//////////////////////////////// 重要 ////////////////////////////////
//ログイン情報を最初に初期化し、初期値のままロードされるときログインを失敗した結果にする
unset($_SESSION['UUID']);
unset($_SESSION['UserCard']);
unset($_SESSION['UserName']);
unset($_SESSION['UserEmail']);
unset($_SESSION['UserRole']);
//////////////////////////////////////////////////////////////////////

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode;
    header('Location:../LoginInvalid.php');
    return;
}

//リクエストメソッドを確認
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setError("サーバーエラーが発生しました。", "ACSystemチームまでご連絡ください。", "14M_" . $date);
    return;
}

//空白文字チェック
if (empty($name) || empty($password)) {
    setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I_" . $date);
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
    if (!($result ? true : false)) {
        $pdo = null;
        setError("ユーザー名またはパスワードが間違っています。", "もう一度ご確認ください。", "13L_" . $date);
        return;
    }

    //ログイン情報をセッション間で引き渡す。
    $_SESSION['UUID'] = $result['id'];
    $_SESSION['UserCard'] = $result['card_id'];
    $_SESSION['UserName'] = $result['name'];
    $_SESSION['UserEmail'] = $result['email'];
    $_SESSION['UserRole'] = $result['role'];

    header('Location:../LoginSuccess.html');

    //DBに接続できない時の処理
} catch (PDOException $e) {
    $pdo = null;
    setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_" . $date);
    echo $e;
    return;
}
?>