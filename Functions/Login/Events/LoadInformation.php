<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//入力値受け取り
$name = $_POST['name'];
$password = $_POST['password'];

//リクエストメソッドを確認
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setError("サーバーエラーが発生しました。", "ACSystemチームまでご連絡ください。", "14M");
    return;
}

//空白文字チェック
if (isEmptyItems($name, $password)) return;

$pdo = getDatabaseConnection();

if (!$pdo) return;

$table = "users";
$nameColumn = "name";
$passwordColumn = "password";

$query = "SELECT * FROM $table WHERE $nameColumn = :nameValue AND $passwordColumn = :passwordValue";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':nameValue', $name, PDO::PARAM_STR);
$stmt->bindValue(':passwordValue', $password, PDO::PARAM_STR);
$stmt->execute();

// 結果を取得
$result = $stmt->fetch();

//一致する結果が存在するかどうか確認
if (!($result)) {
    setError("ユーザー名またはパスワードが間違っています。", "もう一度ご確認ください。", "13L");
    return;
}

//ログイン情報をセッション間で引き渡す。
login($result['id'], $result['card_id'], $result['class'], $result['name'], $result['email'], $result['role']);

setSuccess("ログインしました");
