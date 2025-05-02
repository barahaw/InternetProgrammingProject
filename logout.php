<?php
session_start();

// تدمير الجلسة بالكامل
session_unset();
session_destroy();

// بدء جلسة جديدة لإظهار إشعار
session_start();
$_SESSION['success_message'] = "تم تسجيل الخروج بنجاح.";

// تحويل لصفحة تسجيل الدخول
header("Location: login.php");
exit;
