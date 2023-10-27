<?php

session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

function setSessionError($title, $message, $code)
{
    $_SESSION["errorTitle"] = $title;
    $_SESSION["errorMessage"] = $message;
    $_SESSION["errorCode"] = "エラーコード :" . $code . date("ymdis");
    header("Location:LoadInformationErorr.php");
}

function isSessionEmpty($value)
{
    if (empty($value)) {
        setSessionError("情報エラー", "ACSystemチームに連絡してください。", "14I_");
        return true;
    }
    return false;
}

function setUUID($uuid)
{
    unset($_SESSION['UUID']);
    $_SESSION['UUID'] = $uuid;
}

function getUUID()
{
    if (!(isSessionEmpty($_SESSION['UUID'])))
        return $_SESSION['UUID'];
}

function setUserCard($card)
{
    unset($_SESSION['UserCard']);
    $_SESSION['UserCard'] = $card;
}

function getUserCard()
{
    if (!(isSessionEmpty($_SESSION['UserCard'])))
        return $_SESSION['UserCard'];
}

function setUserName($name)
{
    unset($_SESSION['UserName']);
    $_SESSION['UserName'] = $name;
}

function getUserName()
{
    if (!isSessionEmpty($_SESSION['UserName']))
        return $_SESSION['UserName'];
}

function setUserEmail($mail)
{
    unset($_SESSION['UserEmail']);
    $_SESSION['UserEmail'] = $mail;
}

function getUserEmail()
{
    if (!isSessionEmpty($_SESSION['UserEmail']))
        return $_SESSION['UserEmail'];
}

function setUserRole($role)
{
    unset($_SESSION['UserRole']);
    $_SESSION['UserRole'] = $role;
}

function getUserRole()
{
    if (!isSessionEmpty($_SESSION['UserRole']))
        return $_SESSION['UserRole'];
}

?>