<?php
include('../../../Utils/Utils.php');

$input_type = $_SESSION['input_type'];
unset($_SESSION['input_type']);

$validField = ['email', 'password'];
if (!(in_array($input_type, $validField))) {
    setError("無効なフィールド", "指定されたフィールドは更新できません。", "22D");
    return;
}

if ($input_type == 'email') {
    updateQuery("users", "email", $_POST['new_item'], getLoginUUID());
} else if ($input_type == 'password') {
    updateQuery("users", "password", md5($_POST['confirm_new_item']), getLoginUUID());
}

$user = getUser(getLoginUUID());
logout();
login($user['id'], $user['card_id'], $user['class'], $user['name'], $user['email'], $user['role']);

$mail_title = "アカウント情報の更新が完了しました";
$mail_message = "
    こんにちは {$user['name']} 様,

    お世話になっております。ACSystem をご利用いただき、誠にありがとうございます。お知らせがあります。

    アカウント情報の変更が正常に完了しました。
    ご自身で変更を行わなかった場合や、変更についてご質問がある場合は、直ちに運営までお知らせください。

    なお、アカウント情報の変更に関して疑問や懸念がございましたら、セキュリティを確認するためにも速やかにご対応いただくことをお勧めいたします。

    何かご質問やご不明点がございましたら、遠慮なくお知らせください。ACSystem をより快適にご利用いただけるよう、サポートチームがお手伝いさせていただきます。

    どうぞよろしくお願いいたします。



    ACSystem Teamより";

sendMail(1, $user['id'], $mail_title, $mail_message);

setSuccess("値を更新しました");
return;
