<?php
include('../../Utils/Utils.php');
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

echo $_SESSION['contactTitle'];
echo $_SESSION['contactContents'];