<?php
// Keep your SheetDB URL here — never exposed to the client.
define('SHEETDB_URL', 'https://sheetdb.io/api/v1/4yypayxsfjzr3');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$body = file_get_contents('php://input');
$payload = json_decode($body, true);

if (!$payload || !isset($payload['data']) || !is_array($payload['data'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload']);
    exit;
}

$allowed_keys = [
    'conversations', 'evenings', 'focus', 'topics', 'extroversion',
    'meeting_pref', 'relationship', 'english', 'dob', 'city',
    'studied_jordan', 'university', 'faculty', 'name', 'whatsapp',
    'instagram', 'gender', 'occupation', 'meetup_type', 'consent'
];

$clean = [];
foreach ($allowed_keys as $key) {
    $clean[$key] = isset($payload['data'][$key]) ? (string) $payload['data'][$key] : '';
}

$ch = curl_init(SHEETDB_URL);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode(['data' => $clean]),
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_TIMEOUT        => 15,
]);

$response = curl_exec($ch);
$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err      = curl_error($ch);
curl_close($ch);

if ($err) {
    http_response_code(502);
    echo json_encode(['error' => 'Failed to reach sheet service']);
    exit;
}

http_response_code($status);
echo $response;
