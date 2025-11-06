<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Jetway</title>
    <link rel="stylesheet" href="/styles/sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
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
      <a href="/pages/Homepage.php" class="active">Home</a>
      <a href="/pages/Flights.php">Flights</a>
      <a href="/pages/ticket-info.php">My Booking</a>
      <a href="/pages/support.php">Support</a> 
      <img src="/FOTO/notif.png" alt="iconnotif" width="35">
      <img src="/FOTO/bendera indo.png" alt="iconbendera" width="40">
      <nav></nav>
      <i class="fas fa-chevron-down"></i>
      <a href="/pages/sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

    <div id="loading-overlay">
      <div id="loading-text">🛫</div>
    </div>

      <div class="background">
    <div class="signup-container">
      <h2>Sign Up</h2>
      <p>Choose how you'd like to sign Up</p>

      <form action="../../backend/signupb.php" method="POST">
      <div class="form-grid">
          <input id="username" name="username" type="text" placeholder="Username" required>
          <input id="email" name="email" type="email" placeholder="Email" required>
          <input id="password" name="password" type="password" placeholder="Password">
          <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password">
        </div>
        <p style="font-size:0.9em;color:#666;margin-top:8px;">You may use any password (no length or complexity required).</p>

        <div class="divider">
          <span></span> or <span></span>
        </div>

        <div class="social-login">
          <button type="button" class="google">Continue with Google</button>
          <button type="button" class="facebook">Continue with Facebook</button>
        </div>

        <button type="submit" class="confirm-btn" name="Confirm">Confirm</button>
      </form>
    </div>
  </div>

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

  <script src="/scripts/sign-up.js"></script>
    
  </body>
  </html>