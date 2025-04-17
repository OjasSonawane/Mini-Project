<?php
header("Content-Type: application/json");
include "../includes/dbConnect.php"; // Your database connection file

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);
$date = $data["date"];
$time = $data["time"];

$reservedTables = [];

$sql = "SELECT table_id FROM reservations WHERE reservation_date = ? AND reservation_time = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $date, $time);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $reservedTables[] = (int) $row["table_id"];
}

$stmt->close();
$conn->close();

echo json_encode($reservedTables);
?>
