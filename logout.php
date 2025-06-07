<?php
session_start();

session_unset();
session_destroy();

$_SESSION['success_message'] = "تم تسجيل الخروج بنجاح.";

header("Location: login.php");
exit;
?>