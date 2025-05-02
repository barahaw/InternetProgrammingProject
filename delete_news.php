<?php
session_start();
$conn = new mysqli("localhost", "root", "", "internet_programming_pro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM news_table WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['success_message'] = "تم حذف الخبر بنجاح.";
}
header("Location: editor_dash.php");
exit;
?>
