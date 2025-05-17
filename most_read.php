<?php
require_once 'config.php';
header('Content-Type: application/json; charset=utf-8');

// Top 5 most read for the list
$list = [];
$result = $conn->query("SELECT id, title FROM news_table ORDER BY views DESC LIMIT 5");
while ($row = $result->fetch_assoc()) {
    $list[] = $row;
}

// Cards (next 2 most read with image, category, excerpt)
$cards = [];
$result = $conn->query("SELECT id, title, image, category_id, LEFT(body, 120) as excerpt FROM news_table ORDER BY views DESC LIMIT 5,2");
while ($row = $result->fetch_assoc()) {
    $catRes = $conn->query("SELECT name FROM category_table WHERE id=" . intval($row['category_id']));
    $cat = $catRes && $catRes->num_rows ? $catRes->fetch_assoc()['name'] : '';
    $row['category'] = $cat;
    $cards[] = $row;
}

// Extra cards (next 2)
$extraCards = [];
$result = $conn->query("SELECT id, title, image, category_id, LEFT(body, 120) as excerpt FROM news_table ORDER BY views DESC LIMIT 7,2");
while ($row = $result->fetch_assoc()) {
    $catRes = $conn->query("SELECT name FROM category_table WHERE id=" . intval($row['category_id']));
    $cat = $catRes && $catRes->num_rows ? $catRes->fetch_assoc()['name'] : '';
    $row['category'] = $cat;
    $extraCards[] = $row;
}

$moreNews = [];
$result = $conn->query("SELECT id, title, image, category_id, LEFT(body, 120) as excerpt FROM news_table ORDER BY RAND() LIMIT 3");
while ($row = $result->fetch_assoc()) {
    $catRes = $conn->query("SELECT name FROM category_table WHERE id=" . intval($row['category_id']));
    $cat = $catRes && $catRes->num_rows ? $catRes->fetch_assoc()['name'] : '';
    $row['category'] = $cat;
    $moreNews[] = $row;
}

echo json_encode([
    'list' => $list,
    'cards' => $cards,
    'extraCards' => $extraCards,
    'moreNews' => $moreNews
], JSON_UNESCAPED_UNICODE);
