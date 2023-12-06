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

if (isEmptyItems($name, $email, $password)) return;

if (mb_strlen($name) > 32) {
    setError("名前が長すぎます。", "32字以内に収めてください。", "13LN");
    return;
}

if (mb_strlen($password) > 32) {
    setError("パスワードが長すぎます。", "32字以内に収めてください。", "13LP");
    return;
}

if (!($password === $repassword)) {
    setError("パスワードが一致しません。", "パスワードをご確認の上、再度記入してください。", "13IP");
    return;
}

if (isDuplicatedRecord("users", "card_id", $cardID)) {
    setError("カード情報が既に登録されています。", "使用されているアカウント番号 : <strong>" . $cardID . "</strong>", "11C");
    return;
}

if (isDuplicatedRecord("users", "email", $email)) {
    setError("メールアドレスが既に登録されています。", "使用されているメールアドレス : <strong>" . $email . "</strong>", "11E");
    return;
}

$res = createAccount($cardID, $class, $name, $email, $password);

if ($res) {

    $user = getUserByCardID($cardID);

    login($user['id'], $user['card_id'], $user['class'], $user['name'], $user['email'], $user['role']);

    $mail_title = "アカウント作成のご完了お知らせ";
    $mail_message =
        "こんにちは {$user['name']} 様,

            ACSystem をご利用いただきありがとうございます！アカウントの作成が正常に完了しました。
            以下は、ご登録いただいたアカウント情報です。

            ユーザー名: {$user['name']}
            メールアドレス: {$user['email']}
            安心してご利用いただくために、以下の点にご留意いただきますようお願い申し上げます。

            パスワードの安全性を確保するため、定期的に変更を行ってください。
            ログイン情報は第三者に漏れないようにご注意ください。
            ご不明点やお困りごとがありましたら、いつでも運営までお気軽にお問い合わせください。

            それでは、ACSystem の利用をお楽しみください！何かご質問やご要望がございましたら、お気軽にお知らせください。



            ACSystem Teamより";

    sendMail(1, $user['id'], $mail_title, $mail_message);

    setSuccess("ユーザーが登録されました");
    return;
} else {
    setError("ユーザーの登録中に問題が発生しました。", "ACSystemチームまでご連絡ください。", "13CA");
    return;
}
