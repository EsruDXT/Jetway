<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Dashboard Analytics</title>
    <link rel="stylesheet" href="/styles/dashboard-analytics.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
     <div class="app">

<div class="sidebar">
    <div class="logo">JetWay<br><span class="admin-text">Admin</span></div>

    <div class="menu-section">
        <div class="menu-title">Dashboard</div>
        <a href="/pages/dashboard-analytics.php" class="menu-item active"><i class="fa fa-chart-line"></i> Analytics</a>
    </div>

    <div class="menu-section">
        <div class="menu-title">Management</div>
        <a href="/pages/management-flights.php" class="menu-item"><i class="fa fa-plane"></i> Flights</a>
        <a href="/pages/management-users.php" class="menu-item"><i class="fa fa-users"></i> Users</a>
    </div>
</div>


    <!-- Main -->
    <main class="main">
      <!-- Content -->
      <section class="content">

        <!-- Stat Cards -->
        <div class="cards">
          <div class="card stat">
            <div class="card-title">Completed Flights</div>
            <div class="card-value">212</div>
            <div class="card-meta">▲ 1.25%</div>
          </div>

          <div class="card stat">
            <div class="card-title">Active Flights</div>
            <div class="card-value">76</div>
            <div class="card-meta">▲ 2.55%</div>
          </div>

          <div class="card stat">
            <div class="card-title">Cancelled Flights</div>
            <div class="card-value">12</div>
            <div class="card-meta">▼ 1.05%</div>
          </div>
        </div>

        <!-- Charts -->
        <div class="grid">
          
          <!-- Bar Chart -->
          <div class="card chart large">
            <h3>Ticket Sales</h3>
            <canvas id="ticketChart"></canvas>
            <div class="card-footer">
              <button class="small-btn">This week ▾</button>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="card chart small">
            <h3>Popular Airlines</h3>
            <canvas id="airlineChart"></canvas>
          </div>

        </div>

        <!-- Revenue -->
        <div class="cards-bottom">
          <div class="card revenue">
            <div class="rev-title">Total Revenue</div>
            <div class="rev-value">IDR 67.000.000</div>
            <div class="rev-icon">$</div>
            <div class="rev-meta">▲ 2.25%</div>
          </div>
        </div>

      </section>
    </main>

  </div>

<script src="/scripts/dashboard-analytics.js"></script>
</body>
</html>