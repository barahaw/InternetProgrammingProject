<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');
$news_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($news_id > 0) {
    $stmt1 = $conn->prepare("UPDATE news_table SET views = views + 1 WHERE Id = ?");
    $stmt1->bind_param('i', $news_id);
    $stmt1->execute();
    $stmt1->close();
    $stmt2 = $conn->prepare("SELECT n.Id, n.Title, n.Body, n.Image, n.Date_Posted, n.Category_Id, n.Author_Id, n.Status, n.keywords, n.views, c.Name AS category FROM news_table n LEFT JOIN category_table c ON n.Category_Id = c.Id WHERE n.Id = ?");
    $stmt2->bind_param('i', $news_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    if ($result && $result->num_rows > 0) {
        $news = $result->fetch_assoc();
        echo json_encode([
            'id' => $news['Id'],
            'title' => $news['Title'],
            'category' => $news['category'],
            'date_posted' => $news['Date_Posted'],
            'image' => $news['Image'],
            'body' => $news['Body'],
            'keywords' => $news['keywords'],
            'views' => $news['views'],
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $stmt2->close();
}
echo json_encode(['error' => 'not found']);
