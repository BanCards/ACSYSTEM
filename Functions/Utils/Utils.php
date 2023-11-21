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
        setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C");
        error_log("ACSystem Error : " . $e->getMessage());

        return null;
    }
}

function isLoggedIn()
{
    if (empty(getUUID())) {
        setError("ログイン情報エラー", "ログインしてください。", "12A");
        return false;
    }

    return true;
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

function getUser($uuid)
{
    $pdo = getDatabaseConnection();

    try {
        $query = "SELECT * FROM users WHERE id = :uuid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':uuid', $uuid, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            setError("ユーザーが見つかりませんでした。", "ACSystemチームまでご連絡ください。", "20D");
            return null;
        }

        return $user;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

function setUUID($uuid)
{
    unset($_SESSION['UUID']);
    $_SESSION['UUID'] = $uuid;
}

function getUUID()
{
    return !empty($_SESSION['UUID']) ? $_SESSION['UUID'] : '';
}

function setUserCard($card)
{
    unset($_SESSION['UserCard']);
    $_SESSION['UserCard'] = $card;
}

function getUserCard()
{
    return !empty($_SESSION['UserCard']) ? $_SESSION['UserCard'] : '';
}

function setUserClass($class)
{
    unset($_SESSION['UserClass']);
    $_SESSION['UserClass'] = $class;
}

function getUserClass()
{
    return !empty($_SESSION['UserClass']) ? $_SESSION['UserClass'] : '';
}

function setUserName($name)
{
    unset($_SESSION['UserName']);
    $_SESSION['UserName'] = $name;
}

function getUserName()
{
    return !empty($_SESSION['UserName']) ? $_SESSION['UserName'] : '';
}

function setUserEmail($mail)
{
    unset($_SESSION['UserEmail']);
    $_SESSION['UserEmail'] = $mail;
}

function getUserEmail()
{
    return !empty($_SESSION['UserEmail']) ? $_SESSION['UserEmail'] : '';
}

function setUserRole($role)
{
    unset($_SESSION['UserRole']);
    $_SESSION['UserRole'] = $role;
}

function getUserRole()
{
    return !empty($_SESSION['UserRole']) ? $_SESSION['UserRole'] : '';
}

function hasPermission()
{
    $perms = ['teacher', 'admin'];

    if (!in_array(getUserRole(), $perms)) {
        setError("権限がありません。", "もう一度ご確認ください。", "12P");
        return false;
    }

    return true;
}

function getAllUserList()
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return;

    try {
        $query = "SELECT * FROM users";
        $statement = $pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

function uploadUser($user)
{
    unset($_SESSION['UserInformation']);
    $_SESSION['UserInformation'] = $user;
}

function getUserRecord($uuid)
{
    $pdo = getDatabaseConnection();

    try {
        $user_id = $uuid;

        $query = "SELECT id, timestamp, status, comment FROM attendance WHERE user_id = :user_id ORDER BY timestamp DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

function getUserAttendRecords()
{
    return !empty($_SESSION['UserAttendRecord']) ? $_SESSION['UserAttendRecord'] : '';
}

function getCurrentTime()
{
    $timezone = new DateTimeZone('Asia/Tokyo');
    $now = new DateTime('now', $timezone);

    return $now->format("Y-m-d H:i:s");
}

function setSuccess($title)
{
    $_SESSION['SuccessTitle'] = $title;
    header('Location:/ACSystem/Functions/Response/LoadInformationSuccess.php');
    return;
}

function getSuccess()
{
    return !empty($_SESSION['SuccessTitle']) ? $_SESSION['SuccessTitle'] : '';
}

function setError($title, $message, $code)
{
    $time = DateTime::createFromFormat("Y-m-d H:i:s", getCurrentTime())->format("YmdHis");

    $_SESSION['ErrorTitle'] = $title;
    $_SESSION['ErrorMessage'] = $message;
    $_SESSION['ErrorCode'] = "エラーコード : " . $code . "_" . $time;
    header('Location:/ACSystem/Functions/Response/LoadInformationError.php');
    return;
}

function getError($type)
{
    $types = ['title', 'message', 'code'];

    if (!in_array($type, $types)) {
        setError("セッションエラーが発生しました", "ACSystemチームまでご連絡ください。", "14S");
        return false;
    }

    return !empty($_SESSION['Error' . ucfirst($type)]) ? $_SESSION['Error' . ucfirst($type)] : '';
}

function isEmptyItems(...$items)
{
    foreach ($items as $it) {
        if (empty($it)) {
            setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I");
            return true;
        }
    }

    return false;
}

function isJapanese($str)
{
    return preg_match('/\p{Script=Hiragana}|\p{Script=Katakana}|\p{Script=Han}/u', $str);
}

function translate($item)
{
    if (isJapanese($item)) return $item;

    $translations = [
        'student' => '学生',
        'teacher' => '教員',
        'admin' => '管理者',
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
