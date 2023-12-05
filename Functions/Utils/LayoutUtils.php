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
