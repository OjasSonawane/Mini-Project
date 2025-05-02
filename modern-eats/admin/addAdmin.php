<?php
include '../includes/dbConnect.php';

$admin_id = 1; // Hardcoded ID
$full_name = 'Mohan';
$email = 'mohan@gmail.com';
$raw_password = 'Howareyou1@';
$telephone = '1234567890';

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