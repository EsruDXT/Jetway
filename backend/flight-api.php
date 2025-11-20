<?php
session_start();
header('Content-Type: application/json');
require_once 'config/db-connection.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

// ===============================
// STATIC FLIGHT LIST (MATCH flight.php UI)
// ===============================
$flights = [
    1 => [
        "airline" => "Batik Air",
        "price" => 3500000,
        "available_seats" => 50,
        "departure_airport" => "CGK",
        "arrival_airport" => "SIN",
        "departure_time" => "11:40",
        "arrival_time" => "14:35",
        "class" => "Economy",
        "baggage" => 16,
        "cabin" => 7,
        "duration" => "1h45m"
    ],
    2 => [
        "airline" => "Lion Air",
        "price" => 2100000,
        "available_seats" => 90,
        "departure_airport" => "CGK",
        "arrival_airport" => "SIN",
        "departure_time" => "07:00",
        "arrival_time" => "11:35",
        "class" => "Economy",
        "baggage" => 15,
        "cabin" => 7,
        "duration" => "1h45m"
    ],
    3 => [
        "airline" => "Garuda Air",
        "price" => 5800000,
        "available_seats" => 40,
        "departure_airport" => "CGK",
        "arrival_airport" => "SIN",
        "departure_time" => "03:30",
        "arrival_time" => "05:45",
        "class" => "Premium Economy",
        "baggage" => 15,
        "cabin" => 7,
        "duration" => "1h45m"
    ],
    4 => [
        "airline" => "Citilink",
        "price" => 2800000,
        "available_seats" => 60,
        "departure_airport" => "CGK",
        "arrival_airport" => "SIN",
        "departure_time" => "04:50",
        "arrival_time" => "06:10",
        "class" => "Economy",
        "baggage" => 7,
        "cabin" => 7,
        "duration" => "1h40m"
    ],
    5 => [
        "airline" => "Sriwijaya Air",
        "price" => 11700000,
        "available_seats" => 30,
        "departure_airport" => "CGK",
        "arrival_airport" => "SIN",
        "departure_time" => "12:00",
        "arrival_time" => "14:05",
        "class" => "Economy",
        "baggage" => 20,
        "cabin" => 7,
        "duration" => "1h45m"
    ]
];

// ===============================
// HANDLE ACTIONS
// ===============================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // ---------- GET FLIGHT DETAILS ----------
    if ($_POST['action'] === 'get_flight') {
        $flight_id = intval($_POST['flight_id']);

        if (!isset($flights[$flight_id])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Flight not found'
            ]);
            exit;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $flights[$flight_id]
        ]);
        exit;
    }

    // ---------- CREATE BOOKING ----------
    if ($_POST['action'] === 'create_booking') {

        $flight_id = intval($_POST['flight_id']);
        $passenger_count = intval($_POST['passenger_count']);

        if (!isset($flights[$flight_id])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Flight not found'
            ]);
            exit;
        }

        $flight = $flights[$flight_id];

        if ($passenger_count <= 0 || $passenger_count > $flight["available_seats"]) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Not enough seats available'
            ]);
            exit;
        }

        // Insurance options
        $travel_ins = isset($_POST['travel_insurance']) ? 225000 : 0;
        $baggage_prot = isset($_POST['baggage_protection']) ? 30000 : 0;
        $delay_comp = isset($_POST['delay_compensation']) ? 200000 : 0;

        $base_price = $flight["price"] * $passenger_count;
        $insurance_price = $travel_ins * $passenger_count;
        $baggage_price = $baggage_prot * $passenger_count;
        $delay_price = $delay_comp * $passenger_count;

        $total_price = $base_price + $insurance_price + $baggage_price + $delay_price;

        $booking_code = "BK" . strtoupper(uniqid());

        // SAVE TO DATABASE
        $q = $connection->prepare("
            INSERT INTO bookings
            (user_id, flight_id, booking_code, passenger_count, base_price,
             insurance_price, baggage_price, delay_price, total_price, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())
        ");

        $q->bind_param(
            "iisiiiiii",
            $user_id, $flight_id, $booking_code, $passenger_count,
            $base_price, $insurance_price, $baggage_price, $delay_price, $total_price
        );

        if ($q->execute()) {
            echo json_encode([
                'status' => 'success',
                'booking_id' => $q->insert_id,
                'booking_code' => $booking_code,
                'total_price' => $total_price
            ]);
        } else {

            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to create booking'
            ]);
        }

        exit;
    }
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
?>
