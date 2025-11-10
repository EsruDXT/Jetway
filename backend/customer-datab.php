<?php
session_start();
require_once 'config/db-connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in'
    ]);
    exit;
}

// Handle GET request - Fetch user data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'];
    
    $query = $connection->prepare("
        SELECT u.id, u.username, u.email, 
               p.first_name, p.last_name, p.gender, 
               p.date_of_birth, p.city, p.phone, 
               p.address, p.profile_picture
        FROM user_login u
        LEFT JOIN user_profile p ON u.id = p.user_id
        WHERE u.id = ?
    ");
    
    $query->bind_param('i', $user_id);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'data' => $user_data
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found'
        ]);
    }
    exit;
}

// Handle POST request - Update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $user_id = $_SESSION['user_id'];
    
    if ($_POST['action'] === 'update_profile') {
        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $last_name = htmlspecialchars(trim($_POST['last_name']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $date_of_birth = htmlspecialchars(trim($_POST['date_of_birth']));
        $city = htmlspecialchars(trim($_POST['city']));
        $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
        $address = htmlspecialchars(trim($_POST['address'] ?? ''));
        
        // Check if profile exists
        $check_query = $connection->prepare("SELECT user_id FROM user_profile WHERE user_id = ?");
        $check_query->bind_param('i', $user_id);
        $check_query->execute();
        $check_result = $check_query->get_result();
        
        if ($check_result->num_rows > 0) {
            // Update existing profile
            $update_query = $connection->prepare("
                UPDATE user_profile 
                SET first_name = ?, last_name = ?, gender = ?, 
                    date_of_birth = ?, city = ?, phone = ?, address = ?,
                    updated_at = NOW()
                WHERE user_id = ?
            ");
            $update_query->bind_param('sssssssi', 
                $first_name, $last_name, $gender, 
                $date_of_birth, $city, $phone, $address, $user_id
            );
            
            if ($update_query->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Profile updated successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update profile'
                ]);
            }
        } else {
            // Insert new profile
            $insert_query = $connection->prepare("
                INSERT INTO user_profile 
                (user_id, first_name, last_name, gender, date_of_birth, city, phone, address, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $insert_query->bind_param('isssssss', 
                $user_id, $first_name, $last_name, $gender, 
                $date_of_birth, $city, $phone, $address
            );
            
            if ($insert_query->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Profile created successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to create profile'
                ]);
            }
        }
        exit;
    }
    
    if ($_POST['action'] === 'upload_picture') {
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            $max_size = 5 * 1024 * 1024; // 5MB
            
            $file_type = $_FILES['profile_picture']['type'];
            $file_size = $_FILES['profile_picture']['size'];
            
            if (!in_array($file_type, $allowed_types)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed'
                ]);
                exit;
            }
            
            if ($file_size > $max_size) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'File size exceeds 5MB limit'
                ]);
                exit;
            }
            
            // Create upload directory if not exists
            $upload_dir = '../uploads/profiles/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Generate unique filename
            $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extension;
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                // Update database
                $update_query = $connection->prepare("
                    UPDATE user_profile 
                    SET profile_picture = ?, updated_at = NOW()
                    WHERE user_id = ?
                ");
                $update_query->bind_param('si', $new_filename, $user_id);
                
                if ($update_query->execute()) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Profile picture uploaded successfully',
                        'filename' => $new_filename
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Failed to update database'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to upload file'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No file uploaded or upload error'
            ]);
        }
        exit;
    }
}

// Handle invalid requests
echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
?>