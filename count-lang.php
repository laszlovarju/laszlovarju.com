<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$txtFile = 'lang-stats.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $lang = isset($input['language']) ? strtolower(substr($input['language'], 0, 2)) : 'unknown';

    if (file_exists($txtFile)) {
        $content = file_get_contents($txtFile);
        $data = json_decode($content, true);
        if (!is_array($data)) $data = [];
    } else {
        $data = [];
    }

    $data[$lang] = ($data[$lang] ?? 0) + 1;

    file_put_contents($txtFile, json_encode($data));
    echo json_encode(['status' => 'success']);
?>
}