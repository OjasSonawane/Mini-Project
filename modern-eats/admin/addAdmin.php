<?php
include '../includes/dbConnect.php';

$admin_id = 2; // Hardcoded ID
$full_name = 'admin';
$email = 'admin1@gmail.com';
$raw_password = 'Admin123@';
$telephone = '0101010101';

// Hash the password
$hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

// Prepare the INSERT statement with admin_id
$stmt = $mysqli->prepare("INSERT INTO admin (admin_id, full_name, email, hashed_password, telephone) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $admin_id, $full_name, $email, $hashed_password, $telephone);

// Execute the statement
if ($stmt->execute()) {
    echo "Admin added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>