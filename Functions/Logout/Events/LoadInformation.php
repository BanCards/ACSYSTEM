<?php
session_status() == PHP_SESSION_NONE ? session_start() : sleep(0);

unset($_SESSION['UUID']);
unset($_SESSION['UserCard']);
unset($_SESSION['UserName']);
unset($_SESSION['UserEmail']);
unset($_SESSION['UserRole']);

header('Location:../LoadInformationSuccess.html');

?>