<?php
session_start();
require_once '../backend/config/db-connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$flight_id = intval($_POST['flight_id']);

if ($flight_id <= 0) {
    die("Invalid flight ID");
}

// Ambil harga flight
$q = $connection->prepare("SELECT price FROM flights WHERE flight_id = ?");
$q->bind_param("i", $flight_id);
$q->execute();
$flight = $q->get_result()->fetch_assoc();

if (!$flight) {
    die("Flight not found");
}

$price = $flight['price'];

// Generate booking code
$bookingCode = "JW" . strtoupper(substr(md5(uniqid()), 0, 10));

// Insert booking
$stmt = $connection->prepare("
    INSERT INTO bookings (user_id, flight_id, passenger_count, base_price, insurance_price, total_price, booking_code)
    VALUES (?, ?, 1, ?, 0, ?, ?)
");
$stmt->bind_param("iidss",
    $user_id,
    $flight_id,
    $price,
    $price,
    $bookingCode
);

$stmt->execute();
$booking_id = $stmt->insert_id;

// Redirect ke payment
header("Location: ../pages/payment.php?booking_id=$booking_id&flight_id=$flight_id");
exit();
