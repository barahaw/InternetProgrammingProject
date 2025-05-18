<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$sql = "SELECT n.Id as id, n.Title as title, LEFT(n.Body, 100) AS excerpt, n.Body as body, n.Image as image, c.Name as category, u.Name as author FROM news_table n LEFT JOIN category_table c ON n.Category_Id = c.Id LEFT JOIN user_table u ON n.Author_Id = u.Id WHERE n.Status = 'approved' ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);
$news = [];
while ($row = $result->fetch_assoc()) {
    $news[] = $row;
}
echo json_encode($news, JSON_UNESCAPED_UNICODE);
