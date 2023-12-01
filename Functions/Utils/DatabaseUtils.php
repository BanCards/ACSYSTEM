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