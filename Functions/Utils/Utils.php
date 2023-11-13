<?php
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

function sendHeaders()
{
    $status = isLoggedIn()
        ? generateListItem('logout', 'fas fa-sign-out-alt', 'ログアウト', '/ACSystem/Functions/Logout/Logout.php')
        : generateListItem('login', 'fas fa-sign-in-alt', 'ログイン', '/ACSystem/Functions/Login/Login.php');

    echo <<<HTML
        <div class="header">
            <h2>ACSYSTEM</h2>

            <nav class="navigation">
                <ul>
                    <li class="top">
                        <a href="/ACSystem/Index.php">
                            <i class="fas fa-home"></i> ホーム
                        </a>
                    </li>
                    <li class="profile">
                        <a href="/ACSystem/Functions/Profile/Profile.php">
                            <i class="fas fa-user"></i> プロフィール
                        </a>
                    </li>
                    <li class="contact">
                        <a href="/ACSystem/Functions/Contact/Contact.php">
                            <i class="fas fa-info-circle"></i> コンタクト
                        </a>
                    </li>
                    <li class="help">
                        <a href="#">
                            <i class="fas fa-question-circle"></i> ヘルプ
                        </a>
                    </li>
                    {$status}
                </ul>
            </nav>
        </div>
    HTML;
}

function generateListItem($class, $icon, $text, $link)
{
    return <<<HTML
        <li class="$class">
            <a href="$link">
                <i class="$icon"></i> $text
            </a>
        </li>
    HTML;
}

function getDatabaseConnection()
{
    $hostname = "localhost";
    $database = "acsystem";
    $mysql_user = "root";
    $mysql_password = '';
    $dsn = "mysql:dbname=$database;host=$hostname;";

    try {
        $pdo = new PDO($dsn, $mysql_user, $mysql_password);

        return $pdo;
    } catch (PDOException $e) {
        Error("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C_");
        error_log("ACSystem Error : " . $e->getMessage());

        return null;
    }
}

function isLoggedIn()
{
    return !empty(getUUID());
}


function login($uuid, $card, $class, $name, $email, $role)
{
    setUUID($uuid);
    setUserCard($card);
    setUserClass($class);
    setUserName($name);
    setUserEmail($email);
    setUserRole($role);
}

function logout()
{
    unset($_SESSION['UUID']);
    unset($_SESSION['UserCard']);
    unset($_SESSION['UserClass']);
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

function setUserClass($class)
{
    unset($_SESSION['UserClass']);
    $_SESSION['UserClass'] = $class;
}

function getUserClass()
{
    if (!empty($_SESSION['UserClass']))
        return $_SESSION['UserClass'];

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

function uploadUserAttendRecords($records)
{
    unset($_SESSION['UserAttendRecord']);
    $_SESSION['UserAttendRecord'] = $records;
}

function getUserAttendRecords()
{
    if (!empty($_SESSION['UserAttendRecord']))
        return $_SESSION['UserAttendRecord'];

    return '';
}

function getCurrentTime()
{
    $timezone = new DateTimeZone('Asia/Tokyo');
    $now = new DateTime('now', $timezone);

    return $now->format("Y-m-d H:i:s");
}

function Success($title)
{
    setSuccessTitle($title);
    header('Location:/ACSystem/Functions/Response/LoadInformationSuccess.php');
    return;
}

function setSuccessTitle($title)
{
    $_SESSION['SuccessTitle'] = $title;
}

function getSuccessTitle()
{
    if (!(empty($_SESSION['SuccessTitle'])))
        return $_SESSION['SuccessTitle'];

    return '';
}

function Error($title, $message, $code)
{
    setErrorTitle($title);
    setErrorMessage($message);
    setErrorCode($code);
    header('Location:/ACSystem/Functions/Response/LoadInformationError.php');
    return;
}

function setErrorTitle($title)
{
    $_SESSION['ErrorTitle'] = $title;
}

function getErrortitle()
{
    if (!(empty($_SESSION['ErrorTitle'])))
        return $_SESSION['ErrorTitle'];

    return '';
}

function setErrorMessage($message)
{
    $_SESSION['ErrorMessage'] = $message;
}

function getErrorMessage()
{
    if (!empty($_SESSION['ErrorMessage']))
        return $_SESSION['ErrorMessage'];

    return '';
}

function setErrorCode($code)
{
    $_SESSION['ErrorCode'] = "エラーコード : " . $code . date("YmdHis");
}

function getErrorCode()
{
    if (!empty($_SESSION['ErrorCode']))
        return $_SESSION['ErrorCode'];

    return '';
}

function isJapanese($str)
{
    return preg_match('/\p{Script=Hiragana}|\p{Script=Katakana}|\p{Script=Han}/u', $str);
}

function translate($item)
{
    if (isJapanese($item)) return $item;

    $translations = [
        'attend' => '出席',
        'absent' => '欠席',
        'lateness' => '遅刻',
        'leave_early' => '早退',
        'official_absence' => '公欠',
        'illness' => '病気',
        'accident' => '事故',
        'traffic_issues' => '交通の問題',
        'health_issues' => '体調不要',
        'family_matters' => '家庭の事情',
        'forgetfulness' => '忘れ物',
        'scheduled_appointment' => '必要な予定',
        'company_visit' => '企業に関する事情',
        'academic_research' => '学校行事',
        'card_id_info' => 'カード情報',
        'class_info' => 'クラス情報',
        'name_info' => '名前情報',
        'mail_info' => 'メールアドレス情報',
        'password_info' => 'パスワード情報',
    ];

    return $translations[$item] ?? '';
}
