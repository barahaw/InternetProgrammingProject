<?php
session_start();
require_once 'config.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE news_table SET status = 'rejected' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['success_message'] = "تم رفض الخبر.";
}
header("Location: editor_dash.php");
exit;
?>