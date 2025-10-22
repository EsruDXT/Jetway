<?php
// handlers/login.php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    exit;
}

// Simple brute-force protection stored in session (works for single-server setups)
$maxAttempts = 5;
$cooldownSeconds = 300; // 5 minutes
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['login_block_until'] = 0;
}

if (time() < ($_SESSION['login_block_until'] ?? 0)) {
    http_response_code(429);
    echo json_encode(['status' => 'error', 'message' => 'Too many attempts. Try again later.']);
    exit;
}

try {
    $stmt = $conn->prepare('SELECT id, email, password, name FROM users WHERE email = :email LIMIT 1');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();
    if (!$user) {
        // increment attempts
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $_SESSION['login_block_until'] = time() + $cooldownSeconds;
        }
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        // increment attempts
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $_SESSION['login_block_until'] = time() + $cooldownSeconds;
        }
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        exit;
    }

    // regenerate session id
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];

    // reset attempts on success
    $_SESSION['login_attempts'] = 0;
    $_SESSION['login_block_until'] = 0;

    echo json_encode(['status' => 'success', 'message' => 'Login successful', 'redirect' => '/pages/Homepage.html']);
    exit;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

?>
