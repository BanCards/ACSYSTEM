<?php
session_start();

//日時
$date = date("ymdis");

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode;
    header('Location:../LogoutInvalid.php');
    return;
}

if (empty($_SESSION['UUID']) || empty($_SESSION['UserCard']) || empty($_SESSION['UserName']) || empty($_SESSION['UserRole'])) {
    setError("ログイン情報を取得できませんでした", "ACSystemチームまでご連絡ください。", "13L_" . $date);
    return;
}

unset($_SESSION['UUID']);
unset($_SESSION['UserCard']);
unset($_SESSION['UserName']);
unset($_SESSION['UserRole']);

header('Location:../LogoutSuccess.html');

?>