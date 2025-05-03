<?php
session_start();
require_once 'config.php';



if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "المعرف غير موجود.";
    header("Location: admin_dash.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SESSION['user_id'] == $id) {
    $_SESSION['error_message'] = "لا يمكنك حذف نفسك!";
    header("Location: admin_dash.php");
    exit;
}

$sql = ("DELETE FROM user_table WHERE id = '$id'");

if ($conn->query($sql)) {
    $_SESSION['error_message'] = "تم حذف المستخدم بنجاح.";
}
 else {
    $_SESSION['error_message'] = "فشل اثناء حذف المستخدم: " . $conn->error;
}

header("Location: admin_dash.php");
exit;
