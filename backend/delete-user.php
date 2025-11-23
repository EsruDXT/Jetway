<?php
require_once "config/db-connection.php";

if (!isset($_GET['id'])) {
    die("User ID missing.");
}

$id = intval($_GET['id']);

$delete = $connection->prepare("DELETE FROM user_login WHERE id=?");
$delete->bind_param("i", $id);
$delete->execute();

header("Location: ../pages/management-users.php?deleted=1");
exit();
?>