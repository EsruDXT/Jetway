<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer-Data-Input</title>
    <link rel="stylesheet" href="/styles/customer-data-input.css" />
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
      <a href="Homepage.php">Home</a>
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

  <main class="ticket-info-container">
    <div class="outer-panel">
      <div class="ticket-header" style="text-align:center; margin-bottom:24px;">
        <div class="progress-steps">
          <div class="step"><div class="step-number">1</div><div class="step-text">Ticket Information</div></div>
          <div class="step-line"></div>
          <div class="step"><div class="step-number active">2</div><div class="step-text">Customer Data Input</div></div>
          <div class="step-line"></div>
          <div class="step"><div class="step-number">3</div><div class="step-text">Payment</div></div>
        </div>
      </div>

      <div class="info-section">
  <!-- Kiri: Ticket Information -->
  <div class="ticket-info">
    <h2>Ticket Information</h2>
    <div class="ticket-card compact">
      <div class="flight-times">
        <div class="depart">
          <h3>11:40</h3>
          <p>Jakarta CGK</p>
        </div>

       <div class="flight-line">
  <div class="route-info">
    <span class="flight-type">Direct</span>
    <div class="plane-line">
      <div class="line"></div>
      <div class="plane-icon">
        <i class="fa-solid fa-plane"></i>
      </div>
      <div class="line"></div>
    </div>
    <p class="duration">1h45m</p>
  </div>
</div>

        <div class="arrive">
          <h3>14:35</h3>
          <p>Singapore SIN</p>
        </div>
      </div>

      <div class="flight-details">
        <div class="left-details">
          <p><i class="fa-solid fa-clock"></i>2h 55min</p>
          <p><i class="fa-solid fa-plane"></i>Batik Air<br>ID-7154 • Economy</p>
          <p><i class="fa-solid fa-suitcase"></i> Baggage 10 kg</p>
          <p><i class="fa-solid fa-briefcase"></i> Cabin baggage 7 kg</p>
        </div>
        <div class="right-price">
          <h3>Rp. 3.500.000</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Kanan: Personal Information -->
  <div class="personal-info">
    <h2>Personal Information</h2>
    <form>
      <div class="gender">
        <label><input type="radio" name="gender"> Male</label>
        <label><input type="radio" name="gender" checked> Female</label>
      </div>

      <div class="name-row">
        <div class="input-group">
          <label>First Name</label>
          <input type="text" value="Emily">
        </div>
        <div class="input-group">
          <label>Last Name</label>
          <input type="text" value="Smith">
        </div>
      </div>

      <div class="input-group">
        <label>Email</label>
        <input type="email" value="Emily579@gmail.com">
      </div>

      <div class="name-row">
        <div class="input-group">
          <label>Date of Birth</label>
          <input type="text" value="29 August 1995">
        </div>
        <div class="input-group">
          <label>City of Residence</label>
          <input type="text" value="Pontianak">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="button-container">
  <button class="confirm-button" onclick="location.href='payment.php'">Payment</button>
</div>
    </div>
</main>
<script src="../scripts/customer-data-input.js"></script>
</body>
</html>