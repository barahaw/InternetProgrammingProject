<?php
require_once 'config.php';
$ad = $conn->query("SELECT ad_text FROM ads ORDER BY id DESC LIMIT 1")->fetch_assoc();
if ($ad) {
    echo '<div class="card border-0 my-3"><div class="card-body text-center">' . htmlspecialchars($ad['ad_text']) . '</div></div>';
}
