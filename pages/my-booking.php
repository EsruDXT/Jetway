<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - My Booking</title>
    <link rel="stylesheet" href="/styles/my-booking.css" />
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      <a href="../pages/Homepage.php">Home</a>
      <a href="Flights.php">Flights</a>
      <a href="ticket-info.php" class="active">My Booking </a>
      <a href="support.php">Support</a> 
      <img src="/FOTO/notif.png" alt="iconnotif" width="35">
      <img src="/FOTO/bendera indo.png" alt="iconbendera" width="40">
      <nav></nav>
      <i class="fas fa-chevron-down"></i>
      <a href="sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

<div class="page-frame">
  <div class="dashboard-inner">
    <!-- Top stats -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-title">Total Bookings</div>
        <div class="stat-number">2</div>
        <div class="stat-badge">You are in the Top 50%</div>
      </div>

      <div class="stat-card">
        <div class="stat-title">Cancelled Bookings</div>
        <div class="stat-number">1</div>
        <div class="stat-badge">You are in the Top 0,5%</div>
      </div>

      <div class="stat-card">
        <div class="stat-title">Expired Bookings</div>
        <div class="stat-number">0</div>
        <div class="stat-badge">You are in the Top 0,01%</div>
      </div>
    </div>

    <!-- Main panel -->
    <div class="panel">
      <div class="panel-controls">
        <div class="filter-btn">All Bookings <span class="chev">▾</span></div>
        <div class="filter-btn">This month <span class="chev">▾</span></div>
      </div>

      <!-- booking list area -->
      <div class="booking-area">
        <div class="booking-card">
          <div class="left">
            <img class="airline-logo" src="../FOTO/logo Batik Air.png" alt="logo">
            <div class="airline-name">Batik Air</div>
          </div>

          <div class="center">
            <div class="time-block departure">
              <div class="time">11:40</div>
              <div class="airport">Jakarta - CGK</div>
              <div class="small">Soekarno Hatta Int'l</div>
            </div>

            <div class="route">
              <div class="direct">Direct</div>
              <div class="duration">1h45m</div>
              <div class="arrow1">✈︎</div>
            </div>

            <div class="time-block arrival">
              <div class="time">14:35</div>
              <div class="airport">Singapore - SIN</div>
              <div class="small">Changi</div>
            </div>
          </div>

          <div class="right">
            <div class="price-box">
              <div class="duration-short"><i class="fa-solid fa-clock"></i> 1h 45min</div>
              <div class="price"><span class="big">Rp.3.500.000</span></div>
              <div class="meta"><i class="fa-solid fa-suitcase"></i> Baggage 10 kg</div>
              <div class="meta"><i class="fa-solid fa-suitcase"></i> Cabin 7 kg</div>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-footer">
        <div class="looking">Looking for more travels?</div>
        <button class="book-btn">Book Your Flight Now</button>
      </div>
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
  
  <script src="/scripts/Homepage.js"></script>
</body>
</html>