<?php
session_start();
require_once 'config/db-connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    // Process payment
    if ($action === 'process_payment') {
        $booking_id = intval($_POST['booking_id']);
        $payment_method = htmlspecialchars(trim($_POST['payment_method']));
        $voucher_code = isset($_POST['voucher_code']) ? htmlspecialchars(trim($_POST['voucher_code'])) : '';
        
        // Get booking details
        $booking_query = $connection->prepare("
            SELECT * FROM bookings WHERE id = ? AND user_id = ?
        ");
        $booking_query->bind_param('ii', $booking_id, $user_id);
        $booking_query->execute();
        $booking_result = $booking_query->get_result();
        
        if ($booking_result->num_rows === 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Booking not found'
            ]);
            exit;
        }
        
        $booking = $booking_result->fetch_assoc();
        $final_amount = $booking['total_price'];
        
        // Apply voucher if provided
        $discount = 0;
        if (!empty($voucher_code)) {
            $voucher_query = $connection->prepare("
                SELECT * FROM vouchers 
                WHERE code = ? AND is_active = 1 
                AND (expiry_date IS NULL OR expiry_date >= CURDATE())
            ");
            $voucher_query->bind_param('s', $voucher_code);
            $voucher_query->execute();
            $voucher_result = $voucher_query->get_result();
            
            if ($voucher_result->num_rows > 0) {
                $voucher = $voucher_result->fetch_assoc();
                
                if ($voucher['discount_type'] === 'percentage') {
                    $discount = ($final_amount * $voucher['discount_value']) / 100;
                } else {
                    $discount = $voucher['discount_value'];
                }
                
                $final_amount -= $discount;
            }
        }
        
        // Generate transaction ID
        $transaction_id = 'TRX' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 12));
        
        // Insert payment record
        $payment_query = $connection->prepare("
            INSERT INTO payments 
            (booking_id, transaction_id, payment_method, amount, discount, 
             final_amount, voucher_code, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'completed', NOW())
        ");
        
        $payment_query->bind_param('issddds',
            $booking_id, $transaction_id, $payment_method, 
            $booking['total_price'], $discount, $final_amount, $voucher_code
        );
        
        if ($payment_query->execute()) {
            // Update booking status
            $update_booking = $connection->prepare("
                UPDATE bookings SET status = 'confirmed', payment_status = 'paid' 
                WHERE id = ?
            ");
            $update_booking->bind_param('i', $booking_id);
            $update_booking->execute();
            
            // Update flight available seats
            $update_seats = $connection->prepare("
                UPDATE flights SET available_seats = available_seats - ? 
                WHERE id = ?
            ");
            $update_seats->bind_param('ii', $booking['passenger_count'], $booking['flight_id']);
            $update_seats->execute();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Payment processed successfully',
                'transaction_id' => $transaction_id,
                'booking_code' => $booking['booking_code']
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Payment processing failed'
            ]);
        }
        exit;
    }
    
    // Validate voucher
    if ($action === 'validate_voucher') {
        $voucher_code = htmlspecialchars(trim($_POST['voucher_code']));
        $amount = floatval($_POST['amount']);
        
        $query = $connection->prepare("
            SELECT * FROM vouchers 
            WHERE code = ? AND is_active = 1 
            AND (expiry_date IS NULL OR expiry_date >= CURDATE())
        ");
        $query->bind_param('s', $voucher_code);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $voucher = $result->fetch_assoc();
            
            $discount = 0;
            if ($voucher['discount_type'] === 'percentage') {
                $discount = ($amount * $voucher['discount_value']) / 100;
            } else {
                $discount = $voucher['discount_value'];
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Voucher applied successfully',
                'discount' => $discount,
                'discount_type' => $voucher['discount_type']
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid or expired voucher'
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