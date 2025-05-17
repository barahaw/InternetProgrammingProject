<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$newsArr = [];
if ($category !== '') {
    $catId = 0;
    $catStmt = $conn->prepare("SELECT Id FROM category_table WHERE Name = ? LIMIT 1");
    $catStmt->bind_param('s', $category);
    $catStmt->execute();
    $catRes = $catStmt->get_result();
    if ($catRow = $catRes->fetch_assoc()) {
        $catId = $catRow['Id'];
    }
    if ($catId) {
        $sql = "SELECT Id, Title, LEFT(Body, 120) AS excerpt, Image FROM news_table WHERE Category_Id = ? ORDER BY Date_Posted DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $newsArr[] = $row;
        }
    }
}
echo json_encode($newsArr, JSON_UNESCAPED_UNICODE);
