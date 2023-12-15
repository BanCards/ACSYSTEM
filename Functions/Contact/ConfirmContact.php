<?php
include('../Utils/Utils.php');

if (!(isLoggedIn())) {
    setError("ログイン情報エラー", "ログインしてください。", "12A");
    return;
}
if (isEmptyItems($_GET['contactTitle'], $_GET['contactContents'])) return;

$_SESSION['contactTitle'] = htmlspecialchars($_GET['contactTitle'], ENT_QUOTES, 'UTF-8');
$_SESSION['contactContents'] = htmlspecialchars($_GET['contactContents'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Contact</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="../../CSS/Common.css" />
    <link rel="stylesheet" href="CSS/ConfirmContact.css" />
</head>

<body>
    <div class="content">
        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="contact-title">コンタクト</h1>
                <form class="contact-form" action="Events/LoadContact.php" method="GET">

                    <div class="form-item_required">
                        タイトル<br><?php echo $_SESSION['contactTitle'] ?>
                    </div>

                    <div class="form-item_required">
                        お問い合わせ内容<br><?php echo $_SESSION['contactContents'] ?>
                    </div>

                    <div class="submit-button">
                        <button type="submit">確認</button>
                    </div>

                    <div class="cancel-button">
                        <a href="Contact.php"><button type="button">キャンセル</button></a>
                    </div>

                </form>

            </div>
        </div>

        <!-- フッター -->
        <?php sendFooters() ?>

    </div>

    <div class="pop"></div>

    <script src="../../JavaScript/DisableAutoComplete.js"></script>
    <script src="../../JavaScript/PopUp.js"></script>
</body>

</html>