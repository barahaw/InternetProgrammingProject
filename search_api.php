<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$newsArr = [];
if ($q !== '') {
    $sql = "SELECT n.Id, n.Title, LEFT(n.Body, 120) AS excerpt, n.Image FROM news_table n LEFT JOIN category_table c ON n.Category_Id = c.Id WHERE n.Title LIKE ? OR n.Body LIKE ? OR n.keywords LIKE ? OR c.Name LIKE ? ORDER BY n.Date_Posted DESC";
    $like = "%$q%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $like, $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $newsArr[] = $row;
    }
}
echo json_encode($newsArr, JSON_UNESCAPED_UNICODE);
