<?php
include('../../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

echo $_SESSION['editItem'];
echo $_POST['new-item-value'];
