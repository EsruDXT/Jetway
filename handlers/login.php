<?php
// handlers/login.php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Basic validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Invalid email');
}

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['login_block_until'] = 0;
}
$maxAttempts = 5;
$cooldownSeconds = 300; // 5 minutes

if (time() < ($_SESSION['login_block_until'] ?? 0)) {
    respond(false, 'Too many attempts. Try again later.');
}

try {
    $pdo = connectDB();
    if (!$pdo) throw new Exception('DB connection failed');

    $stmt = $pdo->prepare('SELECT user_id, username, email, password FROM user_login WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= $maxAttempts) {
            $_SESSION['login_block_until'] = time() + $cooldownSeconds;
        }
        respond(false, 'Invalid email or password');
    }

    // Success
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['logged_in'] = true;
    $_SESSION['login_attempts'] = 0;
    $_SESSION['login_block_until'] = 0;

    // If request expects JSON, return JSON; otherwise redirect to homepage
    if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'success', 'success' => true, 'message' => 'Login successful', 'redirect' => '/pages/Homepage.php']);
        exit;
    }

    header('Location: /pages/Homepage.php');
    exit;

} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    respond(false, 'An error occurred');
}

function respond($ok, $message) {
    if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => $ok ? 'success' : 'error', 'success' => $ok, 'message' => $message]);
        exit;
    }
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['error'] = $message;
    header('Location: /pages/sign-in.php');
    exit;
}

?>
