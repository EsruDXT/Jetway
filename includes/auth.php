<?php
require_once __DIR__ . '/config.php';

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password) {
    // Accept any password (no complexity or length enforced)
    return true;
}

function validateUsername($username) {
    // 3-50 characters, letters, numbers, and underscores only
    return preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username);
}

function createUser($username, $email, $password) {
    $pdo = connectDB();
    if (!$pdo) return ['success' => false, 'message' => 'Database connection failed'];

    try {
        // Check if username or email exists
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM user_login WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        if ($stmt->fetchColumn() > 0) {
            return ['success' => false, 'message' => 'Username or email already exists'];
        }

        // Create new user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO user_login (username, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$username, $email, $hashedPassword]);

        return ['success' => true, 'message' => 'Registration successful'];
    } catch (PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        return ['success' => false, 'message' => 'Registration failed'];
    }
}

function loginUser($email, $password) {
    $pdo = connectDB();
    if (!$pdo) return ['success' => false, 'message' => 'Database connection failed'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM user_login WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Start session and store user data
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;

            // Set secure session cookie
            $params = session_get_cookie_params();
            setcookie(session_name(), session_id(), [
                'expires' => time() + 86400,
                'path' => '/',
                'domain' => '',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);

            return ['success' => true, 'message' => 'Login successful'];
        } else {
            return ['success' => false, 'message' => 'Invalid email or password'];
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return ['success' => false, 'message' => 'Login failed'];
    }
}

function logoutUser() {
    session_start();
    $_SESSION = array();
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', [
            'expires' => time() - 3600,
            'path' => '/',
            'domain' => '',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }
    
    session_destroy();
}
?>