<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway</title>
    <link rel="stylesheet" href="../styles/customer-data.css" />
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
      <a href="/pages/Homepage.php">Home</a>
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

  <div class="settings-container">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="profile-section">
      <div class="avatar">
        <img src="../FOTO/icon profile.png" alt="User Avatar">
      </div>
      <p class="welcome-text">Welcome, Kenzo Rivaldo</p>
    </div>

    <nav class="menu">
      <button class="menu-item active">
        <img src="../FOTO/icon person.png" alt="Personal Information">
        <span>Personal Information</span>
      </button>
      <button class="menu-item" onclick="location.href='/pages/login&password.php'">
        <img src="../FOTO/icon password.png" alt="Login & Password">
        <span>Login & Password</span>
      </button>
      <button class="menu-item" onclick="location.href='/pages/flight-history.php'">
        <img src="../FOTO/icon history.png" alt="Flights History">
        <span>Flights History</span>
      </button>
      <button class="menu-item">
        <img src="../FOTO/icon logout.png" alt="Log Out">
        <span>Log Out</span>
      </button>
    </nav>
  </div>

  <!-- Main Content -->
  <main class="main-content">
    <h2>Personal Information</h2>

    <div class="gender">
      <label>
        <input type="radio" name="gender">
        <span>Male</span>
      </label>
      <label>
        <input type="radio" name="gender" checked>
        <span>Female</span>
      </label>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>First Name</label>
        <div class="input-box">Kenzo</div>
      </div>

      <div class="form-group">
        <label>Last Name</label>
        <div class="input-box">Rivaldo</div>
      </div>
    </div>

    <div class="form-group">
      <label>Email</label>
      <div class="input-box wide">Kenzo@gmail.com</div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Date of Birth</label>
        <div class="input-box">3 Juli 2009</div>
      </div>

      <div class="form-group">
        <label>City of Residence</label>
        <div class="input-box">Pontianak</div>
      </div>
    </div>

    <p class="info">More informations..</p>
  </main>
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
<script src="../scripts/customer-data.js"></script>

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

  <script src="../scripts/customer-data.js"></script>
</body>
</html>