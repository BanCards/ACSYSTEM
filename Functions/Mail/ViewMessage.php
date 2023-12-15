<?php
include('../Utils/Utils.php');

$mail = $_POST['mail'];

if ($mail['is_read'] == false) updateQuery("mailbox", "is_read", "true", $_POST['mail_id']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <title>ACSystem - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Common.css">
    <link rel="stylesheet" href="CSS/ViewMessage.css">
</head>

<body>
    <div class="content">

        <!-- ヘッダー -->
        <?php sendHeaders() ?>

        <!-- メイン -->
        <div class="main">
            <div class="form">
                <h1 class="mailbox-title">メールボックス</h1>

                <div class="mailbox-items">
                    <div class="mailbox-item">
                        <div class="mail-header-title">
                            <h3><?php echo $mail['title'] ?></h3>
                        </div>
                        <div class="mailbox-header">
                            <div class="mailbox-header-day">
                                日付 : <?php echo applyTimeFormat($mail['time']); ?>
                            </div>
                            <div class="mailbox-header-from">
                                From : <?php echo getUserName($mail['from_user_id']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="mailbox-body">
                        <?php echo getMailMessage($_POST['mail_id'])['message'] ?>
                    </div>
                </div>

            </div>

            <div class="form-footer-items">
                <a href="Mail.php"><button class="back-button">メールボックスへ</button></a>
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