<?php

/**
 * アカウント作成関数
 *
 * @param string $card_id
 * @param string $class
 * @param string $name
 * @param string $email
 * @param string $password
 * @return bool
 */
function createAccount($card_id, $class, $name, $email, $password): bool
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return false;

    $password = hashingItem($password);

    $query = "INSERT INTO users (card_id, class, name, email, password) VALUES (:card_id, :class, :name, :email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':card_id', $card_id, PDO::PARAM_STR);
    $stmt->bindParam(':class', $class, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

    return $stmt->execute();
}

/**
 * uuidと一致するユーザーを返す関数
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
 * カードIDと一致するユーザーを取得する関数
 *
 * @param int $card_id
 * @return void
 */
function getUserByCardID($card_id): ?array
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return null;

    try {
        $query = "SELECT * FROM users WHERE card_id = :cardID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':cardID', $card_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * メールアドレスと一致するユーザーを取得する関数
 *
 * @param string $email_address
 * @return array|null
 */
function getUserByEmail($email_address): ?array
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return null;

    try {
        $query = "SELECT * FROM users WHERE email = :mail";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':mail', $email_address, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }

    return null;
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
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result : null;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
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
 * ユーザーのレコードを追加する関数
 *
 * @param UUID $user_id
 * @param TIMESTAMP $timestamp
 * @param string $status
 * @param string $comment
 * @return void
 */
function registerAttend($user_id, $is_request, $timestamp, $status, $comment): void
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return;

    try {
        $query = "INSERT INTO attendance (user_id, is_request, timestamp, status, comment) VALUES (:user_id, :is_request, :timestamp, :status, :comment)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':is_request', $is_request, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header('Location: /ACSystem/Functions/Attendance/DirectAttendance/Attended.php');
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

function requestAttend($user_id, $timestamp, $status, $comment): void
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return;
}

/**
 * uuidと一致するユーザーのレコードを取得する関数
 *
 * @param UUID $uuid
 * @return array|null
 */
function getAttend($uuid): ?array
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return null;

    try {
        $query = "SELECT id, is_request, timestamp, status, comment FROM attendance WHERE user_id = :user_id ORDER BY timestamp DESC";
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
 * 出席したかどうか判断する関数
 *
 * @param UUID $uuid
 * @return boolean
 */
function isAttended($uuid)
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return false;

    try {
        $query = "SELECT * FROM attendance WHERE user_id = :uuid AND DATE(timestamp) = CURDATE()";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('uuid', $uuid, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result !== false);
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * メールを送信するする関数
 *
 * @param UUID $from_user_id
 * @param UUID $to_user_id
 * @param string $title
 * @param string $message
 * @return void
 */
function sendMail($from_user_id, $to_user_id, $title, $message): void
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return;

    try {
        $query = "INSERT INTO mailbox (from_user_id, to_user_id, timestamp, title, message) VALUES (:from_user_id, :to_user_id, :timestamp, :title, :message)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':to_user_id', $to_user_id, PDO::PARAM_INT);
        $stmt->bindValue(':timestamp', getCurrentTime(), PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        $stmt->execute();
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20MD");
        error_log("ACSystem Error: " . $e->getMessage());

        return;
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
