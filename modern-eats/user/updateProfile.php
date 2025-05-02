<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$name = trim($data['name']);
$email = trim($data['email']);


if (!$name || !$email) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

include '../includes/dbConnect.php'; // Make sure this file connects to your DB

$userId = $_SESSION['user_id'];
$stmt = $mysqli->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
$stmt->bind_param("sssi", $name, $email, $userId);

if ($stmt->execute()) {
    // Update session too
    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
   

    echo json_encode(['success' => true]);
    header("Location:http://localhost/modern-eats/user/profile.php");
  } else {
    echo json_encode(['success' => false, 'message' => 'Database update failed.']);
}

$mysqli->close();
?>
