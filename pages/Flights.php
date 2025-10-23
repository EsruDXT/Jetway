<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
    <link rel="stylesheet" href="/styles/Flight.css" />
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
      <a href="Homepage.php">Home</a>
      <a href="Flights.php" class="active">Flights</a>
      <a href="#">My Booking</a>
      <a href="#">Support</a> 
      <img src="/FOTO/notif.png" alt="iconnotif" width="35">
      <img src="/FOTO/bendera indo.png" alt="iconbendera" width="40">
      <nav></nav>
      <i class="fas fa-chevron-down"></i>
      <a href="/pages/sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

    <main class="main-content">
        <div class="container">
            <!-- Flight Search Card -->
            <div class="search-card">
                <div class="trip-type">
                    <label class="radio-label">
                        <input type="radio" name="trip" checked>
                        <span>One Way</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="trip">
                        <span>Round Trip</span>
                    </label>
                </div>

                <div class="search-inputs">
                    <div class="input-group">
                        <label>Singapore SIN</label>
                        <button class="swap-btn">⇄</button>
                        <label>Jakarta CGK</label>
                    </div>
                </div>

                <div class="search-filters">
                    <button class="filter-btn">👤 1 Passenger</button>
                    <button class="filter-btn">💼 Economy</button>
                    <button class="filter-btn">📅 Depart on</button>
                </div>

                <div class="flight-summary">
                    <div class="time-info">
                        <div class="time">11:40</div>
                        <div class="location">Jakarta - CGK</div>
                        <div class="date">Soekarno Hatta Intl</div>
                    </div>
                    <div class="flight-duration">
                        <div class="label">Direct</div>
                        <div class="line"></div>
                        <div class="duration">1h45m</div>
                    </div>
                    <div class="time-info">
                        <div class="time">14:35</div>
                        <div class="location">Singapore - SIN</div>
                        <div class="date">Changi</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="sort-btn">Sort ▼</button>
                    <button class="filter-btn-main">Filter ▼</button>
                </div>
            </div>

            <!-- Flight List -->
            <div class="flight-list">
                <!-- Batik Air -->
                <div class="flight-card">
                    <div class="airline-info">
                        <img src="/FOTO/logo Batik air.png" alt="Batik Air" class="airline-logo">
                        <span class="airline-name">Batik Air</span>
                    </div>
                    <div class="flight-details">
                        <div class="time-section">
                            <div class="time">11:40</div>
                            <div class="airport">Jakarta - CGK</div>
                            <div class="airport-name">Soekarno Hatta Intl</div>
                        </div>
                        <div class="flight-path">
                            <div class="path-label">Direct</div>
                            <div class="path-line"></div>
                            <div class="duration">1h45m</div>
                        </div>
                        <div class="time-section">
                            <div class="time">14:35</div>
                            <div class="airport">Singapore - SIN</div>
                            <div class="airport-name">Changi</div>
                        </div>
                    </div>
                    <div class="flight-info">
                        <div class="info-item"><img src="logo Batik air.png" alt=""> Batik Air</div>
                        <div class="info-item">💺 ID-7624 • Economy</div>
                        <div class="info-item">🧳 Baggage 16 kg</div>
                        <div class="info-item">Cabin Baggage 7 kg</div>
                    </div>
                    <div class="price-section">
                        <div class="price">Rp. 3.500.000</div>
                        <button class="choose-btn">Choose</button>
                    </div>
                </div>

                <!-- Lion Air -->
                <div class="flight-card">
                    <div class="airline-info">
                        <img src="/FOTO/logo Lion air.png" alt="Lion Air" class="airline-logo">
                        <span class="airline-name">Lion Air</span>
                    </div>
                    <div class="flight-details">
                        <div class="time-section">
                            <div class="time">07:00</div>
                            <div class="airport">Jakarta - CGK</div>
                            <div class="airport-name">Soekarno Hatta Intl</div>
                        </div>
                        <div class="flight-path">
                            <div class="path-label">Direct</div>
                            <div class="path-line"></div>
                            <div class="duration">1h45m</div>
                        </div>
                        <div class="time-section">
                            <div class="time">11:35</div>
                            <div class="airport">Singapore - SIN</div>
                            <div class="airport-name">Changi</div>
                        </div>
                    </div>
                    <div class="flight-info">
                        <div class="info-item">✈️ Lion Air</div>
                        <div class="info-item">💺 JT-153</div>
                        <div class="info-item">🧳 Baggage 15 kg</div>
                        <div class="info-item">Cabin Baggage 7 kg</div>
                    </div>
                    <div class="price-section">
                        <div class="price">Rp. 2.100.000</div>
                        <button class="choose-btn">Choose</button>
                    </div>
                </div>

                <!-- Garuda Air -->
                <div class="flight-card">
                    <div class="airline-info">
                        <img src="/FOTO/logo garuda.png" alt="Garuda Air" class="airline-logo">
                        <span class="airline-name">Garuda Air</span>
                    </div>
                    <div class="flight-details">
                        <div class="time-section">
                            <div class="time">3:30</div>
                            <div class="airport">Jakarta - CGK</div>
                            <div class="airport-name">Soekarno Hatta Intl</div>
                        </div>
                        <div class="flight-path">
                            <div class="path-label">Direct</div>
                            <div class="path-line"></div>
                            <div class="duration">1h45m</div>
                        </div>
                        <div class="time-section">
                            <div class="time">5:45</div>
                            <div class="airport">Singapore - SIN</div>
                            <div class="airport-name">Changi</div>
                        </div>
                    </div>
                    <div class="flight-info">
                        <div class="info-item">✈️ Garuda Air</div>
                        <div class="info-item">💺 ID-6722 • Premium Economy</div>
                        <div class="info-item">🧳 Baggage 15 kg</div>
                        <div class="info-item">Cabin Baggage 7 kg</div>
                    </div>
                    <div class="price-section">
                        <div class="price">Rp. 5.800.000</div>
                        <button class="choose-btn">Choose</button>
                    </div>
                </div>

                <!-- Citilink -->
                <div class="flight-card">
                    <div class="airline-info">
                        <img src="/FOTO/logo citilink.png" alt="Citilink" class="airline-logo">
                        <span class="airline-name">Citilink</span>
                    </div>
                    <div class="flight-details">
                        <div class="time-section">
                            <div class="time">4:50</div>
                            <div class="airport">Jakarta - CGK</div>
                            <div class="airport-name">Soekarno Hatta Intl</div>
                        </div>
                        <div class="flight-path">
                            <div class="path-label">Direct</div>
                            <div class="path-line"></div>
                            <div class="duration">1h40m</div>
                        </div>
                        <div class="time-section">
                            <div class="time">6:10</div>
                            <div class="airport">Singapore - SIN</div>
                            <div class="airport-name">Changi</div>
                        </div>
                    </div>
                    <div class="flight-info">
                        <div class="info-item">✈️ Citilink</div>
                        <div class="info-item">💺 QG-6914 • Economy</div>
                        <div class="info-item">🧳 Baggage 7 kg</div>
                        <div class="info-item">Extra Baggage 7 kg</div>
                    </div>
                    <div class="price-section">
                        <div class="price">Rp. 2.800.000</div>
                        <button class="choose-btn">Choose</button>
                    </div>
                </div>

                <!-- Sriwijaya Air -->
                <div class="flight-card">
                    <div class="airline-info">
                        <img src="/FOTO/logo sriwijaya.png" alt="Sriwijaya Air" class="airline-logo">
                        <span class="airline-name">Sriwijaya Air</span>
                    </div>
                    <div class="flight-details">
                        <div class="time-section">
                            <div class="time">12:00</div>
                            <div class="airport">Jakarta - CGK</div>
                            <div class="airport-name">Soekarno Hatta Intl</div>
                        </div>
                        <div class="flight-path">
                            <div class="path-label">Direct</div>
                            <div class="path-line"></div>
                            <div class="duration">1h45m</div>
                        </div>
                        <div class="time-section">
                            <div class="time">14:05</div>
                            <div class="airport">Singapore - SIN</div>
                            <div class="airport-name">Changi</div>
                        </div>
                    </div>
                    <div class="flight-info">
                        <div class="info-item">✈️ Sriwijaya Air</div>
                        <div class="info-item">💺 SJ-233</div>
                        <div class="info-item">🧳 Baggage 20 kg</div>
                        <div class="info-item">Cabin Baggage 7 kg</div>
                    </div>
                    <div class="price-section">
                        <div class="price">Rp. 11.700.000</div>
                        <button class="choose-btn">Choose</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    
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
