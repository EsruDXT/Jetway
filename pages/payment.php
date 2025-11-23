<?php
session_start();
require_once '../backend/config/db-connection.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

// Ambil flight ID
$flight_id = isset($_GET['flight_id']) ? intval($_GET['flight_id']) : 0;
if ($flight_id <= 0) die("Invalid Flight ID");

$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if ($booking_id <= 0) {
    die("Booking ID missing");
}

// Ambil data flight
$query = $connection->prepare("SELECT * FROM flights WHERE flight_id = ?");
query->bind_param("i", $flight_id);
$query->execute();
$result = $query->get_result();
$flight = $result->fetch_assoc();
if (!$flight) die("Flight not found");

// Harga awal
$insurance = 225000;
$original_price = $flight['price'];
$total = $original_price + $insurance;

// Voucher
$voucher_code = "";
$discount_value = 0;
$voucher_error = "";

// Jika voucher di-apply
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

// Simpan ke session
$_SESSION['final_total'] = $total;
$_SESSION['applied_voucher'] = $voucher_code;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="/styles/payment.css" />
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./styles/main.css" rel="stylesheet" />
</head>
<body>
  <header class="nav">
    <div class="nav-left">
      <a class="logo1" id="logo" href="#Slideshow">JetWay</a>
        </div>
      <div class="searchbar">
        <input type="search" placeholder="Search..." />
        <button>
            <img src="/FOTO/search button.png" alt="iconcari" width="24" height="24">
        </button>
        <button>
            <img src="/FOTO/icon mikrofon.png" alt="iconmic" width="18" height="18">
        </button>
      </div>
    </div>
    <nav class="nav-links">
      <a href="Homepage.html">Home</a>
      <a href="Flights.html" class="active">Flights</a>
      <a href="#">My Booking</a>
      <a href="#">Support</a> 
      <img src="/FOTO/notif.png" alt="iconnotif" width="35">
      <img src="/FOTO/bendera indo.png" alt="iconbendera" width="40">
      <nav></nav>
      <i class="fas fa-chevron-down"></i>
      <a href="sign-in.html" class="btn ghost">Log In</a>
    </nav>
  </header>

<div class="main-container">
<div class="outer-panel">

    <!-- Header Progress -->
    <div class="ticket-header" style="text-align:center; margin-bottom:24px;">
      <div class="progress-steps">
        <div class="step">
          <div class="step-number">1</div>
          <div class="step-text">Ticket Information</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-number">2</div>
          <div class="step-text">Customer Data Input</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
          <div class="step-number active">3</div>
          <div class="step-text">Payment</div>
        </div>
      </div>
    </div>

    <!-- Flight Info Card -->
    <div class="card flight-card">
      <div class="flight-info-left">
        <div class="flight-time">11:40</div>
        <div class="flight-city">Jakarta - CGK</div>
      </div>

      <div class="flight-route">
        <div class="route-line-left"></div>

        <div class="route-center">
          <div class="plane-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M21 16V14L13 9V3.5C13 2.67 12.33 2 11.5 2C10.67 2 10 2.67 10 3.5V9L2 14V16L10 13.5V19L8 20.5V22L11.5 21L15 22V20.5L13 19V13.5L21 16Z" fill="#6B8AC6"/>
            </svg>
          </div>
          <div class="flight-label">Direct</div>
          <div class="flight-duration">1h45m</div>
        </div>

        <div class="route-line-right"></div>
      </div>

      <div class="flight-info-right">
        <div class="flight-time">14:35</div>
        <div class="flight-city">Singapore - SIN</div>
      </div>
    </div>

    <!-- Payment and Subtotal Container -->
    <div class="content-grid">

      <!-- Payment Methods Card -->
      <div class="card payment-card">
        <h2 class="section-title">Payment Methods</h2>

        <div class="payment-option">
          <div class="payment-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect x="3" y="6" width="18" height="12" rx="2" stroke="#5B7BA3" stroke-width="2"/>
              <rect x="3" y="9" width="18" height="3" fill="#5B7BA3"/>
            </svg>
          </div>
          <span>Credit & Debit Cards</span>
          <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M6 8L10 12L14 8" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div class="payment-option">
          <div class="payment-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <rect x="3" y="8" width="18" height="11" rx="2" stroke="#5B7BA3" stroke-width="2"/>
              <rect x="6" y="12" width="4" height="3" rx="1" fill="#5B7BA3"/>
              <line x1="13" y1="13" x2="18" y2="13" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round"/>
              <line x1="13" y1="16" x2="16" y2="16" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </div>
          <span>Digital Wallets</span>
          <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M6 8L10 12L14 8" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div class="payment-option">
          <div class="payment-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M7 10L12 5L17 10M7 14L12 19L17 14" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span>Bank Transfer</span>
          <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M6 8L10 12L14 8" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <!-- Subtotal Card -->
      <div class="card subtotal-card">
        <h2 class="section-title">Subtotal</h2>

        <div class="price-details">
          <div class="price-row">
            <span class="price-label">Original Price</span>
            <span class="price-value">Rp. 3.500.000</span>
          </div>
          <div class="price-row">
            <span class="price-label">Travel Insurance</span>
            <span class="price-value">Rp. 225.000</span>
          </div>
        </div>

        <div class="total-section">
          <div class="total-row">
            <span class="total-label">Total</span>
            <span class="total-value">Rp. 3.725.000</span>
          </div>
        </div>
      </div>
    </div>

    <div class="bottom-section">
      <div class="card voucher-card">
        <div class="voucher-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M20 6H4C2.89543 6 2 6.89543 2 8V10C3.10457 10 4 10.8954 4 12C4 13.1046 3.10457 14 2 14V16C2 17.1046 2.89543 18 4 18H20C21.1046 18 22 17.1046 22 16V14C20.8954 14 20 13.1046 20 12C20 10.8954 20.8954 10 22 10V8C22 6.89543 21.1046 6 20 6Z" stroke="#5B7BA3" stroke-width="2"/>
            <line x1="12" y1="9" x2="12" y2="15" stroke="#5B7BA3" stroke-width="2" stroke-linecap="round" stroke-dasharray="2 2"/>
          </svg>
        </div>
        <input type="text" class="voucher-input" placeholder="Type in your voucher code here">
      </div>

      <button class="confirm-btn">Confirm</button>
    </div>

  </div>
</div>


    
  <!-- Testimonials Section -->
   <div class="aboutus">
  <h2>What Our Customers Think About Us</h2>
  </div>
  <hr class="shadow-line"></hr>
  <section class="testimonial-section"></section>
  <!-- Tombol panah di luar slideshow -->

  <!-- Slideshow -->
  <div id="Slideshow" class="testimonial-container">
  <div class="testimonial-wrapper">
    <div class="controls">
    <button class="arrow prev" onclick="changeSlide(-1)">&#10094;</button>
  </div>
    <div class="testimonial">
      <div class="avatar">😊</div>
      <p>"Pemesanan Tiket Disini Sangat Cepat Intinya Gacor!"</p>
      <h4>Kenzo Rivaldo</h4>
      <div class="stars">★★★★★</div>
    </div>

    <div class="testimonial">
      <div class="avatar">😊</div>
      <p>"Definitely one of the best burgers in town!"</p>
      <h4>Marvin Arif Pratama</h4>
      <div class="stars">★★★★★</div>
    </div>

    <div class="testimonial">
      <div class="avatar">😊</div>
      <p>"Amazing taste and quick service!"</p>
      <h4>Daniel Federico Theodoric</h4>
      <div class="stars">★★★★★</div>
    </div>

    <div class="testimonial">
      <div class="avatar">😊</div>
      <p>"Friendly staff and delicious food!"</p>
      <h4>Sandrika Marcella Jolie</h4>
      <div class="stars">★★★★★</div>
    </div>
        <div class="controls">
    <button class="arrow next" onclick="changeSlide(1)">&#10095;</button>
  </div>
  </div>
</div>

</section>
<hr class="shadow-line"></hr>

  <script src="/scripts/Homepage.js"></script>

  <!-- Footer -->
 <footer class="footer">
    <div class="footer-container">

      <div class="footer-left">
        <h2 class="logo">JetWay</h2>
        <p class="vision">Our vision is to provide the easiest and effortless travel plan for our customers.</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>


      <div class="footer-links">
        <div class="column">
          <h4>About</h4>
          <ul>
            <li><a href="#">How it works</a></li>
            <li><a href="#">Featured</a></li>
            <li><a href="#">Partnership</a></li>
            <li><a href="#">Bussiness Relation</a></li>
          </ul>
        </div>
        <div class="column">
          <h4>Community</h4>
          <ul>
            <li><a href="#">Events</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Podcast</a></li>
            <li><a href="#">Invite a friend</a></li>
          </ul>
        </div>
        <div class="column">
          <h4>Socials</h4>
          <ul>
            <li><a href="#">TikTok</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
      <p>©2025 Jetway. All rights reserved</p>
      <div class="policies">
        <a href="#">Privacy & Policy</a>
        <a href="#">Terms & Condition</a>
      </div>
    </div>
  </footer>
</body>
</html>
