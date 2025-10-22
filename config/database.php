<?php
// config/database.php
// Update these values to match your environment if different
$DB_HOST = '127.0.0.1';
$DB_NAME = 'Jetway';
$DB_USER = 'root';
$DB_PASS = '';

try {
    $conn = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // In production, don't echo errors. Log them instead.
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

?>
