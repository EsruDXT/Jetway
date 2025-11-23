<?php
require_once "../backend/config/db-connection.php";

// Ambil data booking + user_login + flights
$query = $connection->prepare("
    SELECT 
        bookings.id AS booking_id,
        bookings.booking_code,
        bookings.status,
        bookings.total_price,
        bookings.booking_date,

        user_login.username,

        flights.flight_code,
        flights.airline,
        flights.departure_airport,
        flights.arrival_airport,
        flights.flight_date
    FROM bookings
    JOIN user_login ON bookings.user_id = user_login.id
    JOIN flights ON bookings.flight_id = flights.flight_id
    ORDER BY bookings.id DESC
");
$query->execute();
$result = $query->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Management Bookings</title>
    <link rel="stylesheet" href="/styles/management-flights.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">JetWay<br><span class="admin-text">Admin</span></div>

    <div class="menu-section">
        <div class="menu-title">Dashboard</div>
        <a href="/pages/dashboard-analytics.php" class="menu-item"><i class="fa fa-chart-line"></i> Analytics</a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Management</div>

        <a href="/pages/management-flights.php" class="menu-item active"><i class="fa fa-plane"></i> Flights</a>

        <a href="/pages/management-users.php" class="menu-item"><i class="fa fa-users"></i> Users</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="table-container">
        
        <h2 style="margin-bottom:20px;">Management Bookings</h2>

        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Flight</th>
                    <th>Route</th>
                    <th>Flight Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['booking_id'] ?></td>

                    <td><?= htmlspecialchars($row['username']) ?></td>

                    <td><?= $row['flight_code'] ?> (<?= $row['airline'] ?>)</td>

                    <td><?= $row['departure_airport'] ?> → <?= $row['arrival_airport'] ?></td>

                    <td><?= $row['flight_date'] ?></td>

                    <td>IDR <?= number_format($row['total_price'], 0, ',', '.') ?></td>

                    <td><?= ucfirst($row['status']) ?></td>

                    <td><span class="edit-btn" onclick="editBooking(<?= $row['booking_id'] ?>)">Edit</span></td>

                    <td><span class="delete-btn" onclick="deleteBooking(<?= $row['booking_id'] ?>)">Delete</span></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>

<script>
function deleteBooking(id) {
    if (confirm("Are you sure you want to delete this booking?")) {
        window.location.href = "../backend/delete-flights.php?id=" + id;
    }
}
function editBooking(id) {
    window.location.href = "../pages/edit-flights.php?id=" + id;
}
</script>

</body>
</html>
