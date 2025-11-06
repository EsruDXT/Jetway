<?php
session_start();
require_once 'config/db-connection.php';


if (isset($_SESSION['user_id'])) {
    echo "<script>
            alert('You are already logged in!');
            window.location.href='../../pages/Homepage.php';
          </script>";
    exit;
}

if (isset($_POST['confirm-btn'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];


    $query = $connection->prepare("SELECT * FROM user_login WHERE email = ?");
    $query->bind_param('s', $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
        echo "<script>
                alert('Email not found.');
                window.location.href='../../pages/sign-in.php';
              </script>";
        exit;
    }

    $user = $result->fetch_assoc();


    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        echo "<script>
                alert('Login successful! Welcome, {$user['username']}');
                window.location.href='../../pages/customer-data.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Incorrect password.');
                window.location.href='../../pages/sign-in.php';
              </script>";
        exit;
    }
}
?>