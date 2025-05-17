<?php
require_once 'config.php';
$sql = "SELECT n.id, n.title, COUNT(c.id) as comment_count FROM news_table n LEFT JOIN comments c ON n.id = c.news_id GROUP BY n.id, n.title ORDER BY comment_count DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<li class="py-2 border-bottom">';
        echo '<strong class="text-muted">' . $i++ . '.</strong> ';
        echo '<a href="details.php?id=' . $row['id'] . '" class="text-decoration-none text-dark">' . htmlspecialchars($row['title']) . '</a>';
        echo ' <span class="badge bg-secondary">' . $row['comment_count'] . ' تعليق</span>';
        echo '</li>';
    }
} else {
    echo '<li class="py-2">لا يوجد بيانات</li>';
}
