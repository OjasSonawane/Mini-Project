<?php
include '../includes/dbConnect.php';



// Validate POST data
$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$date = $_POST['date'] ?? null;
$time = $_POST['time'] ?? null;
$people = $_POST['people'] ?? null;

if (!$name || !$phone || !$date || !$time || !$people) {
    die("Missing required fields.");
}

// Check if the user already has a reservation at the given time
// $stmt = $mysqli->prepare("SELECT * FROM reservation_tables WHERE cust_id = ? AND reservation_time = ?");
// if (!$stmt) {
//     die("Prepare failed: " . $mysqli->error);
// }
// $stmt->bind_param("is", $id, $time);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows == 0) { // Correct check for existing reservation

//     // Insert into reservations table
//     $stmt = $mysqli->prepare("INSERT INTO reservations (customer_name, cust_contact, reservation_date, reservation_time, number_of_people, cust_id)
//                               VALUES (?, ?, ?, ?, ?, ?)");
//     if (!$stmt) {
//         die("Prepare failed: " . $mysqli->error);
//     }
//     $stmt->bind_param("ssssii", $name, $phone, $date, $time, $people, $id);

//     if (!$stmt->execute()) {
//         die("Error inserting reservation: " . $stmt->error);
//     }

  
// } else {
//     echo "You already have a reservation at this time.";
// }

$stmt->close();
?>
<?php
include '../includes/dbConnect.php'; // Your database connection

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
