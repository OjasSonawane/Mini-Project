<?php
header("Content-Type: application/json");
include "../includes/dbConnect.php"; // Your database connection file

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check if the data is valid
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON input"]);
    exit;
}

$date = $data["date"];
$time = $data["time"];

$reservedTables = [];

// Prepare the SQL query
$sql = "SELECT table_id FROM reservation_tables WHERE reservation_date = ? AND reservation_time = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    echo json_encode(["error" => "Failed to prepare the SQL statement"]);
    exit;
}

$stmt->bind_param("ss", $date, $time);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservedTables[] = $row["table_id"];
    }
} else {
    $reservedTables = [];
    
}

$stmt->close();
$mysqli->close();

// Return the result as JSON
echo json_encode($reservedTables);
?>
