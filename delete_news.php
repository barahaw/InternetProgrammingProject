<?php
session_start();
require_once 'config.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = ("DELETE FROM news_table WHERE id = '$id'");
    $conn->query($sql);
    $_SESSION['success_message'] = "تم حذف الخبر بنجاح.";
}
header("Location: " . $_SERVER['HTTP_REFERER']); // from chatgpt
exit;
?>
