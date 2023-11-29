<?php
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

define('INDEX', '/ACSystem/Index.php');

/**
 *  ヘッダー出力する関数。
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
                    <li class="contact">
                        <a href="#">
                            <i class="fas fa-info-circle"></i> コンタクト
                        </a>
                    </li>
                    <li class="mail">
                        <a href="/ACSystem/Functions/Mail/Mail.php">
                            <i class="fas fa-envelope"></i> メール
                        </a>
                    </li>
                    {$status}
                </ul>
            </nav>
        </div>
    HTML;
}

/**
 *  navタグアイテム出力する関数。
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
 *  フッターを出力する関数。
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
 *  phpmyadminへのデータベースに接続する関数。
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
 *  ログイン状態かを確認する関数。
 */
function isLoggedIn(): bool
{
    return !empty(getLoginUUID());
}

/**
 *  引数で渡されたユーザーが権限を持っているか判断する関数。
 */
function hasPermission($uuid): bool
{
    $perms = ['teacher', 'admin'];
    if (!in_array(getUserRole($uuid), $perms)) return false;

    return true;
}

/**
 *  引数の値でログイン状態にする。
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
 *  セッションを空にし、ログアウト状態にする関数。
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
 *  uuidからユーザーを取得する関数。
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
 *  引数のユニーク情報をセッション変数に渡す関数。
 */
function setLoginUUID($uuid): void
{
    unset($_SESSION['UUID']);
    $_SESSION['UUID'] = $uuid;

    return;
}

/**
 *  現在設定されているUUIDを取得する関数。
 */
function getLoginUUID(): mixed
{
    return !empty($_SESSION['UUID']) ? $_SESSION['UUID'] : '';
}

/**
 *  引数のカード情報をセッション変数に渡す関数。
 */
function setLoginUserCard($card): void
{
    unset($_SESSION['UserCard']);
    $_SESSION['UserCard'] = $card;

    return;
}

/**
 *  現在設定されているカード情報を取得する関数。
 */
function getLoginUserCard(): mixed
{
    return !empty($_SESSION['UserCard']) ? $_SESSION['UserCard'] : '';
}

/**
 *  引数で渡されたuuidの情報をもとにその人のカード情報を返す関数。
 */
function getUserCard($uuid): mixed
{
    return getUser($uuid)['card_id'];
}

/**
 *  引数のクラス情報をセッション変数に渡す関数。
 */
function setLoginUserClass($class): void
{
    unset($_SESSION['UserClass']);
    $_SESSION['UserClass'] = $class;

    return;
}

/**
 *  現在設定されているクラス情報を取得する関数。
 */
function getLoginUserClass(): mixed
{
    return !empty($_SESSION['UserClass']) ? $_SESSION['UserClass'] : '';
}

/**
 *  引数で渡されたuuidの情報をもとにその人のクラス情報を返す関数。
 */
function getUserClass($uuid): mixed
{
    return getUser($uuid)['class'];
}

/**
 *  引数の名前情報をセッション変数に渡す関数。
 */
function setLoginUserName($name): void
{
    unset($_SESSION['UserName']);
    $_SESSION['UserName'] = $name;

    return;
}

/**
 *  現在設定されている名前情報を取得する関数。
 */
function getLoginUserName(): mixed
{
    return !empty($_SESSION['UserName']) ? $_SESSION['UserName'] : '';
}

/**
 *  引数で渡されたuuidの情報をもとにその人のクラス情報を返す関数。
 */
function getUserName($uuid): mixed
{
    return getUser($uuid)['name'];
}

/**
 *  引数のメールアドレス情報をセッション変数に渡す関数。
 */
function setLoginUserEmail($mail): void
{
    unset($_SESSION['UserEmail']);
    $_SESSION['UserEmail'] = $mail;

    return;
}

/**
 *  現在設定されているメールアドレス情報を取得する関数。
 */
function getLoginUserEmail(): mixed
{
    return !empty($_SESSION['UserEmail']) ? $_SESSION['UserEmail'] : '';
}

/**
 *  引数で渡されたuuidの情報をもとにその人のクラス情報を返す関数。
 */
function getUserEmail($uuid): mixed
{
    return getUser($uuid)['email'];
}

/**
 *  引数の権限情報をセッション変数に渡す関数。
 */
function setLoginUserRole($role): void
{
    unset($_SESSION['UserRole']);
    $_SESSION['UserRole'] = $role;

    return;
}

/**
 *  現在設定されている権限情報を取得する関数。
 */
function getLoginUserRole(): mixed
{
    return !empty($_SESSION['UserRole']) ? $_SESSION['UserRole'] : '';
}

/**
 *  引数で渡されたuuidの情報をもとにその人のクラス情報を返す関数。
 */
function getUserRole($uuid): mixed
{
    return getUser($uuid)['role'];
}

/**
 *  登録されているユーザーを全員取得する関数。
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
 *  ユーザーの出欠状況を設定する関数。
 */
function addUserRecord($user_id, $timestamp, $status, $comment)
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

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

        return null;
    }
}

/**
 *  登録されているユーザーの出欠状況を取得する関数。
 */
function getUserRecord($uuid): ?array
{
    $pdo = getDatabaseConnection();

    if (!$pdo) return null;

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

/**
 *  現在時刻を取得し、フォーマット変換する関数。
 */
function getCurrentTime(): string
{
    $timezone = new DateTimeZone('Asia/Tokyo');
    $now = new DateTime('now', $timezone);

    return $now->format("Y-m-d H:i:s");
}

/**
 *  処理成功の時に詳細を設定、画面遷移する関数。
 */
function setSuccess($title): void
{
    $_SESSION['SuccessTitle'] = $title;
    header('Location:/ACSystem/Functions/Response/LoadInformationSuccess.php');

    return;
}

/**
 *  成功時にタイトルを取得する変数。
 */
function getSuccess(): mixed
{
    return !empty($_SESSION['SuccessTitle']) ? $_SESSION['SuccessTitle'] : '';
}

/**
 *  処理失敗の時に詳細を設定、画面遷移する関数。
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
 *  失敗時に引数のタイプを取得する関数。
 *
 *  @param string $type {title, message, code}
 */
function getError($type): mixed
{
    $types = ['title', 'message', 'code'];

    if (!in_array($type, $types)) {
        setError("セッションエラーが発生しました", "ACSystemチームまでご連絡ください。", "14S");
        return false;
    }

    return !empty($_SESSION['Error' . ucfirst($type)]) ? $_SESSION['Error' . ucfirst($type)] : '';
}

/**
 *  引数に受け取った変数に値が設定されているか判断する可変長引数型関数。
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
 *  受け取った変数の値が日本語かどうか判断する。
 */
function isJapanese($str): bool
{
    return preg_match("/[一-龠]+|[ぁ-ん]+|[ァ-ヴー]+|[一-龠]+|[ａ-ｚＡ-Ｚ０-９]/u", $str);
}

/**
 *  受け取った変数を翻訳する関数。
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
