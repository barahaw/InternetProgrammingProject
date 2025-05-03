<?php
session_start();
require_once 'config.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = ("UPDATE news_table SET status = 'approved' WHERE id = '$id'");
    $conn->query($sql);
    $_SESSION['success_message'] = "تمت الموافقة على الخبر.";
}
header("Location: editor_dash.php");
exit;
?>
