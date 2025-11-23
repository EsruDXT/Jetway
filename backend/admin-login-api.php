<?php
session_start();
require_once "config/db-connection.php";

// Ambil JSON dari fetch()
$data = json_decode(file_get_contents("php://input"), true);

$username = $data["username"] ?? "";
$password = $data["password"] ?? "";

// Query admin
$query = $connection->prepare("SELECT * FROM admin_login WHERE username = ? AND password = ?");
$query->bind_param("ss", $username, $password);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    $_SESSION["is_admin"] = true;
    $_SESSION["admin_name"] = $admin["full_name"];

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>
