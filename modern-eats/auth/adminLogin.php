<?php // Start session to track login (optional)
include '../includes/dbConnect.php';
session_start();

// Get login data (e.g. from POST request)
$email = $_POST['email'] ?? '';
$password = $_POST['pass'] ?? '';

// Simple validation
if (empty($email) || empty($password)) {
    die("Email and password are required.");
}

// Prepare statement to fetch hashed password
$stmt = $mysqli->prepare("SELECT admin_id, full_name, hashed_password FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $admin['hashed_password'])) {
        // Login successful
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['admin_name'] = $admin['full_name'];

        echo "Login successful. Welcome, " . htmlspecialchars($admin['full_name']) . "!";
        
         header("Location: http://localhost/modern-eats/admin/admin.php");
    } else {
        echo "Incorrect password.";
        header("Location: http://localhost/modern-eats/auth/login.php");
    }
} else {
    echo "No admin found with that email.";
}

// Close resources
$stmt->close();
$conn->close();
?>