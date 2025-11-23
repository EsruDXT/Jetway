<?php
require_once "config/db-connection.php";

if (!isset($_POST['booking_id'])) {
    die("Invalid request.");
}

$booking_id  = intval($_POST['booking_id']);
$user_id     = intval($_POST['user_id']);
$flight_id   = intval($_POST['flight_id']);
$status      = $_POST['status'];
$total_price = floatval($_POST['total_price']);

$query = $connection->prepare("
    UPDATE bookings
    SET user_id = ?, flight_id = ?, status = ?, total_price = ?
    WHERE id = ?
");

$query->bind_param("iisdi", 
    $user_id, 
    $flight_id, 
    $status, 
    $total_price, 
    $booking_id
);

$query->execute();

header("Location: ../pages/management-flights.php");
exit;
?>
