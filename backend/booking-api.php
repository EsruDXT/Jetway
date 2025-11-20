<?php
session_start();
require_once 'config/db-connection.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    // Create booking
    if ($action === 'create_booking') {
        try {
            $flight_id = intval($_POST['flight_id']);
            $passenger_count = intval($_POST['passenger_count']);
            $travel_insurance = isset($_POST['travel_insurance']) ? 1 : 0;
            $baggage_protection = isset($_POST['baggage_protection']) ? 1 : 0;
            $delay_compensation = isset($_POST['delay_compensation']) ? 1 : 0;
            
            // Validate input
            if ($flight_id <= 0 || $passenger_count <= 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid input data'
                ]);
                exit;
            }
            
            // Get flight details
            $flight_query = $connection->prepare("SELECT * FROM flights WHERE id = ?");
            $flight_query->bind_param('i', $flight_id);
            $flight_query->execute();
            $flight_result = $flight_query->get_result();
            
            if ($flight_result->num_rows === 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Flight not found'
                ]);
                exit;
            }
            
            $flight = $flight_result->fetch_assoc();
            
            // Check seat availability
            if ($flight['available_seats'] < $passenger_count) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Not enough seats available. Only ' . $flight['available_seats'] . ' seats left.'
                ]);
                exit;
            }
            
            // Calculate total price
            $base_price = $flight['price'] * $passenger_count;
            $addon_price = 0;
            
            if ($travel_insurance) $addon_price += 225000 * $passenger_count;
            if ($baggage_protection) $addon_price += 30000 * $passenger_count;
            if ($delay_compensation) $addon_price += 200000 * $passenger_count;
            
            $total_price = $base_price + $addon_price;
            
            // Generate unique booking code
            $booking_code = 'JW' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
            
            // Insert booking
            $insert_query = $connection->prepare("
                INSERT INTO bookings 
                (user_id, flight_id, booking_code, passenger_count, travel_insurance, 
                 baggage_protection, delay_compensation, total_price, status, payment_status, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'unpaid', NOW())
            ");
            
            $insert_query->bind_param('iisiiiid', 
                $user_id, $flight_id, $booking_code, $passenger_count,
                $travel_insurance, $baggage_protection, $delay_compensation, $total_price
            );
            
            if ($insert_query->execute()) {
                $booking_id = $connection->insert_id;
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Booking created successfully',
                    'booking_id' => $booking_id,
                    'booking_code' => $booking_code,
                    'total_price' => $total_price
                ]);
            } else {
                throw new Exception('Failed to insert booking: ' . $connection->error);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
    
    // Get booking details
    if ($action === 'get_booking') {
        $booking_id = intval($_POST['booking_id']);
        
        $query = $connection->prepare("
            SELECT b.*, f.*, 
                   u.email, u.username,
                   up.first_name, up.last_name
            FROM bookings b
            JOIN flights f ON b.flight_id = f.id
            JOIN user_login u ON b.user_id = u.id
            LEFT JOIN user_profile up ON u.id = up.user_id
            WHERE b.id = ? AND b.user_id = ?
        ");
        
        $query->bind_param('ii', $booking_id, $user_id);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode([
                'status' => 'success',
                'data' => $result->fetch_assoc()
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Booking not found'
            ]);
        }
        exit;
    }
    
    // Get user bookings (history)
    if ($action === 'get_user_bookings') {
        $query = $connection->prepare("
            SELECT b.*, 
                   f.departure_city, f.arrival_city, f.departure_time, 
                   f.arrival_time, f.flight_date, f.airline, f.flight_number
            FROM bookings b
            JOIN flights f ON b.flight_id = f.id
            WHERE b.user_id = ?
            ORDER BY b.created_at DESC
        ");
        
        $query->bind_param('i', $user_id);
        $query->execute();
        $result = $query->get_result();
        
        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => $bookings,
            'count' => count($bookings)
        ]);
        exit;
    }
    
    // Cancel booking
    if ($action === 'cancel_booking') {
        $booking_id = intval($_POST['booking_id']);
        
        // Get booking info first
        $check_query = $connection->prepare("
            SELECT * FROM bookings WHERE id = ? AND user_id = ?
        ");
        $check_query->bind_param('ii', $booking_id, $user_id);
        $check_query->execute();
        $result = $check_query->get_result();
        
        if ($result->num_rows === 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Booking not found'
            ]);
            exit;
        }
        
        $booking = $result->fetch_assoc();
        
        if ($booking['status'] === 'cancelled') {
            echo json_encode([
                'status' => 'error',
                'message' => 'Booking already cancelled'
            ]);
            exit;
        }
        
        // Update booking status
        $update_query = $connection->prepare("
            UPDATE bookings SET status = 'cancelled', updated_at = NOW() 
            WHERE id = ? AND user_id = ?
        ");
        $update_query->bind_param('ii', $booking_id, $user_id);
        
        if ($update_query->execute()) {
            // Return seats to flight if payment not completed
            if ($booking['payment_status'] !== 'paid') {
                $return_seats = $connection->prepare("
                    UPDATE flights SET available_seats = available_seats + ? 
                    WHERE id = ?
                ");
                $return_seats->bind_param('ii', $booking['passenger_count'], $booking['flight_id']);
                $return_seats->execute();
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Booking cancelled successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to cancel booking'
            ]);
        }
        exit;
    }
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request method'
]);
?>