<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Support</title>
    <link rel="stylesheet" href="/styles/support.css" />
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
        <button><img src="/FOTO/search button.png" width="24" height="24"></button>
        <button><img src="/FOTO/icon mikrofon.png" width="18" height="18"></button>
    </div>

    <nav class="nav-links">
      <a href="/pages/Homepage.php">Home</a>
      <a href="/pages/Flights.php">Flights</a>
      <a href="/pages/ticket-info.php">My Booking</a>
      <a href="/pages/support.php" class="active">Support</a>
      <img src="/FOTO/notif.png" width="35">
      <img src="/FOTO/bendera indo.png" width="40">
      <i class="fas fa-chevron-down"></i>
      <a href="/pages/sign-in.php" class="btn ghost">Log In</a>
    </nav>
  </header>

  <div id="loading-overlay">
      <div id="loading-text">🛫</div>
  </div>

  <img src="/FOTO/sign in bg.png" alt="supportimage" width="1250px">

  <!-- FAQ Section -->
  <div class="container">
      <div class="faq-section">

          <!-- Left FAQ -->
          <div class="faq-left">
              <div class="faq-title"><h1>F.A.Q</h1></div>
              <p class="faq-subtitle">Having troubles? We are here to help.</p>

              <!-- FAQ ITEM 1 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>How do I book a ticket?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content faq-box">
                          <ol>
                              <li>Go to the flights page or click this button down below.</li>
                              <li>Choose the flight you want.</li>
                              <li>Follow the instructions and confirm your payment.</li>
                              <li>Your flight is booked and you can check in Active Flight in your profile.</li>
                          </ol>
                          <button class="faq-btn" id="bookNowBtn">Book Now</button>
                      </div>
                  </div>
              </div>

              <!-- FAQ ITEM 2 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>How can I buy insurance for my flight?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content">
                          <ol>
                              <li>After choosing a ticket, you will be in the Ticket Information Page.</li>
                              <li>You will see a list of insurance options.</li>
                              <li>Click the checkbox to select one.</li>
                          </ol>
                      </div>
                  </div>
              </div>

              <!-- FAQ ITEM 3 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>How do I change my account password?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content">
                          <ol>
                              <li>Click the avatar icon on the top right.</li>
                              <li>Select “Login & Password”.</li>
                              <li>On the right, click the button labeled “Password”.</li>
                          </ol>
                      </div>
                  </div>
              </div>

              <!-- FAQ ITEM 4 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>Can I cancel my ticket reservation?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content">
                          <ol>
                              <li>Click the avatar icon on the top right.</li>
                              <li>Select “Active Flights”.</li>
                              <li>Click “See more” then choose “Cancel”.</li>
                          </ol>
                      </div>
                  </div>
              </div>

              <!-- FAQ ITEM 5 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>Why can't I make a reservation?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content">
                          <ol>
                              <li>Ensure you are logged in.</li>
                              <li>Check your internet connection.</li>
                              <li>Ensure your payment method is valid.</li>
                          </ol>
                      </div>
                  </div>
              </div>

              <!-- FAQ ITEM 6 -->
              <div class="faq-item">
                  <div class="faq-question">
                      <span>How do I change my personal information?</span>
                      <span class="faq-arrow">∨</span>
                  </div>
                  <div class="faq-answer">
                      <div class="faq-answer-content">
                          <ol>
                              <li>Click the avatar icon.</li>
                              <li>Select “Personal Information”.</li>
                              <li>Edit your details.</li>
                          </ol>
                      </div>
                  </div>
              </div>

          </div> <!-- END LEFT FAQ -->

          <!-- Contact Card -->
          <div class="contact-card">
              <h2>Contact Us</h2>

              <div class="contact-item">
                  <div class="contact-icon"><img src="/FOTO/person.png" width="30"></div>
                  <div class="contact-info">
                      <div class="contact-label">Email</div>
                      <div class="contact-value">@JetWayFly.up</div>
                  </div>
              </div>

              <div class="contact-item">
                  <div class="contact-icon"><img src="/FOTO/person.png" width="30"></div>
                  <div class="contact-info">
                      <div class="contact-label">Call Center</div>
                      <div class="contact-value">+00 2203-0904-12</div>
                  </div>
              </div>

              <div class="office-section">
                  <h3>JetWay Office</h3>
                  <p class="office-hours">Operational Hours</p>
                  <p class="office-time">Monday-Friday, 08:00-16:00</p>
                  <p class="office-address">Jl. Letnan Jendral Sutoyo, Pontianak, Kalimantan Barat</p>
                  <div class="office-map"><img src="/FOTO/googlemapimmanuel.png"></div>
              </div>
          </div>
      </div>
  </div>

  <div class="aboutus"><h2>What Our Customers Think About Us</h2></div>
  <hr class="shadow-line">

  <!-- TESTIMONIAL SECTION FIXED -->
  <section class="testimonial-section">
      <div id="Slideshow" class="testimonial-container">
          <div class="testimonial-wrapper">

              <button class="arrow prev" onclick="changeSlide(-1)">&#10094;</button>

              <div class="testimonial"><div class="avatar">😊</div><p>"Pemesanan Tiket Disini Sangat Cepat Intinya Gacor!"</p><h4>Kenzo Rivaldo</h4><div class="stars">★★★★★</div></div>
              <div class="testimonial"><div class="avatar">😊</div><p>"Definitely one of the best burgers in town!"</p><h4>Marvin Arif Pratama</h4><div class="stars">★★★★★</div></div>
              <div class="testimonial"><div class="avatar">😊</div><p>"Amazing taste and quick service!"</p><h4>Daniel Federico Theodoric</h4><div class="stars">★★★★★</div></div>
              <div class="testimonial"><div class="avatar">😊</div><p>"Friendly staff and delicious food!"</p><h4>Sandrika Marcella Jolie</h4><div class="stars">★★★★★</div></div>

              <button class="arrow next" onclick="changeSlide(1)">&#10095;</button>

          </div>
      </div>
  </section>

  <hr class="shadow-line">

  <script src="/scripts/support.js"></script>

  <!-- FOOTER -->
  <footer class="footer">
      <div class="footer-container">
          <div class="footer-left">
              <h2 class="logo">JetWay</h2>
              <p class="vision">Our vision is to provide the easiest and effortless travel plan for customers.</p>
              <div class="social-icons">
                  <a><i class="fab fa-facebook-f"></i></a>
                  <a><i class="fab fa-twitter"></i></a>
                  <a><i class="fab fa-instagram"></i></a>
              </div>
          </div>

          <div class="footer-links">
              <div class="column">
                  <h4>About</h4>
                  <ul>
                      <li><a>How it works</a></li>
                      <li><a>Featured</a></li>
                      <li><a>Partnership</a></li>
                      <li><a>Business Relation</a></li>
                  </ul>
              </div>

              <div class="column">
                  <h4>Community</h4>
                  <ul>
                      <li><a>Events</a></li>
                      <li><a>Blog</a></li>
                      <li><a>Podcast</a></li>
                      <li><a>Invite a friend</a></li>
                  </ul>
              </div>

              <div class="column">
                  <h4>Socials</h4>
                  <ul>
                      <li><a>TikTok</a></li>
                      <li><a>Instagram</a></li>
                      <li><a>Twitter</a></li>
                      <li><a>Facebook</a></li>
                  </ul>
              </div>
          </div>
      </div>

      <div class="footer-bottom">
          <p>©2025 Jetway. All rights reserved</p>
          <div class="policies">
              <a>Privacy & Policy</a>
              <a>Terms & Condition</a>
          </div>
      </div>
  </footer>
</body>
</html>
