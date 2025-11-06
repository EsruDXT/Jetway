<?php
session_start();
?>

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

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/pages/logout.php" class="btn ghost">Log Out</a>
    <?php else: ?>
      <a href="/pages/sign-in.php" class="btn ghost">Log In</a>
    <?php endif; ?>
  </nav>
</header>
