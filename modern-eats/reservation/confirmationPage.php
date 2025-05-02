
<?php
include '../includes/dbConnect.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';



$id = $_SESSION['reservationId'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$stmt = $mysqli->prepare("SELECT * FROM reservation_tables WHERE cust_id = ? AND reservation_date = ? AND reservation_time = ?");
$stmt->bind_param("iss", $id,$_SESSION['date'],$_SESSION['time']);

if ($stmt->execute()) {
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    // Fetch reservation details from the database

    $reservation = $result->fetch_assoc();
    $reservation_date = $reservation['reservation_date'];
    $reservation_time = $reservation['reservation_time'];
  

    
   
    $tables = implode(",",$_SESSION['tables']);


        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        // $mail->SMTPDebug = 2; // Options: 0 = off, 1 = client messages, 2 = client + server messages
        // $mail->Debugoutput = 'html';
        try {
            // Server settings
            $mail->isSMTP();                                // Use SMTP
            $mail->Host       = 'smtp.gmail.com';           // Gmail SMTP server
            $mail->SMTPAuth   = true;                       // Enable SMTP auth
            $mail->Username   = 'narvekaromkar428@gmail.com';     // Your Gmail address
            $mail->Password   = 'jmubeepdmdbetuee';        // Gmail App Password
            $mail->SMTPSecure = 'tls';                      // TLS encryption
            $mail->Port       = 587;                        // TCP port for TLS

            // Sender & Recipient
            $mail->setFrom('narvekaromkar428@gmail.com', 'Modern Eats');
            $mail->addAddress($email, $username);

            // Content
            $mail->isHTML(true);
            $mail->Subject = ' Mail from Modern Eats';
            $mail->Body = '
            This is a <b>Email</b> sent for confirmation of reservation of your table.<br>
            Following are the details:<br>
            <p><strong>Name:</strong> ' . htmlspecialchars($username) . '</p>
            <p><strong>Reservation ID:</strong> ' . htmlspecialchars($id) . '</p>
            <p><strong>Date:</strong> ' . htmlspecialchars($reservation_date) . '</p>
            <p><strong>Time:</strong> ' . htmlspecialchars($reservation_time) . '</p>
            <p id><strong>Reserved Tables:</strong>'. htmlspecialchars($tables) .'</p>

            <br>
            <p>In case of cancellation of reservation use the id and reservation time and date. You can cancel any time in the reservations tab. However no refund will be given</p>


     ';
            $mail->AltBody = 'This is a plain-text version of the email content.';

            $mail->send();
            echo 'Email sent successfully!';
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }



    
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
            <h2>🎉 Reservation Confirmed!</h2>
            <p><strong>Name:</strong>$username</p>
            ><strong>Reservation id:</strong>$id</p>
            <p><strong>Date:</strong> $reservation_date</p>
            <p><strong>Time:</strong> $reservation_time</p>
            <p'><strong>Reserved Tables:</strong>$tables </p>
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
                window.location.href = 'http://localhost/modern-eats/reservation/booking.php'; // Redirect to booking page
            }
        </script>
        ";
  } else {
    // If no reservation is found for the user
    echo "<div class='error' style='color: red; text-align: center; padding: 20px;'>❌ No reservation found for this ID.</div>";
  }
} else {
  echo "Error: " . $stmt->error;
}

?>
