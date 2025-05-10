<?php
include '../includes/dbConnect.php';
$BASE_URL = "http://localhost/modern-eats"; 
session_start();

if (!isset($_POST['email']) || !isset($_POST['pass'])) {
    die("Invalid request.");
}

$email = trim($_POST['email']);
$pass = $_POST['pass'];

try {
    // Use a prepared statement to prevent SQL injection
    $search = "SELECT password_hash,username,user_id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($mysqli, $search);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        
        if (password_verify($pass, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['user_id'];  // Store user ID
$_SESSION['username'] = $row['username'];  // Store username
$_SESSION['logged_in'] = true; 
$_SESSION['email'] = $email;
            
            echo "
            <div id='reservationDetails' style='
                background-color: #e8f5e9;
                color: #2e7d32;
                padding: 20px;
                margin: 20px auto;
                border: 1px solid #66bb6a;
                border-radius: 10px;
                width: 50%;
                text-align: center;
                font-family: Arial, sans-serif;
            '>
                <h2>🎉 Signed in Successfully!</h2>
                <button onclick='goBack()' style='
                    padding: 10px 20px;
                    background-color: #388e3c;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    margin-top: 20px;
                '>Go Back</button>
            </div>

            <script>
                function goBack() {
                    window.location.href = 'http://localhost/modern-eats/index.php'; // Redirect to main page
                }
            </script>
            ";
        } else {
            showErrorMessage("Login failed. Incorrect password.");
        }
    } else {
        showErrorMessage("Login failed. No user found.");
    }

    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    showErrorMessage("An error occurred. Please try again.");
}

function showErrorMessage($message) {
    echo "
    <div id='reservationDetails' style='
        background-color: #fce4ec;
        color:rgb(217, 63, 20);
        padding: 20px;
        margin: 20px auto;
        border: 1px solid rgb(214, 71, 61);
        border-radius: 10px;
        width: 50%;
        text-align: center;
        font-family: Arial, sans-serif;
    '>
        <h2>$message</h2>
        <button onclick='goBack()' style='
            padding: 10px 20px;
            background-color:rgb(214, 71, 61);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        '>Go Back</button>
    </div>

    <script>
        function goBack() {
            window.location.href = 'http://localhost/modern-eats/auth/login.php'; // Redirect to login page
        }
    </script>
    ";
}
?>
