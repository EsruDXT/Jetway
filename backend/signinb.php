<?php
session_start();
require_once 'config/db-connection.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are already logged in!');
            window.location.href='../pages/customer-data.php';
          </script>";
    exit;
}

if (isset($_POST['confirm-btn'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.location.href='../pages/sign-in.php';
              </script>";
        exit;
    }

    // Query to get user by email
    $query = $connection->prepare("SELECT * FROM user_login WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
        echo "<script>
                alert('Email not found. Please check your email or sign up.');
                window.location.href='../pages/sign-in.php';
              </script>";
        exit;
    }

    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['login_time'] = time();

        // Update last login time (optional)
        $update_login = $connection->prepare("UPDATE user_login SET last_login = NOW() WHERE id = ?");
        $update_login->bind_param('i', $user['id']);
        $update_login->execute();

        echo "<script>
                alert('Login successful! Welcome, {$user['username']}');
                window.location.href='../pages/customer-data.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Incorrect password. Please try again.');
                window.location.href='../pages/sign-in.php';
              </script>";
        exit;
    }
}

// If accessed directly without POST
header("Location: ../pages/sign-in.php");
exit;
?>