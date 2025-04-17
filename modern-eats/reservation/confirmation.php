<?php
include '../includes/dbConnect.php';
session_start();

// Fetch the reservation details using the user_id from the session
$id = $_SESSION['user_id'];
$usename = $_SESSION['username'];
$stmt = $mysqli->prepare("SELECT * FROM reservation_tables WHERE cust_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Fetch reservation details from the database
        $reservation = $result->fetch_assoc();
        $reservation_date = $reservation['reservation_date'];
        $reservation_time = $reservation['reservation_time'];
        $reserved_tables = $reservation['table_id']; // Assuming this column exists

        // Display the confirmation message
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
            <p><strong>Reserved Tables:</strong> $reserved_tables</p>
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

$stmt->close();
?>
