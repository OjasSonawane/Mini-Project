<?php 
include '../includes/dbConnect.php';
$BASE_URL = "http://localhost/modern-eats"; 
if(isset($_POST['name'])){
  $name = $_POST['name'];
}
if(isset($_POST['email'])){
  $email = $_POST['email'];
}
if(isset($_POST['password'])){
  $pass = $_POST['password'];
}

$id = random_int(1, 100000);

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);


try{
  // Assuming you have a database connection $conn
$stmt = $mysqli->prepare("INSERT INTO users (user_id, username, email, password_hash) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $id, $name, $email, $hashed_password);
$stmt->execute();
$stmt->close();

  session_start();
  $_SESSION['user_id'] = $id; // Store user ID
  $_SESSION['username'] = $name;  // Store username
  $_SESSION['email'] = $email;
  $_SESSION['logged_in'] = true;
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
            <h2>🎉 Signed in Succesfully!</h2>
            
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
                window.location.href = 'http://localhost/modern-eats/index.php'; // Redirect to booking page
            }
        </script>
    ";
  
}
catch(Exception $e){
  echo $e->getMessage();
  echo "
  <div id='reservationDetails' style='
      background-color: #e8f5e9;
      color:rgb(217, 63, 20);
      padding: 20px;
      margin: 20px auto;
      border: 1px solid rgb(214, 71, 61);
      border-radius: 10px;
      width: 50%;
      text-align: center;
      font-family: Arial, sans-serif;
  '>
      <h2>Sign Up failed. Try again</h2>
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
          window.location.href = 'http://localhost/modern-eats/auth/signUp.php'; // Redirect to booking page
      }
  </script>
";
}
 
?>
<?php /*
session_start();
include '../includes/dbConnect.php'; // DB connection
require 'mailerConfig.php';         // PHPMailer config

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // Store user data + OTP in session temporarily
    $_SESSION['temp_user'] = [
        'username' => $username,
        'email'    => $email,
        'password' => $password,
        'otp'      => $otp
    ];

    // Send OTP email
    if (sendOTP($email, $otp)) {
        header("Location: verifyOTP.php");
        exit;
    } else {
        echo "❌ Failed to send OTP. Please try again.";
    }
}*/
?>
