<?php

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
 * アップデートクエリ
 *
 * @param string $table
 * @param string $column
 * @param string $value
 * @param string $id
 * @return void
 */
function updateQuery($table, $column, $value, $id): void
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return;

    $query = "UPDATE $table SET $column = $value WHERE $table.id = $id";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute()) return;

    return;
}

/**
 * お知らせをDBから取得
 *
 * @return void
 */
function getNotifications(): ?array
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return null;

    try {
        $query =  "SELECT timestamp, category, title FROM notifications ORDER BY id DESC LIMIT 10";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        setError("データの取得中にエラーが発生しました。", "ACSystemチームまでご連絡ください。", "20D");
        error_log("ACSystem Error: " . $e->getMessage());

        return null;
    }
}

/**
 * レコードが重複しているか判定
 *
 * @param string $table
 * @param string $column
 * @param string $value
 * @return boolean|null
 */
function isDuplicatedRecord($table, $column, $value): ?bool
{
    $pdo = getDatabaseConnection();
    if (!$pdo) return null;

    $query = "SELECT * FROM $table WHERE $column = :value";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch();

    return $result !== false;
}
