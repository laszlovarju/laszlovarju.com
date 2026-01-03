<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$txtFile = 'lang-stats.txt';

if (file_exists($txtFile)) {
    $content = file_get_contents($txtFile);
    $data = json_decode($content, true);
    if (!is_array($data)) $data = [];
    echo json_encode(['stats' => $data]);
} else {
    echo json_encode(['stats' => []]);
}
?>