<?php
include '../includes/dbConnect.php';
// Only run if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user_id = intval($_POST["userId"]);
  $reservation_date = $_POST["reservation_date"];
  $reservation_time = $_POST["reservation_time"];

  // Prepare and run DELETE query
  $stmt = $mysqli->prepare("DELETE FROM reservations WHERE cust_id = ? AND reservation_date = ? AND reservation_time = ?");
  $stmt->bind_param("iss", $user_id, $reservation_date, $reservation_time);


  if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
      
    
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
            <h2>🎉 Reservation Cancelled!</h2>
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
  }
  else {
    // If no reservation is found for the user
    echo "<div class='error' style='color: red; text-align: center; padding: 20px;'>❌ No reservation found for this ID.</div>
    <button onclick='goBack()' style='
                padding: 10px 20px;
                background-color: #100;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
            '>Go Back</button>
            
            
        <script>
            function goBack() {
                window.location.href = 'http://localhost/modern-eats/reservation/cancelReservation.php'; // Redirect to cancellation page
            }
        </script>
            ";
}
}
  else {
    echo "Error cancelling reservation: " . $stmt->error;
  }

  $stmt->close();
}

$mysqli->close();
?>