<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Dashboard Analytics</title>
    <link rel="stylesheet" href="/styles/dashboard-analytics.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
     <div class="app">

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="brand">
        <div class="logo">JetWay</div>
        <div class="small"><b>Admin</b></div>
      </div>

      <nav class="menu">
        <button class="menu-item active">📊 Dashboard</button>
        <button class="menu-item">📈 Analytics</button>
        <button class="menu-item">🗂 Management</button>
        <button class="menu-item">🔄 Update</button>
      </nav>
    </aside>

    <!-- Main -->
    <main class="main">
    
      <div class="topbar">
    <div class="searchbar">
        <input type="search" placeholder="Search..." />
        <button>
            <img src="/FOTO/search button.png" alt="iconcari" width="24" height="24">
        </button>
        <button>
            <img src="/FOTO/icon mikrofon.png" alt="iconmic" width="18" height="18">
        </button>
    </div>
     <div class="profile-container">
        <img src="/FOTO/person.png" alt="Profile">
    </div>
</div>




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