<?php
session_start();
require_once '../backend/config/db-connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ======================
// Ambil Flight ID dari URL
// ======================
$flight_id = isset($_GET['flight_id']) ? intval($_GET['flight_id']) : 0;
if ($flight_id <= 0) {
    die("Invalid Flight ID");
}

// ======================
// Load Flight Data
// ======================
$flightQuery = $connection->prepare("SELECT * FROM flights WHERE flight_id = ?");
$flightQuery->bind_param("i", $flight_id);
$flightQuery->execute();
$flightResult = $flightQuery->get_result();
$flight = $flightResult->fetch_assoc();

if (!$flight) {
    die("Flight not found.");
}

// ======================
// Load User Profile & Email
// ======================
$userQuery = $connection->prepare("
    SELECT up.*, ul.email 
    FROM user_profile up
    JOIN user_login ul ON up.user_id = ul.id
    WHERE up.user_id = ?
");
$userQuery->bind_param("i", $user_id);
$userQuery->execute();
$userResult = $userQuery->get_result();
$userProfile = $userResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Data Input</title>
    <link rel="stylesheet" href="/styles/customer-data-input.css" />
    <link href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./styles/main.css" rel="stylesheet" />

</head>

<body>

    <main class="ticket-info-container">
        <div class="outer-panel">

            <div class="ticket-header">
                <div class="progress-steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-text">Ticket Info</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number active">2</div>
                        <div class="step-text">Customer Data</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-text">Payment</div>
                    </div>
                </div>
            </div>

            <div class="info-section">

                <!-- LEFT: FLIGHT INFO -->
                <div class="ticket-info">
    <h2>Ticket Information</h2>
    <div class="ticket-card compact">
      <div class="flight-times">

        <div class="depart">
          <h3><?= $flight['departure_time']; ?></h3>
          <p><?= $flight['departure_city']; ?> <?= $flight['departure_airport']; ?></p>
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
            <p class="duration"><?= $flight['duration']; ?></p>
          </div>
        </div>

        <div class="arrive">
          <h3><?= $flight['arrival_time']; ?></h3>
          <p><?= $flight['arrival_city']; ?> <?= $flight['arrival_airport']; ?></p>
        </div>

      </div>

      <div class="flight-details">
        <div class="left-details">
          <p><i class="fa-solid fa-clock"></i><?= $flight['duration']; ?></p>

          <p>
            <i class="fa-solid fa-plane"></i>
            <?= $flight['airline']; ?><br>
            <?= $flight['flight_code']; ?> • <?= $flight['flight_class']; ?>
          </p>

          <p><i class="fa-solid fa-suitcase"></i> Baggage <?= $flight['baggage_weight']; ?> kg</p>
          <p><i class="fa-solid fa-briefcase"></i> Cabin baggage <?= $flight['cabin_baggage_weight']; ?> kg</p>
        </div>

        <div class="right-price">
          <h3>Rp <?= number_format($flight['price'], 0, ',', '.'); ?></h3>
        </div>
      </div>

    </div>
</div>

                <!-- RIGHT: USER FORM -->
                <div class="personal-info">
                    <h2>Personal Information</h2>

                    <form id="customer-form">
                        <div class="gender">
                            <label><input type="radio" name="gender" value="Male" <?= ($userProfile && $userProfile['gender'] == 'Male') ? 'checked' : '' ?>> Male</label>
                            <label><input type="radio" name="gender" value="Female" <?= ($userProfile && $userProfile['gender'] == 'Female') ? 'checked' : '' ?>> Female</label>
                        </div>

                        <div class="name-row">
                            <div class="input-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="<?= $userProfile['first_name'] ?? '' ?>" required>
                            </div>
                            <div class="input-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="<?= $userProfile['last_name'] ?? '' ?>" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" value="<?= $userProfile['email'] ?? '' ?>" readonly>
                        </div>

                        <div class="name-row">
                            <div class="input-group">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" value="<?= $userProfile['date_of_birth'] ?? '' ?>">
                            </div>
                            <div class="input-group">
                                <label>City of Residence</label>
                                <input type="text" name="city" value="<?= $userProfile['city'] ?? '' ?>">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="button-container">
<form method="POST" action="../backend/create-booking.php">
    <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
    <button class="confirm-button" type="submit">Payment</button>
</form>


        </div>
    </main>

</body>

</html>