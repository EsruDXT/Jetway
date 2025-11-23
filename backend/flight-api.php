<?php
session_start();
require_once __DIR__ . '/../backend/config/db-connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'get_flight') {
        $flight_id = intval($_POST['flight_id']);

        $query = $connection->prepare("SELECT * FROM flights WHERE flight_id = ?");
        $query->bind_param("i", $flight_id);
        $query->execute();

        $result = $query->get_result()->fetch_assoc();

        if ($result) {
            echo json_encode(["status" => "success", "data" => $result]);
        } else {
            echo json_encode(["status" => "error", "message" => "Flight not found"]);
        }
        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Invalid request"]);
