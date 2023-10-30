<?php
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

function isLoggedIn()
{
    if (!(empty(getUUID())))
        return true;

    return false;
}

function login($uuid, $card, $name, $email, $role)
{
    setUUID($uuid);
    setUserCard($card);
    setUserName($name);
    setUserEmail($email);
    setUserRole($role);
}

function logout()
{
    unset($_SESSION['UUID']);
    unset($_SESSION['UserCard']);
    unset($_SESSION['UserName']);
    unset($_SESSION['UserEmail']);
    unset($_SESSION['UserRole']);
}

function setUUID($uuid)
{
    unset($_SESSION['UUID']);
    $_SESSION['UUID'] = $uuid;
}

function getUUID()
{
    if (!(empty($_SESSION['UUID'])))
        return $_SESSION['UUID'];

    return '';
}

function setUserCard($card)
{
    unset($_SESSION['UserCard']);
    $_SESSION['UserCard'] = $card;
}

function getUserCard()
{
    if (!(empty($_SESSION['UserCard'])))
        return $_SESSION['UserCard'];

    return '';
}

function setUserName($name)
{
    unset($_SESSION['UserName']);
    $_SESSION['UserName'] = $name;
}

function getUserName()
{
    if (!empty($_SESSION['UserName']))
        return $_SESSION['UserName'];

    return '';
}

function setUserEmail($mail)
{
    unset($_SESSION['UserEmail']);
    $_SESSION['UserEmail'] = $mail;
}

function getUserEmail()
{
    if (!empty($_SESSION['UserEmail']))
        return $_SESSION['UserEmail'];

    return '';
}

function setUserRole($role)
{
    unset($_SESSION['UserRole']);
    $_SESSION['UserRole'] = $role;
}

function getUserRole()
{
    if (!empty($_SESSION['UserRole']))
        return $_SESSION['UserRole'];

    return '';
}
