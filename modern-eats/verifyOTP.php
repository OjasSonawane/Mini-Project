<?php
session_start();
include '../includes/dbConnect.php';

$error = "";

// Check if session data exists
if (!isset($_SESSION['temp_user'])) {
    die("Session expired or invalid access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST['otp'];
    $userData   = $_SESSION['temp_user'];

    if ($enteredOtp == $userData['otp']) {
        $id       = random_int(1, 100000);
        $username = $userData['username'];
        $email    = $userData['email'];
        $password = $userData['password'];

        $stmt = $mysqli->prepare("INSERT INTO users (user_id, username, email, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id, $username, $email, $password);

        if ($stmt->execute()) {
            // Login session
            $_SESSION['user_id']   = $id;
            $_SESSION['username']  = $username;
            $_SESSION['logged_in'] = true;

            // Cleanup temp session
            unset($_SESSION['temp_user']);

            header("Location: ../index.php");
            exit;
        } else {
            $error = "❌ Failed to register user: " . $stmt->error;
        }
    } else {
        $error = "❌ Invalid OTP. Try again.";
    }
}
?>

<!-- OTP FORM -->
<div style="max-width: 400px; margin: 50px auto; font-family: Arial, sans-serif;">
    <h2>🔐 OTP Verification</h2>
    <form method="POST" action="verifyOTP.php">
        <label>Enter OTP sent to your email:</label><br><br>
        <input type="text" name="otp" required style="width: 100%; padding: 8px;"><br><br>
        <button type="submit" style="padding: 10px 20px;">Verify</button>
    </form>

    <?php if (!empty($error)): ?>
        <div style="margin-top: 20px; color: red;">
            <?= $error ?>
        </div>
    <?php endif; ?>
</div>
