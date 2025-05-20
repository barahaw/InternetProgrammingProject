<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_id = intval($_POST['news_id']);
    $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars(trim($_POST['content']), ENT_QUOTES, 'UTF-8');
    if ($news_id > 0 && $username && $content) {
        $stmt = $conn->prepare("INSERT INTO comments (news_id, user_name, comment, created_at) VALUES (?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param('iss', $news_id, $username, $content);
            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'db_error: ' . $stmt->error;
            }
        } else {
            echo 'prepare_error: ' . $conn->error;
        }
    } else {
        echo 'validation_error';
    }
} else {
    echo 'method_error';
}
