<?php
require_once 'config.php';

header('Content-Type: application/json');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ad = null;

if ($conn) {
    $sql = "SELECT image, ad_text FROM ads WHERE image IS NOT NULL AND image != '' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $ad = $result->fetch_assoc();
    }
    $conn->close();
}

echo json_encode($ad);
?>
