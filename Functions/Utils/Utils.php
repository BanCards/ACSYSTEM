<?php
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

define('INDEX', '/ACSystem/Index.php');

/**
 * ヘッダーを出力する関数
 *
 * @return void
 */
function sendHeaders(): void
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
                    <li class="mail">
                        <a href="/ACSystem/Functions/Mail/Mail.php">
                            <i class="fas fa-envelope"></i> メールボックス
                        </a>
                    </li>
                    <li class="contact">
                        <a href="#">
                            <i class="fas fa-info-circle"></i> コンタクト
                        </a>
                    </li>
                    {$status}
                </ul>
            </nav>
        </div>
    HTML;
}

/**
 * ヘッダーのタグを生成する関数
 *
 * @param string $class
 * @param string $icon
 * @param string $text
 * @param string $link
 * @return string
 */
function generateListItem($class, $icon, $text, $link): string
{
    return <<<HTML
        <li class="$class">
            <a href="$link">
                <i class="$icon"></i> $text
            </a>
        </li>
    HTML;
}

/**
 * フッターを出力する関数
 *
 * @return void
 */
function sendFooters(): void
{
    echo <<<HTML
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; 2023 Attendance Check System by ACSystem Team All rights reserved.</p>
            </div>
        </div>
    HTML;
}

/**
 * データベースに接続する関数
 *
 * @return PDO
 */
function getDatabaseConnection(): PDO
{
    //starfree
    /*
    $hostname = "mysql1.php.starfree.ne.jp";
    $database = "mtdacsystem_acsystem";
    $mysql_user = "mtdacsystem_narf";
    $mysql_password = 'NNNncusp3';
    $dsn = "mysql:dbname=$database;host=$hostname;";
    */

    $hostname = "localhost";
    $database = "acsystem";
    $mysql_user = "root";
    $mysql_password = '';
    $dsn = "mysql:dbname=$database;host=$hostname;";

    try {
        $pdo = new PDO($dsn, $mysql_user, $mysql_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        setError("データベースに接続できませんでした。", "ACSystemチームまでご連絡ください。", "20C");
        error_log("ACSystem Error : " . $e->getMessage());

        return null;
    }
}

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
 * 権限を持っているかどうか判断する関数
 *
 * @param UUID $uuid
 * @return boolean
 */
function hasPermission($uuid): bool
{
    $perms = ['teacher', 'admin'];
    if (!in_array(getUserRole($uuid), $perms)) return false;

    return true;
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
 * uuidをユーザーを返す関数
 *
 * @param UUID $uuid
 * @return array|null
 */
function getUser($uuid): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

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
 * uuidと一致するユーザーのUserCardのゲッター関数
 *
 * @param UUID $uuid
 * @return string
 */
function getUserCard($uuid): string
{
    return getUser($uuid)['card_id'];
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
 * uuidと一致するユーザーのUserClassのゲッター関数
 *
 * @param UUID $uuid
 * @return string
 */
function getUserClass($uuid): string
{
    return getUser($uuid)['class'];
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
 * uuidと一致するユーザーのUserNameのゲッター関数
 *
 * @param UUID $uuid
 * @return string
 */
function getUserName($uuid): string
{
    return getUser($uuid)['name'];
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
 * uuidと一致するユーザーのUserEmailのゲッター関数
 *
 * @param UUID $uuid
 * @return string
 */
function getUserEmail($uuid): string
{
    return getUser($uuid)['email'];
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
 * uuidと一致するユーザーのUserRoleのゲッター関数
 *
 * @param UUID $uuid
 * @return string
 */
function getUserRole($uuid): string
{
    return getUser($uuid)['role'];
}

/**
 * 登録されているユーザーを全取得する関数
 *
 * @return array|null
 */
function getAllUserList(): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

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

/**
 * ユーザーのレコードを追加する関数
 *
 * @param UUID $user_id
 * @param TIMESTAMP $timestamp
 * @param string $status
 * @param string $comment
 * @return void
 */
function addUserRecord($user_id, $timestamp, $status, $comment): void
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return;

    try {
        $query = "INSERT INTO attendance (user_id, timestamp, status, comment) VALUES (:user_id, :timestamp, :status, :comment)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            setSuccess("出席処理が完了しました");
            return;
        } else {
            setError("実行中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "13CA");
            return;
        }
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return;
    }
}

/**
 * uuidと一致するユーザーのレコードを取得する関数
 *
 * @param UUID $uuid
 * @return array|null
 */
function getUserRecord($uuid): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

    try {
        $query = "SELECT id, timestamp, status, comment FROM attendance WHERE user_id = :user_id ORDER BY timestamp DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $uuid, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * uuidと一致するユーザーに届いたメールを取得する関数
 *
 * @param UUID $uuid
 * @return array|null
 */
function getMailRecord($uuid): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

    try {
        $query = "SELECT id, is_read, timestamp, from_user_id, title FROM mailbox WHERE to_user_id = :user_id ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('user_id', $uuid, PDO::FETCH_ASSOC);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20MD");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * メールidと一致するメッセージをを取得する関数
 *
 * @param UID $mail_id
 * @return array|null
 */
function getMailMessage($mail_id): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

    try {
        $query = "SELECT message FROM mailbox WHERE id = :mail_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('mail_id', $mail_id, PDO::FETCH_ASSOC);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20MD");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * 現在時刻を取得する関数
 *
 * @return string
 */
function getCurrentTime(): string
{
    $timezone = new DateTimeZone('Asia/Tokyo');
    $now = new DateTime('now', $timezone);

    return $now->format("Y-m-d H:i:s");
}

/**
 * 引数の時刻をフォーマット変換する関数
 *
 * @param string $time
 * @return void
 */
function applyTimeFormat($time)
{
    return date("n月 j日 G時 i分", strtotime($time));
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

/**
 * 引数のアイテムの中身があるかどうか判断する関数
 *
 * @param string ...$items
 * @return boolean
 */
function isEmptyItems(...$items): bool
{
    foreach ($items as $it) {
        if (empty($it)) {
            setError("記入されていない欄があります。", "もう一度記入されているか確認してください。", "12I");
            return true;
        }
    }

    return false;
}

/**
 * 日本語かどうか判断する関数
 *
 * @param string $str
 * @return boolean
 */
function isJapanese($str): bool
{
    return preg_match("/[一-龠]+|[ぁ-ん]+|[ァ-ヴー]+|[一-龠]+|[ａ-ｚＡ-Ｚ０-９]/u", $str);
}

/**
 * 登録されている単語なら翻訳する関数
 *
 * @param string $item
 * @return string
 */
function translate($item): string
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
