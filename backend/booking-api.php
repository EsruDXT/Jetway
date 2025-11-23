<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../backend/config/db-connection.php';

// Check user authentication
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // =============================
    // CREATE BOOKING
    // =============================
    if ($action === 'create_booking') {
        $flight_id = intval($_POST['flight_id']);
        $passenger_count = intval($_POST['passenger_count']);

        $travel_insurance = isset($_POST['travel_insurance']) ? 225000 : 0;
        $baggage_protection = isset($_POST['baggage_protection']) ? 30000 : 0;
        $delay_compensation = isset($_POST['delay_compensation']) ? 200000 : 0;

        if ($flight_id <= 0 || $passenger_count <= 0) {
            echo json_encode(["status" => "error", "message" => "Invalid input"]);
            exit;
        }

        // GET FLIGHT DATA
        $flight_query = $connection->prepare("SELECT price, available_seats FROM flights WHERE flight_id = ?");
        $flight_query->bind_param("i", $flight_id);
        $flight_query->execute();
        $flight = $flight_query->get_result()->fetch_assoc();

        if (!$flight) {
            echo json_encode(["status" => "error", "message" => "Flight not found"]);
            exit;
        }

        if ($flight['available_seats'] < $passenger_count) {
            echo json_encode(["status" => "error", "message" => "Not enough seats"]);
            exit;
        }

        // PRICE CALC
        $base_price = $flight['price'] * $passenger_count;
        $insurance_price = $travel_insurance * $passenger_count;
        $baggage_price = $baggage_protection * $passenger_count;
        $delay_price = $delay_compensation * $passenger_count;
        $total_price = $base_price + $insurance_price + $baggage_price + $delay_price;

        $booking_code = "JW" . strtoupper(substr(md5(time() . rand()), 0, 10));

        // START DATABASE TRANSACTION
        $connection->begin_transaction();

        try {
            // INSERT BOOKING
            $insert_booking = $connection->prepare("
                INSERT INTO bookings 
                (user_id, flight_id, passenger_count, base_price, insurance_price, baggage_price, delay_price, booking_code, total_price, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
            ");
            $insert_booking->bind_param(
                "iiiddddsd",
                $user_id, $flight_id, $passenger_count, $base_price,
                $insurance_price, $baggage_price, $delay_price,
                $booking_code, $total_price
            );
            $insert_booking->execute();

            $booking_id = $connection->insert_id;

            // REDUCE SEAT COUNT
            $update_seat = $connection->prepare("
                UPDATE flights SET available_seats = available_seats - ? WHERE flight_id = ?
            ");
            $update_seat->bind_param("ii", $passenger_count, $flight_id);
            $update_seat->execute();

            $connection->commit();

            echo json_encode([
                "status" => "success",
                "booking_id" => $booking_id,
                "booking_code" => $booking_code,
                "total_price" => $total_price,
                "payment_url" => "/pages/payment.php?booking_id=" . $booking_id
            ]);

        } catch (Exception $e) {
            $connection->rollback();
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }

        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
