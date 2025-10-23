<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/auth.php';

header('Content-Type: application/json; charset=utf-8');

// Error logging configuration
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get and sanitize input
$username = sanitizeInput($_POST['username'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Server-side validation (allow any password, including empty)
if (empty($username) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Username and email are required']);
    exit;
}

if (!validateUsername($username)) {
    echo json_encode(['success' => false, 'message' => 'Invalid username format']);
    exit;
}

if (!validateEmail($email)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

// Rate limiting check
if (!isset($_SESSION['last_registration_attempt'])) {
    $_SESSION['registration_attempts'] = 0;
}

if ($_SESSION['registration_attempts'] > 5 && 
    time() - $_SESSION['last_registration_attempt'] < 300) { // 5 minutes cooldown
    echo json_encode(['success' => false, 'message' => 'Too many attempts. Please try again later']);
    exit;
}

$_SESSION['last_registration_attempt'] = time();
$_SESSION['registration_attempts']++;

try {
    $pdo = connectDB();
    if (!$pdo) {
        throw new Exception('Database connection failed');
    }

    // Start transaction
    $pdo->beginTransaction();

    // Check if username or email exists
    $check = $pdo->prepare('SELECT user_id FROM user_login WHERE email = :email OR username = :username LIMIT 1');
    $check->bindParam(':email', $email);
    $check->bindParam(':username', $username);
    $check->execute();
    
    if ($check->fetch()) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Username or email already registered']);
        exit;
    }

    // Create account
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $insert = $pdo->prepare('INSERT INTO user_login (username, email, password) VALUES (:username, :email, :password)');
    $insert->bindParam(':username', $username);
    $insert->bindParam(':email', $email);
    $insert->bindParam(':password', $hash);
    $insert->execute();

    // Commit transaction
    $pdo->commit();

    // If we got here, registration was successful
    $_SESSION['registration_attempts'] = 0; // Reset attempts on success
    echo json_encode([
        'success' => true, 
        'message' => 'Registration successful! Please sign in.'
    ]);

} catch (PDOException $e) {
    // Log the actual error for debugging
    error_log("Registration error: " . $e->getMessage());
    
    if ($pdo && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred during registration. Please try again.'
    ]);

} catch (Exception $e) {
    error_log("Registration error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred. Please try again later.'
    ]);
}
?>
