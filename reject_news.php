<?php
session_start();
require_once 'config.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE news_table SET status = 'rejected' WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['success_message'] = "تم رفض الخبر.";
}
header("Location: editor_dash.php");
exit;
?>