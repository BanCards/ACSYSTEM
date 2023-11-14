<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ACSystem - Direct Attend</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="stylesheet" href="../../../CSS/Common.css" />
  <link rel="stylesheet" href="../CSS/CardAttend.css" />
</head>

<body>
  <div class="content">
    <!-- ヘッダー -->
    <?php sendHeaders() ?>

    <!-- メイン -->
    <div class="main">
      <div class="form">
        <h1 class="attendance-title">カードで出席</h1>

        <form class="attendance-form" action="Events/LoadInformation.php" method="post">
          <div class="form-item_required">
            <input type="text" name="cardID" id="cardID" pattern="[0-9]*" placeholder="カードを読み込ませてください" />
          </div>

          <script>
            window.onload = function() {
              var element = document.getElementById("cardID");
              element.focus();
            };

            // イベントリスナーを追加して入力値を半角に変換
            document
              .getElementById("cardID")
              .addEventListener("input", function() {
                var inputValue = this.value;
                var halfWidthValue = convertToHalfWidth(inputValue);
                this.value = halfWidthValue;
              });

            // 文字列を半角に変換する関数
            function convertToHalfWidth(str) {
              return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 0xfee0);
              });
            }
          </script>
        </form>
      </div>
    </div>

    <!-- フッター -->
    <div class="footer">
      <div class="copyright">
        <p>
          Copyright &copy; 2023 Attendance Check System by ACSystem Team All
          rights reserved.
        </p>
      </div>
    </div>
  </div>
</body>

</html>