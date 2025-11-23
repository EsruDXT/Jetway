<?php
require_once "config/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

$user_id     = intval($_POST['user_id']);
$username    = $_POST['username'];
$email       = $_POST['email'];
$first_name  = $_POST['first_name'];
$last_name   = $_POST['last_name'];
$city        = $_POST['city'];
$phone       = $_POST['phone'];

// --------------------------
// UPDATE USER LOGIN
// --------------------------
$updateLogin = $connection->prepare("
    UPDATE user_login 
    SET username = ?, email = ?
    WHERE id = ?
");
$updateLogin->bind_param("ssi", $username, $email, $user_id);
$updateLogin->execute();

// --------------------------
// CEK APAKAH PROFILE ADA
// --------------------------
$check = $connection->prepare("SELECT user_id FROM user_profile WHERE user_id = ?");
$check->bind_param("i", $user_id);
$check->execute();
$profileExists = $check->get_result()->num_rows > 0;

// --------------------------
// INSERT / UPDATE PROFILE
// --------------------------
if ($profileExists) {
    // UPDATE
    $updateProfile = $connection->prepare("
        UPDATE user_profile
        SET first_name = ?, last_name = ?, city = ?, phone = ?
        WHERE user_id = ?
    ");

    $updateProfile->bind_param("ssssi",
        $first_name, $last_name, $city, $phone, $user_id
    );
    $updateProfile->execute();
} else {
    // INSERT BARU
    $insertProfile = $connection->prepare("
        INSERT INTO user_profile (user_id, first_name, last_name, city, phone)
        VALUES (?, ?, ?, ?, ?)
    ");

    $insertProfile->bind_param("issss",
        $user_id, $first_name, $last_name, $city, $phone
    );
    $insertProfile->execute();
}

// --------------------------
// SELESAI → KEMBALI
// --------------------------

header("Location: ../pages/management-users.php?updated=1");
exit();
?>
