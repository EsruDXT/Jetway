<?php 
session_start();
if (!isset($_SESSION['final_total'])) {
    header("Location: Homepage.php");
    exit();
}
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Success</title>

  <!-- Styles -->
  <link rel="stylesheet" href="../styles/homepage.css">
  <link rel="stylesheet" href="../styles/confirmed.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<!-- ===================== NAVBAR ===================== -->
<header class="nav">
  <div class="nav-left">
      <a class="logo1" id="logo" href="#Slideshow">JetWay</a>
  </div>

  <div class="searchbar">
      <input type="search" placeholder="Search..." />
      <button><img src="/FOTO/search button.png" width="24"></button>
      <button><img src="/FOTO/icon mikrofon.png" width="18"></button>
  </div>

  <nav class="nav-links">
      <a href="Homepage.php">Home</a>
      <a href="Flights.php">Flights</a>
      <a href="ticket-info.php">My Booking</a>
      <a href="support.php">Support</a>
      <img src="/FOTO/notif.png" width="35">
      <img src="/FOTO/bendera indo.png" width="40">
      <i class="fas fa-chevron-down"></i>
      <a href="/pages/sign-in.php" class="btn ghost">Log In</a>
  </nav>
</header>

<!-- Spacer to push content below fixed navbar -->
<div style="height:120px;"></div>


<!-- ===================== PROGRESS STEP ===================== -->
<div class="progress-container">
  <div class="step completed">
    <div class="circle">1</div>
    <p>Ticket Information</p>
  </div>
  <div class="line"></div>

  <div class="step completed">
    <div class="circle">2</div>
    <p>Customer Data Input</p>
  </div>
  <div class="line"></div>

  <div class="step completed">
    <div class="circle">3</div>
    <p>Payment</p>
  </div>
</div>


<!-- ===================== SUCCESS BOX ===================== -->
<div class="success-box">
  <div class="checkmark">
      <svg class="check-svg" viewBox="0 0 52 52">
          <circle class="check-circle" cx="26" cy="26" r="23" fill="none"></circle>
          <path class="check-path" fill="none" d="M14 27l7 7 16-16"></path>
      </svg>
  </div>
  <h2>Order success</h2>
  <p>Your order is confirmed.</p>
</div>


<!-- ===================== TESTIMONIAL TITLE ===================== -->
<div class="aboutus">
  <h2>What Our Customers Think About Us</h2>
</div>
<hr class="shadow-line">


<!-- ===================== TESTIMONIAL SLIDESHOW ===================== -->
<section class="testimonial-section">
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

<hr class="shadow-line">


<!-- ===================== FOOTER ===================== -->
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

  <div class="footer-bottom">
      <p>©2025 Jetway. All rights reserved</p>
      <div class="policies">
        <a href="#">Privacy & Policy</a>
        <a href="#">Terms & Condition</a>
      </div>
  </div>
</footer>


<!-- ===================== CONFETTI CANVAS ===================== -->
<canvas id="confetti-canvas"></canvas>


<!-- ===================== SCRIPTS ===================== -->
<script src="/scripts/confirmed.js"></script>

</body>
</html>
