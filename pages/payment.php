<?php
session_start();
require_once '../backend/config/db-connection.php';

// ============================
// CEK LOGIN
// ============================
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ============================
// GET booking_id
// ============================
$booking_id = 0;
if (isset($_GET['booking_id'])) $booking_id = intval($_GET['booking_id']);
if (isset($_POST['booking_id'])) $booking_id = intval($_POST['booking_id']);

if ($booking_id <= 0) die("Booking ID missing");

// ============================
// GET flight_id
// ============================
$flight_id = 0;
if (isset($_GET['flight_id'])) $flight_id = intval($_GET['flight_id']);
if (isset($_POST['flight_id'])) $flight_id = intval($_POST['flight_id']);

if ($flight_id <= 0) die("Invalid Flight ID");

// ============================
// AMBIL DATA FLIGHT
// ============================
$query = $connection->prepare("SELECT * FROM flights WHERE flight_id = ?");
$query->bind_param("i", $flight_id);
$query->execute();
$flight = $query->get_result()->fetch_assoc();

if (!$flight) die("Flight not found");

// ============================
// HARGA & VOUCHER
// ============================
$original_price = $flight['price'];
$insurance = 225000;
$total = $original_price + $insurance;

$voucher_code = "";
$discount_value = 0;
$voucher_error = "";

// ============================
// APPLY VOUCHER
// ============================
if (isset($_POST['apply_voucher'])) {

    $voucher_code = trim($_POST['voucher_code']);

    $voucherQuery = $connection->prepare("
        SELECT * FROM vouchers 
        WHERE code = ? 
        AND is_active = 1 
        AND expires_at > NOW()
    ");
    $voucherQuery->bind_param("s", $voucher_code);
    $voucherQuery->execute();
    $voucher = $voucherQuery->get_result()->fetch_assoc();

    if ($voucher) {

        if ($voucher['discount_amount'] > 0) {
            $discount_value = $voucher['discount_amount'];
        } elseif ($voucher['discount_percent'] > 0) {
            $discount_value = ($voucher['discount_percent'] / 100) * $total;
            if ($voucher['max_discount'] > 0 && $discount_value > $voucher['max_discount']) {
                $discount_value = $voucher['max_discount'];
            }
        }

        if ($discount_value > $total) $discount_value = $total;

        $total -= $discount_value;

    } else {
        $voucher_error = "Invalid or expired voucher";
    }
}

// ============================
// SIMPAN TOTAL FINAL KE SESSION
// ============================
$_SESSION['final_total'] = $total;
$_SESSION['applied_voucher'] = $voucher_code;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="/styles/payment.css">
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="main-container">
<div class="outer-panel">

    <div class="ticket-header" style="text-align:center; margin-bottom:24px;">
      <div class="progress-steps">
        <div class="step"><div class="step-number">1</div><div class="step-text">Ticket Information</div></div>
        <div class="step-line"></div>
        <div class="step"><div class="step-number">2</div><div class="step-text">Customer Data Input</div></div>
        <div class="step-line"></div>
        <div class="step"><div class="step-number active">3</div><div class="step-text">Payment</div></div>
      </div>
    </div>

    <!-- ==================== -->
    <!-- SUBTOTAL + DETAILS   -->
    <!-- ==================== -->

    <div class="content-grid">

      <div class="card payment-card">
        <h2 class="section-title">Payment Methods</h2>
        <div class="payment-option"><div class="payment-icon"><i class="fa-regular fa-credit-card"></i></div><span>Credit & Debit Cards</span></div>
        <div class="payment-option"><div class="payment-icon"><i class="fa-solid fa-wallet"></i></div><span>Digital Wallets</span></div>
        <div class="payment-option"><div class="payment-icon"><i class="fa-solid fa-building-columns"></i></div><span>Bank Transfer</span></div>
      </div>

      <div class="card subtotal-card">
        <h2 class="section-title">Subtotal</h2>

        <div class="price-details">
          <div class="price-row"><span>Original Price</span><span>Rp <?= number_format($original_price, 0, ',', '.') ?></span></div>
          <div class="price-row"><span>Travel Insurance</span><span>Rp <?= number_format($insurance, 0, ',', '.') ?></span></div>

          <?php if ($discount_value > 0): ?>
          <div class="price-row" style="color:green;">
            <span>Voucher Discount</span>
            <span>- Rp <?= number_format($discount_value, 0, ',', '.') ?></span>
          </div>
          <?php endif; ?>
        </div>

        <div class="total-section">
          <div class="total-row">
            <span>Total</span>
            <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
          </div>
        </div>

      </div>

    </div>

    <!-- ==================== -->
    <!-- APPLY VOUCHER FORM   -->
    <!-- ==================== -->
    <form method="POST" action="payment.php?booking_id=<?= $booking_id ?>&flight_id=<?= $flight_id ?>">
        <div class="card voucher-card">
            <div class="voucher-icon"><i class="fa-solid fa-ticket"></i></div>

            <input type="text" class="voucher-input" name="voucher_code"
                   placeholder="Type your voucher code"
                   value="<?= htmlspecialchars($voucher_code) ?>">

            <button type="submit" name="apply_voucher" class="confirm-btn">
                Apply
            </button>
        </div>
    </form>

    <?php if ($voucher_error): ?>
      <p style="color:red; text-align:center;"><?= $voucher_error ?></p>
    <?php endif; ?>

    <!-- ==================== -->
    <!-- CONFIRM PAYMENT FORM -->
    <!-- ==================== -->
    <form method="POST" action="/pages/confirmed.php">
        <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
        <input type="hidden" name="flight_id" value="<?= $flight_id ?>">

        <button type="submit" name="confirm_payment" class="confirm-btn">
            Confirm
        </button>
    </form>

</div>
</div>

</body>
</html>
