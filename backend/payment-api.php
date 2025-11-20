<?php
session_start();
header('Content-Type: application/json');
require_once 'config/db-connection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    // Process payment
    if ($_POST['action'] === 'process_payment') {
        $booking_id = intval($_POST['booking_id']);
        $payment_method = htmlspecialchars($_POST['payment_method']);
        $voucher_code = isset($_POST['voucher_code']) ? htmlspecialchars($_POST['voucher_code']) : '';
        
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
        $amount = $booking['total_price'];
        $discount = 0;
        
        // Validate voucher if provided
        if (!empty($voucher_code)) {
            $voucher_query = $connection->prepare("
                SELECT discount_percentage, max_discount FROM vouchers 
                WHERE code = ? AND is_active = 1 AND expires_at > NOW()
            ");
            
            $voucher_query->bind_param('s', $voucher_code);
            $voucher_query->execute();
            $voucher_result = $voucher_query->get_result();
            
            if ($voucher_result->num_rows > 0) {
                $voucher = $voucher_result->fetch_assoc();
                $discount = min(
                    ($amount * $voucher['discount_percentage']) / 100,
                    $voucher['max_discount']
                );
                $amount -= $discount;
            }
        }
        
        // Generate transaction ID
        $transaction_id = 'TRX' . strtoupper(uniqid());
        
        // Create payment record
        $payment_insert = $connection->prepare("
            INSERT INTO payments 
            (booking_id, transaction_id, payment_method, amount, 
             discount_amount, voucher_code, status, created_at)
            VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())
        ");
        
        $payment_insert->bind_param('issdis',
            $booking_id, $transaction_id, $payment_method,
            $amount, $discount, $voucher_code
        );
        
        if ($payment_insert->execute()) {
            $payment_id = $payment_insert->insert_id;
            
            // Simulate payment processing
            // In production, integrate with payment gateway (Stripe, Midtrans, etc.)
            
            // Update booking status
            $update_booking = $connection->prepare("
                UPDATE bookings SET status = 'completed' WHERE id = ?
            ");
            
            $update_booking->bind_param('i', $booking_id);
            $update_booking->execute();
            
            // Update payment status
            $update_payment = $connection->prepare("
                UPDATE payments SET status = 'completed' WHERE id = ?
            ");
            
            $update_payment->bind_param('i', $payment_id);
            $update_payment->execute();
            
            echo json_encode([
                'status' => 'success',
                'transaction_id' => $transaction_id,
                'booking_code' => $booking['booking_code'],
                'amount_paid' => $amount,
                'message' => 'Payment processed successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to process payment'
            ]);
        }
        exit;
    }
    
    // Validate voucher
    if ($_POST['action'] === 'validate_voucher') {
        $voucher_code = htmlspecialchars($_POST['voucher_code']);
        $amount = floatval($_POST['amount']);
        
        $query = $connection->prepare("
            SELECT discount_percentage, max_discount FROM vouchers 
            WHERE code = ? AND is_active = 1 AND expires_at > NOW()
        ");
        
        $query->bind_param('s', $voucher_code);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $voucher = $result->fetch_assoc();
            $discount = min(
                ($amount * $voucher['discount_percentage']) / 100,
                $voucher['max_discount']
            );
            
            echo json_encode([
                'status' => 'success',
                'discount' => $discount,
                'discount_percentage' => $voucher['discount_percentage'],
                'message' => 'Voucher is valid'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Voucher not found or expired'
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