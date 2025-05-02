<?php
session_start();

session_unset();
session_destroy();

session_start();
$_SESSION['success_message'] = "تم تسجيل الخروج بنجاح.";

header("Location: login.php");
exit;
