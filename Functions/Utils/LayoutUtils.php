<?php
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

function sendQuickAccesses()
{
    echo '<div class="access">
            <h3 class="access-title">クイックアクセス</h3>
            <div class="item">';

    generateAccessItem("record", "Functions/Attendance/DirectAttendance/DirectAttendance.php", "fas fa-user-alt", "出席する");
    generateAccessItem("report", "Functions/Attendance/WebAttendance/WebAttendance.php", "fas fa-user-alt-slash", "欠席申請をする");
    generateAccessItem("record", "Functions/Profile/Record.php", "fas fa-calendar-week", "履歴を見る");
    if (isLoggedIn())
        if (hasPermission(getLoginUUID()))
            generateAccessItem("test", "Functions/Staff/Index.php", "fas fa-user-graduate", "スタッフ用サイトへ");

    echo '</div>
        </div>';
}

function sendQuickAccessesForStaff()
{
    echo '<div class="access">
            <h3 class="access-title">クイックアクセス</h3>
            <div class="item">';

    generateAccessItem("index", "/ACSystem/Index.php", "fas fa-home", "ホームに戻る");
    generateAccessItem("todayattendees", "/ACSystem/Functions/Staff/Functions/TodayAttendees/TodayAttendees.php", "fas fa-calendar-check", "今日の出席者");
    generateAccessItem("userlist", "/ACSystem/Functions/Staff/Functions/UserList/UserList.php", "fas fa-id-card", "ユーザー欄");
    generateAccessItem("test", "/ACSystem/Functions/Staff/Functions/AttendRequest/AttendRequest.php", "fas fa-comment-dots", "出欠申請を見る");

    echo '</div>
        </div>';
}

function generateAccessItem($id, $href, $iconClass, $text)
{
    echo '<a href="' . $href . '" class="btn btn--circle" id="' . $id . '">
            <i class="' . $iconClass . '"></i>
            <br>
            <p>' . $text . '</p>
            <i class="fas fa-angle-down fa-position-bottom"></i>
          </a>';
}

/**
 * お知らせを出力する関数
 *
 * @param array $notifications
 * @return void
 */
function sendNotifications($notifications): void
{
    echo '<div class="notification">';
    echo '  <h3 class="notification-title">お知らせ</h3>';
    echo '  <ul class="news-list">';

    if (!$notifications) {
        echo '    <li><p class="title">お知らせはないよ :(</p></li>';
        return;
    }

    foreach ($notifications as $notification) {
        echo '    <li>';
        echo '      <p class="date">' . date('Y年 m月 d日', strtotime($notification['timestamp'])) . '</p>';
        echo '      <p class="category"><span>' . $notification['category'] . '</span></p>';
        echo '      <p class="title">' . $notification['title'] . '</p>';
        echo '    </li>';
    }

    echo '  </ul>';
    echo '</div>';
}


function sendEditProfileItems($type)
{
    $types = ['email', 'password'];

    if (!in_array($type, $types)) {
        setError("セッションエラーが発生しました", "ACSystemチームまでご連絡ください。", "14S");
        return false;
    }

    if ($type == 'email') {
        $current_email = getUserEmail(getLoginUUID());
        echo '<div class="form-item_required" id="update-message">';
        echo '新しいメールアドレス情報を設定してください';
        echo '</div>';

        echo '<div class="form-item_required" id="current-email">';
        echo '現在のメールアドレス : ' . getLoginUserEmail();
        echo '</div>';

        echo '<div class="form-item_required">';
        echo '<input type="mail" name="new_item" value="" pattern="[\w\-._]+@[\w\-._]+\.[A-Za-z]+" placeholder="メールアドレス" class="input_item"/>';
        echo '</div>';

        echo '<script>';
        echo 'let current_email = ' . json_encode($current_email) . ';';
        echo '</script>';
    } else {
        $current_password = getUser(getLoginUUID())['password'];
        echo '<div class="form-item_required" id="update-message">';
        echo '新しいパスワード情報を設定してください';
        echo '</div>';

        echo '<div class="form-item_required">';
        echo '<input type="password" name="new_item" value="" placeholder="現在のパスワード (8文字～32文字)" class="input_item" id="input_current_password"/>';
        echo '</div>';

        echo '<div class="form-item_required">';
        echo '<input type="password" name="confirm_new_item" value="" placeholder="新しいパスワード (8文字～32文字)" class="input_item" id="input_new_password"/>';
        echo '</div>';

        echo '<script>';
        echo 'let current_password = ' . json_encode($current_password) . ';';
        echo '</script>';
    }
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
