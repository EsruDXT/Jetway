<?php
session_start();
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
  <header class="nav">
    <div class="nav-left">
      <a class="logo1" href="Homepage.php">JetWay</a>
    </div>

    <div class="searchbar">
      <input type="search" placeholder="Search..." />
      <button><img src="/FOTO/search button.png" width="24"></button>
      <button><img src="/FOTO/icon mikrofon.png" width="18"></button>
    </div>

    <nav class="nav-links">
      <a href="Homepage.php">Home</a>
      <a href="Flights.php">Flights</a>
      <a href="ticket-info.php" class="active">My Booking</a>
      <a href="support.php">Support</a>
      <img src="/FOTO/notif.png" width="35">
      <img src="/FOTO/bendera indo.png" width="40">
      <i class="fas fa-chevron-down"></i>
      <a href="sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

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
            <div class="route" id="route"></div>
          </div>

          <div class="flight-right">
            <div class="times">
              <div>
                <div class="time" id="departure-time"></div>
                <div class="location" id="departure-loc"></div>
              </div>

              <div style="text-align:center; color:#6b7280;">
                <div>Direct</div>
                <div style="margin-top:6px;">1h45m</div>
              </div>

              <div>
                <div class="time" id="arrival-time"></div>
                <div class="location" id="arrival-loc"></div>
              </div>
            </div>
            <img id="airline-logo" src="/FOTO/batik-air-logo.png" style="height:36px;">
          </div>
        </div>
      </div>

      <!-- RETURN STATIC (optional) -->
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
            <div class="price">Rp. 3.500.000</div>
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
          <div style="color:#2e85d8; font-weight:700;">Rp. 225.000/pax</div>
        </div>

        <div class="subtotal-row">
          <div style="font-weight:700;">Subtotal</div>
          <div id="total-price" style="font-size:20px; color:#2e85d8; font-weight:800;">
            Loading...
          </div>
        </div>

        <button class="confirm-button" onclick="location.href='customer-data-input.php'">Confirm</button>
        <p style="text-align:center; font-size:13px; color:#6b7280; margin-top:8px;">By confirming, you agree to our <a href="#">Terms & Conditions</a></p>
      </div>

    </div>
  </main>

  <!-- External JS -->
  <script src="/scripts/ticket-info.js"></script>
</body>
</html>
