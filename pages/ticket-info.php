<?php
session_start();

// include DB connection (sesuaikan path jika perlu)
include __DIR__ . "/../backend/config/db-connection.php";

// fallback variable: beberapa file koneksi memakai $connection, beberapa $conn
$db = null;
if (isset($connection)) $db = $connection;
elseif (isset($conn)) $db = $conn;
else {
    // kalau tidak ada, abort dan beri petunjuk
    die("Database connection not found. Check db-connection.php path and variable name.");
}

// Pastikan flight_id dari URL
if (!isset($_GET['flight_id'])) {
    die("Flight ID not found.");
}
$flight_id = intval($_GET['flight_id']);
if ($flight_id <= 0) {
    die("Invalid Flight ID.");
}

// Query flight data (gunakan prepared statement)
$stmt = $db->prepare("SELECT * FROM flights WHERE flight_id = ?");
if (!$stmt) {
    die("DB prepare failed: " . htmlspecialchars($db->error));
}
$stmt->bind_param("i", $flight_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Invalid Flight ID.");
}
$flight = $result->fetch_assoc();

// simpan selection di session (berguna diteruskan ke next page)
$_SESSION['selected_flight_id'] = $flight_id;

// harga dan insurance wajib (sesuai kesepakatan)
$insurance = 225000;
$price = isset($flight['price']) ? (int)$flight['price'] : 0;
$total_price = $price + $insurance;

// helper untuk echo aman
function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Ticket Information</title>
    <link rel="stylesheet" href="/styles/ticket-info.css" />
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  
  <main class="ticket-info-container">
    <div class="outer-panel">

      <div class="ticket-header" style="text-align:center; margin-bottom:24px;">
        <div class="progress-steps">
          <div class="step"><div class="step-number active">1</div><div class="step-text">Ticket Information</div></div>
          <div class="step-line"></div>
          <div class="step"><div class="step-number">2</div><div class="step-text">Customer Data Input</div></div>
          <div class="step-line"></div>
          <div class="step"><div class="step-number">3</div><div class="step-text">Payment</div></div>
        </div>
      </div>

      <!-- FLIGHT TICKET INFO -->
      <div class="flight-row">
        <div style="display:flex; gap:16px; align-items:center;">
          <div class="flight-left">
            <div class="tag">Departure</div>

            <!-- route: tampilkan departure city + airport dan arrival -->
            <div class="route" id="route">
              <?= e($flight['departure_city'] ?? $flight['departure_airport']) ?> - <?= e($flight['arrival_city'] ?? $flight['arrival_airport']) ?>
            </div>
          </div>

          <div class="flight-right">
            <div class="times">
              <div>
                <div class="time" id="departure-time"><?= e($flight['departure_time']) ?></div>
                <div class="location" id="departure-loc">
                  <?= e(($flight['departure_city'] ? $flight['departure_city'] . ' - ' : '') . ($flight['departure_airport'] ?? '')) ?>
                </div>
              </div>

              <div style="text-align:center; color:#6b7280;">
                <div id="flight-type"><?= e($flight['flight_type'] ?? 'Direct') ?></div>
                <div style="margin-top:6px;" id="duration"><?= e($flight['duration'] ?? '') ?></div>
              </div>

              <div>
                <div class="time" id="arrival-time"><?= e($flight['arrival_time']) ?></div>
                <div class="location" id="arrival-loc">
                  <?= e(($flight['arrival_city'] ? $flight['arrival_city'] . ' - ' : '') . ($flight['arrival_airport'] ?? '')) ?>
                </div>
              </div>
            </div>

            <!-- airline logo: jika kolom airline_logo berisi path/URL -->
            <?php if (!empty($flight['airline_logo'])): ?>
              <img id="airline-logo" src="<?= e($flight['airline_logo']) ?>" style="height:36px;" alt="<?= e($flight['airline']) ?>">
            <?php else: ?>
              <!-- fallback: tampilkan nama airline jika logo tidak ada -->
              <div style="font-weight:600; margin-left:8px;"><?= e($flight['airline'] ?? '') ?></div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- (Optional) Return static area left as-is so layout unchanged -->
      <div class="flight-row">
        <div style="display:flex; gap:16px; align-items:center;">
          <div class="flight-left">
            <div class="tag">Return</div>
            <div class="route">Singapore-Jakarta</div>
          </div>

          <div class="flight-right">
            <div class="times">
              <div><div class="time">11:40</div><div class="location">Singapore - SIN</div></div>
              <div style="text-align:center; color:#6b7280;"><div>Direct</div><div style="margin-top:6px;">2h55m</div></div>
              <div><div class="time">14:35</div><div class="location">Jakarta - CGK</div></div>
            </div>
            <div class="price">Rp. <?= number_format($price, 0, ',', '.') ?></div>
          </div>
        </div>
      </div>

      <!-- INSURANCE + TOTAL -->
      <div class="insurance-list">
        <div class="insurance-option">
          <div style="display:flex; gap:12px;">
            <div class="icon-box"><i class="fas fa-shield-alt"></i></div>
            <div class="insurance-details">
              <div style="font-weight:600;">Travel Insurance</div>
              <div style="font-size:13px;">Accident up to IDR 500.000.000<br>Delay up to IDR 8.000.000</div>
            </div>
          </div>
          <div style="color:#2e85d8; font-weight:700;">
            Rp. <?= number_format($insurance, 0, ',', '.') ?>
          </div>
        </div>

        <div class="subtotal-row" style="margin-top:16px;">
          <div style="font-weight:700;">Subtotal</div>
          <div id="total-price" style="font-size:20px; color:#2e85d8; font-weight:800;">
            Rp <?= number_format($total_price, 0, ',', '.') ?>
          </div>
        </div>

        <!-- Confirm: tetap di ticket-info -> lanjut ke customer data -->
        <button class="confirm-button" onclick="location.href='customer-data-input.php?flight_id=<?= $flight_id ?>'">Confirm</button>
        <p style="text-align:center; font-size:13px; color:#6b7280; margin-top:8px;">
          By confirming, you agree to our <a href="#">Terms & Conditions</a>
        </p>
      </div>

    </div>
  </main>

  <!-- jika perlu, kamu bisa menambahkan script khusus; tapi tidak wajib -->
  <script src=></script>
</body>
</html>
