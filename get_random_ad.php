<?php
require_once 'config.php';

header('Content-Type: application/json');
// Prevent caching of this dynamic content
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ad = null;

if ($conn) {
    // Fetch a random ad that has an image path and is not an empty string
    $sql = "SELECT image, ad_text FROM ads WHERE image IS NOT NULL AND image != '' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $ad = $result->fetch_assoc();
    }
    // It's good practice to close the connection if it was opened by this script
    // However, if config.php establishes a persistent connection or it's closed elsewhere, this might not be needed.
    // For a simple script like this, closing is generally safe.
    $conn->close();
} else {
    // Optionally, log database connection error or handle it
    // http_response_code(500); // Internal Server Error
    // $ad = ['error' => 'Database connection failed']; // Send error in JSON
}

echo json_encode($ad); // If $ad is null (no ad found or DB error), this will output JSON 'null'
?>
