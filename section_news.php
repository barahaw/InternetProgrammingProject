<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';
$full = isset($_GET['full']) && $_GET['full'] == '1';

if (!$category) {
    echo json_encode(['error' => 'No category specified']);
    exit;
}

$stmt = $conn->prepare("SELECT n.id, n.title, LEFT(n.body, 120) AS excerpt, n.body, n.image, c.name as category FROM news_table n LEFT JOIN category_table c ON n.category_id = c.id WHERE c.name = ? ORDER BY n.date_posted DESC LIMIT 6");
$stmt->bind_param('s', $category);
$stmt->execute();
$result = $stmt->get_result();
$news = [];
while ($row = $result->fetch_assoc()) {
    $news[] = $row;
}

if ($full) {
    $main = isset($news[0]) ? [
        'id' => $news[0]['id'],
        'title' => $news[0]['title'],
        'excerpt' => $news[0]['excerpt'],
        'body' => $news[0]['body'],
        'image' => $news[0]['image'],
        'category' => $news[0]['category'],
    ] : null;
    $side = [];
    for ($i = 1; $i < count($news); $i++) {
        $side[] = [
            'id' => $news[$i]['id'],
            'title' => $news[$i]['title'],
            'excerpt' => $news[$i]['excerpt'],
            'body' => $news[$i]['body'],
            'image' => $news[$i]['image'],
            'category' => $news[$i]['category'],
        ];
    }
    echo json_encode([
        'main' => $main,
        'side' => $side
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode($news, JSON_UNESCAPED_UNICODE);
}
