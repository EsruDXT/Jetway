<?php
require_once "../backend/config/db-connection.php";

if (!isset($_GET['id'])) {
    die("Booking ID missing.");
}

$booking_id = intval($_GET['id']);

// Ambil booking + user + flight
$query = $connection->prepare("
    SELECT 
        b.id AS booking_id,
        b.user_id,
        b.flight_id,
        b.total_price,
        b.status,
        b.booking_date,

        ul.username,
        ul.email,

        up.first_name,
        up.last_name,

        f.flight_code,
        f.departure_airport,
        f.arrival_airport,
        f.flight_date
    FROM bookings b
    JOIN user_login ul ON b.user_id = ul.id
    LEFT JOIN user_profile up ON up.user_id = ul.id
    JOIN flights f ON b.flight_id = f.flight_id
    WHERE b.id = ?
");
$query->bind_param("i", $booking_id);
$query->execute();
$data = $query->get_result()->fetch_assoc();

if (!$data) die("Booking not found.");

// Semua flights
$allFlights = $connection->query("SELECT * FROM flights ORDER BY flight_date ASC");

// Semua user
$allUsers = $connection->query("
    SELECT 
        ul.id,
        ul.username,
        ul.email,
        up.first_name,
        up.last_name
    FROM user_login ul
    LEFT JOIN user_profile up ON up.user_id = ul.id
    ORDER BY ul.username ASC
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="/styles/management-flights.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

<div class="sidebar">
    <div class="logo">JetWay<br><span class="admin-text">Admin</span></div>

    <div class="menu-section">
        <div class="menu-title">Dashboard</div>
        <a href="/pages/dashboard-analytics.php" class="menu-item"><i class="fa fa-chart-line"></i> Analytics</a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Management</div>
        <a href="/pages/management-flights.php" class="menu-item"><i class="fa fa-plane"></i> Flights</a>
        <a href="/pages/management-users.php" class="menu-item active"><i class="fa fa-users"></i> Users</a>
    </div>
</div>

<div class="content">

    <div class="edit-container">
        <h2>Edit Booking</h2>

        <form action="../backend/update-booking.php" method="POST">

            <input type="hidden" name="booking_id" value="<?= $data['booking_id'] ?>">

            <!-- USER -->
            <label>User</label>
            <select name="user_id" required>
                <?php while ($u = $allUsers->fetch_assoc()): ?>
                    <?php
                    $fullname = trim(($u['first_name'] ?? "") . " " . ($u['last_name'] ?? ""));
                    if ($fullname == "") $fullname = $u["username"];
                    ?>
                    <option value="<?= $u['id'] ?>" 
                        <?= $u['id'] == $data['user_id'] ? "selected" : "" ?>>
                        <?= htmlspecialchars($fullname) ?> (<?= $u['email'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- FLIGHT -->
            <label>Flight</label>
            <select name="flight_id" required>
                <?php while ($f = $allFlights->fetch_assoc()): ?>
                    <option value="<?= $f['flight_id'] ?>" 
                        <?= $f['flight_id'] == $data['flight_id'] ? "selected" : "" ?>>
                        <?= $f['flight_code'] ?> — <?= $f['departure_airport'] ?> → <?= $f['arrival_airport'] ?> (<?= $f['flight_date'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>

            <!-- STATUS -->
            <label>Status</label>
            <select name="status" required>
                <option value="pending"   <?= $data['status']=="pending" ? "selected":"" ?>>Pending</option>
                <option value="confirmed" <?= $data['status']=="confirmed" ? "selected":"" ?>>Confirmed</option>
                <option value="cancelled" <?= $data['status']=="cancelled" ? "selected":"" ?>>Cancelled</option>
            </select>

            <!-- PRICE -->
            <label>Total Price</label>
            <input type="number" name="total_price" value="<?= $data['total_price'] ?>" required>

            <button type="submit" class="save-btn">Save Changes</button>
        </form>

        <a href="management-flights.php" class="back-btn">← Back to Flights</a>
    </div>

</div>

</body>
</html>
