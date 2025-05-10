<?php
include '../includes/dbConnect.php';
session_start();
$id = $_SESSION['reservationId'];
$username = $_SESSION['name'];
$phone =  $_SESSION['phone'];
$date =  $_SESSION['date'];
$time = $_SESSION['time'];
$people = $_SESSION['people'];

$tables = $_SESSION['tables'];


//Check if the user already has a reservation at the given time
$stmt = $mysqli->prepare("SELECT * FROM reservation_tables WHERE cust_id = ? AND reservation_time = ? AND reservation_date = ?");
if (!$stmt) {
  die("Prepare failed: " . $mysqli->error);
}
$stmt->bind_param("iss", $id, $time, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) { // Correct check for existing reservation

  // Insert into reservations table
  $stmt = $mysqli->prepare("INSERT INTO reservations (customer_name, cust_contact, reservation_date, reservation_time, number_of_people, cust_id)
                              VALUES (?, ?, ?, ?, ?, ?)");
  if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
  }
  $stmt->bind_param("ssssii", $username, $phone, $date, $time, $people, $id);
  if (!$stmt->execute()) {
    die("Error inserting into reservations: " . $stmt->error);
  }
  $stmt = $mysqli->prepare("INSERT INTO reservation_tables (cust_id,table_id, reservation_date, reservation_time) VALUES (?,?, ?, ?)");

  foreach ($tables as $table) {
    $stmt->bind_param("iiss", $id, $table, $date, $time);
    if (!$stmt->execute()) {
      die("Error inserting into reservation_tables: " . $stmt->error);
    }
  }
  header("Location: http://localhost/modern-eats/reservation/confirmationPage.php");
} else {
  $stmt = $mysqli->prepare("INSERT INTO reservation_tables (cust_id,table_id, reservation_date, reservation_time) VALUES (?,?, ?, ?)");

  foreach ($tables as $table) {
    $stmt->bind_param("iiss", $id, $table, $date, $time);
    if (!$stmt->execute()) {
      die("Error inserting into reservation_tables: " . $stmt->error);
    }
  }
  header("Location: http://localhost/modern-eats/reservation/confirmationPage.php");
}

$stmt->close();


$mysqli->close();
?>