<?php
require_once "../backend/config/db-connection.php";

// Ambil semua user + profile (LEFT JOIN supaya tidak error kalau profil belum ada)
$query = $connection->prepare("
    SELECT 
        user_login.id AS user_id,
        user_login.username,
        user_login.email,
        user_profile.first_name,
        user_profile.last_name,
        user_profile.phone
    FROM user_login
    LEFT JOIN user_profile ON user_profile.user_id = user_login.id
    ORDER BY user_login.id DESC
");
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jetway - Management Users</title>
    <link rel="stylesheet" href="/styles/management-users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            JetWay<br><span class="admin-text">Admin</span>
        </div>

        <div class="menu-section">
            <div class="menu-title">Dashboard</div>
            <a href="/pages/dashboard-analytics.php" class="menu-item">
                <i class="fa fa-chart-line"></i> Analytics
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-title">Management</div>
            <a href="/pages/management-flights.php" class="menu-item">
                <i class="fa fa-plane"></i> Flights
            </a>
            <a href="/pages/management-users.php" class="menu-item active">
                <i class="fa fa-users"></i> Users
            </a>
        </div>
    </div>

    <div class="content">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                            $fullName = ($row['first_name'] || $row['last_name'])
                                ? $row['first_name'] . " " . $row['last_name']
                                : "—";
                            $phone = $row['phone'] ?: "—";
                        ?>

                        <tr>
                            <td><?= htmlspecialchars("USR-" . $row['user_id']) ?></td>
                            <td><?= htmlspecialchars($fullName) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($phone) ?></td>

                            <td>
                                <span class="edit-btn" onclick="editUser(<?= $row['user_id'] ?>)">Edit</span>
                            </td>

                            <td>
                                <span class="delete-btn" onclick="deleteUser(<?= $row['user_id'] ?>)">Delete</span>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>

            </table>
        </div>
    </div>

    <script>
        function deleteUser(id) {
            if (confirm("Delete this user? This action cannot be undone.")) {
                window.location.href = "../backend/delete-user.php?id=" + id;
            }
        }

        function editUser(id) {
            window.location.href = "../pages/edit-user.php?id=" + id;
        }
    </script>
</body>
</html>
