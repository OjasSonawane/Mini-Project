<?php
include '../includes/dbConnect.php'; // Your database connection
session_start();
if (isset($_POST['date'], $_POST['time'], $_POST['tables'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $tables = explode(",", $_POST['tables']); // Convert comma-separated values to an array

    if (empty($tables[0])) {
        die("No tables selected.");
    }

    $stmt = $mysqli->prepare("INSERT INTO reservation_tables (cust_id,table_id, reservation_date, reservation_time) VALUES (?,?, ?, ?)");

    foreach ($tables as $table) {
        $stmt->bind_param("iiss",$_SESSION['user_id'], $table, $date, $time);
        $stmt->execute();
    }

    // Redirect to confirmation page after successful booking
    header("Location: http://localhost/modern-eats/reservation/confirmation.php");
    exit();
} else {
    echo "Invalid data!";
}
?>
