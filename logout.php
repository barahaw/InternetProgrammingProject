<?php
session_start();

setcookie('success_message', 'تم تسجيل الخروج بنجاح.', time() + 60, '/');

session_unset();
session_destroy();

header("Location: login.php");
exit;
?>