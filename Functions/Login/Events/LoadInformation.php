<?php
include('../../Utils/Utils.php');

//入力値受け取り
$email = $_POST['email'];
$password = $_POST['password'];

//リクエストメソッドを確認
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setError("サーバーエラーが発生しました。", "ACSystemチームまでご連絡ください。", "14M");
    return;
}

//空白文字チェック
if (isEmptyItems($email, $password)) return;

$user = getUserByEmail($email);

if (!$user || ($user['password'] != hashingItem($password))) {
    setError("メールアドレスまたはパスワードが間違っています", "もう一度ご確認ください。", "13L");
    return;
}

//ログイン情報をセッション間で引き渡す。
login($user['id'], $user['card_id'], $user['class'], $user['name'], $user['email'], $user['role']);

setSuccess("ログインしました");
