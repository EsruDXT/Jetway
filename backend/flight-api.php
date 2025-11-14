<?php
header('Content-Type: application/json');
require_once 'config/db-connection.php';

// Handle GET request - Fetch available flights
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Get filter parameters
    $from = isset($_GET['from']) ? htmlspecialchars(trim($_GET['from'])) : '';
    $to = isset($_GET['to']) ? htmlspecialchars(trim($_GET['to'])) : '';
    $date = isset($_GET['date']) ? htmlspecialchars(trim($_GET['date'])) : '';
    $passengers = isset($_GET['passengers']) ? intval($_GET['passengers']) : 1;
    $class = isset($_GET['class']) ? htmlspecialchars(trim($_GET['class'])) : 'Economy';
    $sort = isset($_GET['sort']) ? htmlspecialchars(trim($_GET['sort'])) : 'price_asc';
    
    // Build query
    $query = "SELECT * FROM flights WHERE 1=1";
    $params = [];
    $types = "";
    
    if (!empty($from)) {
        $query .= " AND (departure_city LIKE ? OR departure_airport LIKE ?)";
        $params[] = "%$from%";
        $params[] = "%$from%";
        $types .= "ss";
    }
    
    if (!empty($to)) {
        $query .= " AND (arrival_city LIKE ? OR arrival_airport LIKE ?)";
        $params[] = "%$to%";
        $params[] = "%$to%";
        $types .= "ss";
    }
    
    if (!empty($date)) {
        $query .= " AND flight_date = ?";
        $params[] = $date;
        $types .= "s";
    }
    
    if (!empty($class)) {
        $query .= " AND class = ?";
        $params[] = $class;
        $types .= "s";
    }
    
    // Check available seats
    $query .= " AND available_seats >= ?";
    $params[] = $passengers;
    $types .= "i";
    
    // Sorting
    switch($sort) {
        case 'price_asc':
            $query .= " ORDER BY price ASC";
            break;
        case 'price_desc':
            $query .= " ORDER BY price DESC";
            break;
        case 'time_asc':
            $query .= " ORDER BY departure_time ASC";
            break;
        case 'time_desc':
            $query .= " ORDER BY departure_time DESC";
            break;
        default:
            $query .= " ORDER BY price ASC";
    }
    
    $stmt = $connection->prepare($query);
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $flights = [];
    while ($row = $result->fetch_assoc()) {
        $flights[] = $row;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $flights,
        'count' => count($flights)
    ]);
    exit;
}

// Handle POST request - Get specific flight details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_flight') {
    $flight_id = intval($_POST['flight_id']);
    
    $query = $connection->prepare("SELECT * FROM flights WHERE id = ?");
    $query->bind_param('i', $flight_id);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode([
            'status' => 'success',
            'data' => $result->fetch_assoc()
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Flight not found'
        ]);
    }
    exit;
}

// Invalid request
echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
?>