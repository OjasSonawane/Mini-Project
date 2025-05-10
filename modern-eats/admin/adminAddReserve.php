<?php
include '../includes/dbConnect.php'; // connect as $mysqli

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $date  = $_POST['date'];
    $time  = $_POST['time'];
    $people = $_POST['people'];
    $table = $_POST['table'];  // Selected table number

    // Begin transaction for safety
    $mysqli->begin_transaction();

    try {
        // Insert into reservations table
        $stmt1 = $mysqli->prepare("INSERT INTO reservations (name, phone, date, time, people) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssssi", $name, $phone, $date, $time, $people);
        $stmt1->execute();

        // Get the auto-incremented reservation ID
        $cust_id = $stmt1->insert_id;

        // Insert into reservation_tables
        $stmt2 = $mysqli->prepare("INSERT INTO reservation_tables (cust_id, reservation_date, reservation_time, table_number) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isss", $cust_id, $date, $time, $table);
        $stmt2->execute();

        // Commit transaction
        $mysqli->commit();

        echo "Reservation added successfully!";
        // Optionally redirect
        // header("Location: reservationsList.php");
    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
