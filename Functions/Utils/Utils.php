<?php
include('DatabaseUtils.php');
include('LayoutUtils.php');
include('SessionUtils.php');
include('UserUtils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

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

function hashingItem($item)
{
    $hashed_item = md5($item);

    return $hashed_item;
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
        'email_info' => 'メールアドレス情報',
        'password_info' => 'パスワード情報',
    ];

    return $translations[$item] ?? '';
}
