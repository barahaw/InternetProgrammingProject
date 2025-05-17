<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');
$category = isset($_GET['category']) ? $_GET['category'] : '';
$exclude = isset($_GET['exclude']) ? intval($_GET['exclude']) : 0;
$news = [];
if ($category) {
    $stmt = $conn->prepare("SELECT n.Id as id, n.Title as title, n.Image as image, c.Name as category FROM news_table n LEFT JOIN category_table c ON n.Category_Id = c.Id WHERE c.Name = ? AND n.Id != ? ORDER BY n.Date_Posted DESC LIMIT 3");
    $stmt->bind_param('si', $category, $exclude);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}
echo json_encode($news, JSON_UNESCAPED_UNICODE);
