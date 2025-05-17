<?php
session_start();
require_once 'config.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM news_table WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['success_message'] = "تم حذف الخبر بنجاح.";
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
