<?php
require_once "../backend/config/db-connection.php";
session_start();

// ===================================
// FIX TERPENTING: Ambil user_id
// ===================================
if (!isset($_SESSION["user_id"])) {

    // Jika halaman lain mengirim uid, pakai itu
    if (isset($_GET["uid"])) {
        $_SESSION["user_id"] = intval($_GET["uid"]);
    } else {
        // Jika benar-benar tidak punya user_id → redirect login
        header("Location: sign-in.php");
        exit;
    }
}

$user_id = $_SESSION["user_id"];

// ===================================
// Ambil semua booking user
// ===================================
$query = $connection->prepare("
    SELECT 
        b.id AS booking_id,
        b.booking_date,
        b.status,
        b.total_price,

        f.flight_code,
        f.airline,
        f.departure_airport,
        f.arrival_airport,
        f.flight_date,
        f.price AS flight_price,
        f.airline_logo
    FROM bookings b
    JOIN flights f ON b.flight_id = f.flight_id
    WHERE b.user_id = ?
    ORDER BY b.booking_date DESC
");
$query->bind_param("i", $user_id);
$query->execute();
$bookings = $query->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Booking - JetWay</title>
    <link rel="stylesheet" href="/styles/my-booking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header class="nav">
    <div class="nav-left">
        <a class="logo1" href="../pages/Homepage.php">JetWay</a>
    </div>

    <div class="searchbar">
        <input type="search" placeholder="Search..." />
        <button><img src="/FOTO/search button.png" width="24"></button>
        <button><img src="/FOTO/icon mikrofon.png" width="18"></button>
    </div>

    <nav class="nav-links">
        <a href="Homepage.php">Home</a>
        <a href="Flights.php">Flights</a>
        <a href="my-booking.php" class="active">My Booking</a>
        <a href="support.php">Support</a>
        <img src="/FOTO/notif.png" width="35">
        <img src="/FOTO/bendera indo.png" width="40">
        <a href="Sign-in.php" class="btn ghost">Log In</a>
    </nav>
</header>

<div class="page-frame">
    <div class="dashboard-inner">

        <h2>Your Bookings</h2>

        <div class="booking-area">

            <?php if ($bookings->num_rows == 0): ?>
                <p>You have no bookings yet.</p>

            <?php else: ?>
                <?php while ($b = $bookings->fetch_assoc()): ?>

                <div class="booking-card">

                    <!-- LEFT -->
                    <div class="left">
                        <img class="airline-logo"
                             src="<?= $b['airline_logo'] ?>"
                             alt="logo">
                        <div class="airline-name"><?= $b['airline'] ?></div>
                    </div>

                    <!-- CENTER -->
                    <div class="center">
                        <div class="time-block departure">
                            <div class="airport"><?= $b['departure_airport'] ?></div>
                            <div class="small"><?= $b['flight_date'] ?></div>
                        </div>

                        <div class="route">
                            <div class="direct">Direct</div>
                            <div class="arrow1">✈︎</div>
                        </div>

                        <div class="time-block arrival">
                            <div class="airport"><?= $b['arrival_airport'] ?></div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="right">
                        <div class="price">
                            <b>Rp <?= number_format($b['total_price'], 0, ',', '.') ?></b>
                        </div>

                        <div class="status-badge 
                            <?= $b['status']=='confirmed' ? 'status-confirmed' : '' ?>
                            <?= $b['status']=='pending' ? 'status-pending' : '' ?>
                            <?= $b['status']=='cancelled' ? 'status-cancelled' : '' ?>">
                            <?= ucfirst($b['status']) ?>
                        </div>

                        <div class="meta">
                            Booking ID: <b><?= $b['booking_id'] ?></b>
                        </div>
                    </div>

                </div>

                <?php endwhile; ?>
            <?php endif; ?>

        </div>

    </div>
</div>

</body>
</html>
