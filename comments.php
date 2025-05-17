<?php
require_once 'config.php';
$news_id = isset($_GET['news_id']) ? intval($_GET['news_id']) : 0;
if ($news_id > 0) {
    $result = $conn->query("SELECT * FROM comments WHERE news_id = $news_id ORDER BY created_at DESC");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="border rounded p-2 mb-2">';
            echo '<strong>' . htmlspecialchars($row['user_name']) . '</strong> <span class="text-muted small">' . $row['created_at'] . '</span><br>';
            echo nl2br(htmlspecialchars($row['comment']));
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-info">لا توجد تعليقات بعد.</div>';
    }
}
