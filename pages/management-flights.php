<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Management Users</title>
    <link rel="stylesheet" href="/styles/management-flights.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="sidebar">
    <div class="logo">JetWay<br><span class="admin-text">Admin</span></div>

    <div class="menu-section">
      <div class="menu-title">Dashboard</div>
      <div class="menu-item"><i class="fa fa-chart-line"></i> Analytics</div>
    </div>

    <div class="menu-section">
      <div class="menu-title">Management</div>
      <div class="menu-item active"><i class="fa fa-plane"></i> Flights</div>
      <div class="menu-item"><i class="fa fa-users"></i> Users</div>
    </div>
  </div>

  <div class="content">
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Flight Number</th>
            <th>Airline</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Price</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>

        <tbody>
            <!-- Flight Data -->
            <tr>
                <td>SMJ-2203</td><td>Garuda Air</td><td>YIA</td>
                <td>JFK</td><td>24/12/25</td><td>IDR 7.900.000</td><td>Upcoming</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>MAP-1605</td><td>Batik Air</td><td>CGK</td>
                <td>ICN</td><td>22/03/25</td><td>IDR 7.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>DFR-0708</td><td>Sriwijaya Air</td><td>SUB</td>
                <td>HND</td><td>16/05/25</td><td>IDR 11.500.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>KRD-0307</td><td>CitiLink</td><td>KNO</td>
                <td>NRT</td><td>07/08/25</td><td>IDR 8.200.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>SYY-1410</td><td>Lion Air</td><td>BPN</td>
                <td>CDG</td><td>03/07/25</td><td>IDR 13.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>RBB-2212</td><td>Lion Air</td><td>KJT</td>
                <td>AMS</td><td>21/11/25</td><td>IDR 9.800.000</td><td>On-time</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>LYY-2802</td><td>Garuda Air</td><td>YIA</td>
                <td>JFK</td><td>24/12/25</td><td>IDR 7.900.000</td><td>Upcoming</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>GMY-1112</td><td>Citilink</td><td>UPG</td>
                <td>FCO</td><td>21/11/25</td><td>IDR 12.000.000</td><td>Delayed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>JHH-4410</td><td>Lion Air</td><td>BPN</td>
                <td>CDG</td><td>03/07/25</td><td>IDR 13.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>HNL-2232</td><td>Citilink</td><td>UPG</td>
                <td>FCO</td><td>21/11/25</td><td>IDR 12.000.000</td><td>Delayed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>CTL-1411</td><td>Lion Air</td><td>BPN</td>
                <td>CDG</td><td>03/07/25</td><td>IDR 13.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>PHS-4312</td><td>Citilink</td><td>UPG</td>
                <td>FCO</td><td>21/11/25</td><td>IDR 12.000.000</td><td>Delayed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>ZLE-1419</td><td>Lion Air</td><td>BPN</td>
                <td>CDG</td><td>03/07/25</td><td>IDR 13.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>MJN-2802</td><td>Citilink</td><td>UPG</td>
                <td>FCO</td><td>21/11/25</td><td>IDR 12.000.000</td><td>Delayed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
            <tr>
                <td>JHB-9910</td><td>Lion Air</td><td>BPN</td>
                <td>CDG</td><td>03/07/25</td><td>IDR 13.000.000</td><td>Completed</td>
                <td><span class="edit-btn">Edit</span></td><td><span class="delete-btn">Delete</span></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</html>