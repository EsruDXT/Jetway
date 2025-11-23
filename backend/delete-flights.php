<?php
require_once "config/db-connection.php";

if (!isset($_GET['id'])) {
    die("Booking ID missing.");
}

$booking_id = intval($_GET['id']);

// 1. Hapus payment jika ada (AMAN karena tidak menyentuh user_login)
$deletePayment = $connection->prepare("
    DELETE FROM payments WHERE booking_id = ?
");
$deletePayment->bind_param("i", $booking_id);
$deletePayment->execute();

// 2. Hapus booking utama
$deleteBooking = $connection->prepare("
    DELETE FROM bookings WHERE id = ?
");
$deleteBooking->bind_param("i", $booking_id);

if ($deleteBooking->execute()) {
    header("Location: ../pages/management-flights.php?deleted=success");
    exit();
} else {
    die("Failed to delete booking: " . $connection->error);
}
