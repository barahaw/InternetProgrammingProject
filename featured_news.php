<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';
// Select 5 approved news as featured (you can adjust the logic as needed)
$result = $conn->query($sql);
$news = [];
while ($row = $result->fetch_assoc()) {
    $news[] = $row;
}
echo json_encode($news, JSON_UNESCAPED_UNICODE);
