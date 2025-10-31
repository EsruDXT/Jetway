<?php
require_once 'config/db-connection.php';

if (isset($_POST['Confirm'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['confirm_password'];

    if ($password !== $passwordConfirmation) {
        echo "<script>
                alert('Password and confirmation do not match');
                window.location.href='../../pages/sign-up.php';
              </script>";
        exit;
    }

    $check = $connection->prepare("SELECT * FROM user_login WHERE username = ? OR email = ?");
    $check->bind_param('ss', $username, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username or email already exists. Please use another one.');
                window.location.href='../../pages/sign-up.php';
              </script>";
        exit;
    }

    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

    
    $query = "INSERT INTO user_login (username, email, password) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('sss', $username, $email, $passwordHashed);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header('Location: ../../pages/sign-in.php');
        exit;
    } else {
        echo "<script>
                alert('Error registering user');
                window.location.href='../../pages/sign-up.php';
              </script>";
        exit;
    }
}
?>