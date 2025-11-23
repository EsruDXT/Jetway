<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway</title>
    <link rel="stylesheet" href="/styles/Homepage.css" />
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/main.css" rel="stylesheet" />
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
      <a href="#" class="active">Home</a>
      <a href="Flights.php">Flights</a>
      <a href="my-booking.php">My Booking</a>
      <a href="support.php">Support</a> 
      <img src="/FOTO/notif.png" alt="iconnotif" width="35">
        <div class="lang-dropdown-toggle">
            <img src="/FOTO/bendera indo.png" class="flag-icon">
            <i class="fa-solid fa-chevron-down"></i>
        </div>
      <a href="sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

    <div id="loading-overlay">
      <div id="loading-text">🛫</div>
    </div>

    <!-- Pop Up Microphone -->
<div id="mic-popup" class="mic-popup">
  <img src="/FOTO/Pop Out Mic.png" alt="Mic Listening" class="mic-image">
</div>

<div id="langCurrencyModal" class="lang-modal">
    <div class="lang-modal-content">
        <span class="lang-close">&times;</span>

        <div class="lang-modal-grid">
            <div class="lang-section">
                <h3>Language</h3>

                <label class="lang-option">
                    English <input type="checkbox" checked>
                </label>
                <label class="lang-option">
                    Bahasa Indonesia <input type="checkbox">
                </label>
                <label class="lang-option">
                    Spanish <input type="checkbox">
                </label>
                <label class="lang-option">
                    Japanese <input type="checkbox">
                </label>
                <label class="lang-option">
                    Korean <input type="checkbox">
                </label>
                <label class="lang-option">
                    Mandarin <input type="checkbox">
                </label>
            </div>

            <div class="lang-section">
                <h3>Currency</h3>

                <label class="lang-option">
                    IDR - Indonesian Rupiah <input type="checkbox" checked>
                </label>
                <label class="lang-option">
                    USD - US Dollar <input type="checkbox">
                </label>
                <label class="lang-option">
                    EUR - Euro <input type="checkbox">
                </label>
                <label class="lang-option">
                    JPY - Japanese Yen <input type="checkbox">
                </label>
                <label class="lang-option">
                    KRW - Korean Won <input type="checkbox">
                </label>
                <label class="lang-option">
                    CNY - Chinese Yuan <input type="checkbox">
                </label>
            </div>
        </div>

    </div>
</div>



<!-- POPUP 1: Set Notification -->
<div id="popup-setnotif" class="popup-overlay">
  <div class="popup-card">
    <img src="/FOTO/notif yes or no.PNG" alt="icon" class="popup-icon">
    <h2>Set Notification On?</h2>
    <div class="popup-btns">
      <button id="notif-yes">Yes</button>
      <button id="notif-cancel">Cancel</button>
    </div>
  </div>
</div>

<!-- POPUP 2: Notification Set -->
<div id="popup-notifset" class="popup-overlay">
  <div class="popup-card">
    <img src="/FOTO/confirm notif.PNG" alt="icon" class="popup-icon">
    <h2>Notification Set</h2>
    <p>You will receive notifications from now on</p>
    <button id="notif-confirm">Confirm</button>
  </div>
</div>


    <div class="slideshow-container">
      <img class="slide fade" src="/FOTO/foto 1.png" alt="journey">
      <img class="slide fade" src="/FOTO/promo.jpeg" alt="journey">
      <img class="slide fade" src="/FOTO/pesawat2.webp" alt="journey">
    </div>

  <div class="banner-text">
    <h1>Your Journey, Our Way</h1>
    <p>Find the best flight deals and travel inspirations.</p>
    <button class="btnbook">Book Now</button>
  </div>  

  <!-- Search Flight Section -->
  <section id="search" class="search-card">
    <form action="search.php" method="get">
      <fieldset class="triptype">
        <label><input type="radio" name="trip" value="oneway" checked> One Way</label>
        <label><input type="radio" name="trip" value="round"> Round Trip</label>
      </fieldset>
      <div class="row">
        <input type="text" name="from" placeholder="From Jakarta CGK">
        <input type="text" name="to" placeholder="To Singapore SIN">
        <input type="text" name="pax" placeholder="1 Passenger, Economy">
        <input type="date" name="depart">
        <button class="btn primary">Search Ticket</button>
      </div>
    </form>
  </section>

  <!-- Explore Section -->
  <div class="container">
    
    <!-- Bagian kiri -->
    <div class="left-banner">
      <img src="/FOTO/explore.png" alt="Explore JetWay">
      <div class="text-overlay">
        <h2>Explore the World with <br><span>JetWay</span></h2>
        <p><i><b>Fly to Your Dream Destination.</b></i></p>
      </div>
    </div>

    <!-- Bagian kanan -->
    <div class="right-cards">
      <div class="card">
        <img src="/FOTO/raja ampat.png" alt="Raja Ampat">
        <div class="overlay">
          <h3>RAJA AMPAT</h3>
          <p>Dive into a hidden paradise—crystal waters, vibrant corals, and islands that feel untouched by time.</p>
        </div>
      </div>

      <div class="card">
        <img src="/FOTO/kawah ijen.png" alt="Kawah Ijen">
        <div class="overlay">
          <h3>KAWAH IJEN</h3>
          <p>Witness the world’s rare blue flames and discover a crater lake that glows like a jewel in the night.</p>
        </div>
      </div>

      <div class="card">
        <img src="/FOTO/pulau komodo 1.png" alt="Pulau Komodo">
        <div class="overlay">
          <h3>PULAU KOMODO</h3>
          <p>Home to the legendary Komodo dragons, pink-sand beaches, and breathtaking hilltop views—Komodo feels like stepping into a prehistoric paradise.</p>
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