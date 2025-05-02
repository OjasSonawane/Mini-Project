<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cust_id'], $_POST['date'], $_POST['time'])) {
    $cust_id = $_POST['cust_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

  include '../includes/dbConnect.php';

    // First delete from reservation_tables
    $sql1 = "DELETE FROM reservation_tables 
             WHERE cust_id = ? AND reservation_date = ? AND reservation_time = ?";
    $stmt1 = mysqli_prepare($mysqli, $sql1);
    mysqli_stmt_bind_param($stmt1, "iss", $cust_id, $date, $time);
    mysqli_stmt_execute($stmt1);

    // Then delete from reservation
    $sql2 = "DELETE FROM reservations 
             WHERE cust_id = ? AND reservation_date = ? AND reservation_time = ?";
    $stmt2 = mysqli_prepare($mysqli, $sql2);
    mysqli_stmt_bind_param($stmt2, "iss", $cust_id, $date, $time);
    mysqli_stmt_execute($stmt2);

    if (mysqli_stmt_affected_rows($stmt2) > 0) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_close($mysqli);
}
?>
