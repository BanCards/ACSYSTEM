<?php
include 'LoadInformation.php';

//リクエストメソッドを確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardID = $_POST['cardID'];

    //空白文字チェック
    if (empty($cardID)) {
        setError("カード情報にエラーが発生しました。", "カードをもう一度読み込んでください。", "13C_" . $date);
        return;
    }

    //カードID受け渡し
    $_SESSION['cardID'] = $cardID;
    header('Location: ../CreateAccount.php');
    exit;
}
