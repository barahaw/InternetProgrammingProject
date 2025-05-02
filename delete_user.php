<?php
session_start();
require_once 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "المعرف غير موجود.";
    header("Location: admin_dashboard.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SESSION['user_id'] == $id) {
    $_SESSION['error_message'] = "لا يمكنك حذف نفسك!";
    header("Location: admin_dash.php");
    exit;
}

$stmt = $conn->prepare("DELETE FROM user_table WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['error_message'] = "تم حذف المستخدم بنجاح.";
} else {
    $_SESSION['error_message'] = "حدث خطأ أثناء الحذف.";
}

header("Location: admin_dash.php");
exit;
