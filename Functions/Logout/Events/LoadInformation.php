<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

//セッション間でエラー系の情報引き渡す
function setError($errorTitle, $errorMessage, $errorCode)
{
    $_SESSION['errorTitle'] = $errorTitle;
    $_SESSION['errorMessage'] = $errorMessage;
    $_SESSION['errorCode'] = "エラーコード : " . $errorCode . date("ymdis");
    header('Location:../LoadInformationError.php');
    return;
}

//引数の値がnullならsetError()を行う。　存在するならfalseを返す。
function isEmpty($value)
{
    if (empty($value)) {
        setError("ログイン情報エラー", "ログインしてください。", "12A_");
        return true;
    }

    return false;
}

if (!isEmpty(getUUID()) || !isEmpty(getUserCard()) || !isEmpty(getUserName()) || !isEmpty(getUserRole())) {

    unset($_SESSION['UUID']);
    unset($_SESSION['UserCard']);
    unset($_SESSION['UserName']);
    unset($_SESSION['UserRole']);

    header('Location:../LoadInformationSuccess.html');
}

?>