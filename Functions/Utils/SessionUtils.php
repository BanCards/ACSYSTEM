<?php

/**
 * ログイン状態か判断する関数
 *
 * @return boolean
 */
function isLoggedIn(): bool
{
    return !empty(getLoginUUID());
}

/**
 * 引数をセッションに渡し、ログイン状態にする関数
 *
 * @param UUID $uuid
 * @param int $card
 * @param string $class
 * @param string $name
 * @param string $email
 * @param string $role
 * @return void
 */
function login($uuid, $card, $class, $name, $email, $role): void
{
    setLoginUUID($uuid);
    setLoginUserCard($card);
    setLoginUserClass($class);
    setLoginUserName($name);
    setLoginUserEmail($email);
    setLoginUserRole($role);

    return;
}

/**
 * セッション変数の中身をからにし、ログアウト状態にする関数
 *
 * @return void
 */
function logout(): void
{
    unset($_SESSION['UUID']);
    unset($_SESSION['UserCard']);
    unset($_SESSION['UserClass']);
    unset($_SESSION['UserName']);
    unset($_SESSION['UserEmail']);
    unset($_SESSION['UserRole']);

    return;
}

/**
 * UUIDのセッション変数のセッター関数
 *
 * @param UUID $uuid
 * @return void
 */
function setLoginUUID($uuid): void
{
    unset($_SESSION['UUID']);
    $_SESSION['UUID'] = $uuid;

    return;
}

/**
 * UUIDのセッション変数のゲッター関数
 *
 * @return UUID
 */
function getLoginUUID(): string
{
    return !empty($_SESSION['UUID']) ? $_SESSION['UUID'] : '';
}

/**
 * UserCardのセッション変数のセッター関数
 *
 * @param string $card
 * @return void
 */
function setLoginUserCard($card): void
{
    unset($_SESSION['UserCard']);
    $_SESSION['UserCard'] = $card;

    return;
}

/**
 * UserCardのセッション変数のゲッター関数
 *
 * @return string
 */
function getLoginUserCard(): string
{
    return !empty($_SESSION['UserCard']) ? $_SESSION['UserCard'] : '';
}

/**
 * UserClassのセッション変数のセッター関数
 *
 * @param string $class
 * @return void
 */
function setLoginUserClass($class): void
{
    unset($_SESSION['UserClass']);
    $_SESSION['UserClass'] = $class;

    return;
}

/**
 * UserClassのセッション変数のゲッター関数
 *
 * @return string
 */
function getLoginUserClass(): string
{
    return !empty($_SESSION['UserClass']) ? $_SESSION['UserClass'] : '';
}

/**
 * UserNameのセッション変数のセッター関数
 *
 * @param string $name
 * @return void
 */
function setLoginUserName($name): void
{
    unset($_SESSION['UserName']);
    $_SESSION['UserName'] = $name;

    return;
}

/**
 * UserNameのセッション変数のゲッター関数
 *
 * @return string
 */
function getLoginUserName(): string
{
    return !empty($_SESSION['UserName']) ? $_SESSION['UserName'] : '';
}

/**
 * UserEmailのセッション変数のセッター関数
 *
 * @param string $mail
 * @return void
 */
function setLoginUserEmail($mail): void
{
    unset($_SESSION['UserEmail']);
    $_SESSION['UserEmail'] = $mail;

    return;
}

/**
 * UserEmailのセッション変数のゲッター関数
 *
 * @return string
 */
function getLoginUserEmail(): string
{
    return !empty($_SESSION['UserEmail']) ? $_SESSION['UserEmail'] : '';
}

/**
 * UserRoleのセッション変数のセッター関数
 *
 * @param string $role
 * @return void
 */
function setLoginUserRole($role): void
{
    unset($_SESSION['UserRole']);
    $_SESSION['UserRole'] = $role;

    return;
}

/**
 * UserRoleのセッション変数のゲッター関数
 *
 * @return string
 */
function getLoginUserRole(): string
{
    return !empty($_SESSION['UserRole']) ? $_SESSION['UserRole'] : '';
}

/**
 * 成功関数
 *
 * @param string $title
 * @return void
 */
function setSuccess($title): void
{
    $_SESSION['SuccessTitle'] = $title;
    header('Location:/ACSystem/Functions/Response/LoadInformationSuccess.php');

    return;
}

/**
 * 成功時のタイトルを取得する関数
 *
 * @return string
 */
function getSuccess(): string
{
    return !empty($_SESSION['SuccessTitle']) ? $_SESSION['SuccessTitle'] : '';
}

/**
 * 失敗関数
 *
 * @param string $title
 * @param string $message
 * @param string $code
 * @return void
 */
function setError($title, $message, $code): void
{
    $time = DateTime::createFromFormat("Y-m-d H:i:s", getCurrentTime())->format("YmdHis");

    $_SESSION['ErrorTitle'] = $title;
    $_SESSION['ErrorMessage'] = $message;
    $_SESSION['ErrorCode'] = "エラーコード : " . $code . "_" . $time;
    header('Location:/ACSystem/Functions/Response/LoadInformationError.php');

    return;
}

/**
 * 失敗時のアイテムを取得する関数
 *
 * @param string $type
 * @return string
 */
function getError($type): string
{
    $types = ['title', 'message', 'code'];

    if (!in_array($type, $types)) {
        setError("セッションエラーが発生しました", "ACSystemチームまでご連絡ください。", "14S");
        return false;
    }

    return !empty($_SESSION['Error' . ucfirst($type)]) ? $_SESSION['Error' . ucfirst($type)] : '';
}