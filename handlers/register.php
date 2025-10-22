<?php
// handlers/register.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6 || empty($name)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

try {
    $check = $conn->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $check->bindParam(':email', $email);
    $check->execute();
    if ($check->fetch()) {
        http_response_code(409);
        echo json_encode(['status' => 'error', 'message' => 'Email already registered']);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare('INSERT INTO users (email, password, name) VALUES (:email, :password, :name)');
    $insert->bindParam(':email', $email);
    $insert->bindParam(':password', $hash);
    $insert->bindParam(':name', $name);
    $insert->execute();

    echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
    exit;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

?>
