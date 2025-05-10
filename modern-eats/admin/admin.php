<?php
session_start();
$BASE_URL = "http://localhost/modern-eats";

if (isset($_SESSION['admin_id'])) {
  
  $user = $_SESSION['admin_name'];
}

include '../includes/dbConnect.php';

$stmt = $mysqli->prepare("SELECT SUM(price * quantity) AS total FROM order_items");
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $totalAmount = $row['total'];
    //echo "Total amount of all orders: ₹" . $totalAmount;
} else {
    //echo "No data found.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css">
    <?php 
      include '../includes/dbConnect.php';
      include '../includes/bootstrapcdn.php';
    ?>

</head>
<body>
    <header class="admin-header">
        <a href="http://localhost/modern-eats/admin/admin.php" class="logo">Modern Eats Admin</a>
        <div class="admin-nav">
            <a href="#"><i class="fas fa-bell"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
                <span>Admin <?= htmlspecialchars($user) ?></span>  
            <a href="http://localhost/modern-eats/auth/logout.php"><button class="logout-btn">Logout</button></a>
            <a href="http://localhost/modern-eats/admin/onlineOrders.php"><button class="logout-btn">View Online Orders</button></a>
            
        </div>
    </header>

    <div class="admin-container">
        

        <main class="main-content">
            <h1 class="dashboard-title">Dashboard Overview</h1>
            
            <div class="stats-container">
                <div class="stat-card">
                    <span class="stat-title">Total Revenue</span>
                    <span class="stat-value"><?php echo $totalAmount ?></span>
                    <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 12% from last month</span>
                </div>
                <div class="stat-card">
                    <span class="stat-title">Today's Reservations</span>
                    <span class="stat-value">1</span>
                    <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 3 from yesterday</span>
                </div>
                <div class="stat-card">
                    <span class="stat-title">Occupancy Rate</span>
                    <span class="stat-value">0%</span>
                    <span class="stat-change negative"><i class="fas fa-arrow-down"></i> 5% from last week</span>
                </div>
                <div class="stat-card">
                    <span class="stat-title">Customer Satisfaction</span>
                    <span class="stat-value">4.8/5</span>
                    <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 0.2 from last month</span>
                </div>
            </div>

            <div class="action-bar">
                <h2 class="section-title">Recent Reservations</h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search reservations...">
                </div>
                <a class="btn btn-primary" id="addReservationBtn"><i class="fas fa-plus" href=""></i> Add Reservation</a>
            </div>

            <?php

// Query to join reservation and reservation_tables
$sql = "
    SELECT 
        r.cust_id,
        r.customer_name,
        r.reservation_date,
        r.reservation_time,
        r.cust_contact,
        r.number_of_people,
        GROUP_CONCAT(rt.table_id) AS tables_reserved
    FROM reservations r
    JOIN reservation_tables rt ON r.cust_id = rt.cust_id
    GROUP BY r.cust_id
";

$result = mysqli_query($mysqli, $sql);

// Display as HTML table
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='8' cellspacing='0' class='reservations-table'>";
    echo "
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Contact</th>
            <th>Number of People</th>
            <th>Tables Reserved</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
          ";

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr 
        data-cust-id="' . htmlspecialchars($row['cust_id']) . '"
        data-date="' . htmlspecialchars($row['reservation_date']) . '"
        data-time="' . htmlspecialchars($row['reservation_time']) . '">';

        echo "<td>" . htmlspecialchars($row['cust_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['reservation_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['reservation_time']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cust_contact']) . "</td>";
        echo "<td>" . htmlspecialchars($row['number_of_people']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tables_reserved']) . "</td>";
        echo " <td><span class='status-badge status-confirmed'>Confirmed</span></td>
                        <td>
                            <div class='action-btns'>
                                <button class='btn btn-success btn-sm'><i class='fas fa-edit'></i></button>
                                <button class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>
                            </div>
                        </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No reservations found.</p>";
}

mysqli_close($mysqli);
?>

        </main>
    </div>

    <!-- Add Reservation Modal -->
    <div class="modal" id="addReservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Reservation</h3>
                <button class="close-btn" id="closeModal">&times;</button>
            </div>
            <form id="reservationForm" action="../admin/adminAddReserve.php" method="post">
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" id="customerName" required name="name">
                </div>
                
                <div class="form-group">
                    <label for="customerPhone">Phone</label>
                    <input type="tel" id="customerPhone" required name="phone">
                </div>
                <div class="form-group">
                    <label for="reservationDate">Date</label>
                    <input type="date" id="reservationDate" required name="date">
                </div>
                <div class="form-group">
                    <label for="reservationTime">Time</label>
                    <input type="time" id="reservationTime" required name="time">
                </div>
                <div class="form-group">
                    <label for="guests">Number of Guests</label>
                    <input type="number" id="guests" min="1" max="46" required name="people">
                </div>
                <div class="form-group">
                    <label for="tableNumber">Table Number</label>
                    <select id="tableNumber" required>
                        <option value="">Select Table</option>
                        <option value="1">Table 1</option>
                        <option value="2">Table 2</option>
                        <option value="3">Table 3</option>
                        <option value="4">Table 4</option>
                        <option value="5">Table 5</option>
                        <option value="6">Table 6</option>
                        <option value="7">Table 7</option>
                        <option value="8">Table 8</option>
                        <option value="9">Table 9</option>
                        <option value="10">Table 10</option>
                        <option value="11">Table 11</option>
                        <option value="12">Table 12</option>
                        <option value="13">Table 13</option>
                        <option value="14">Table 14</option>
                        <option value="15">Table 15</option>
                        <option value="16">Table 16</option>
                        <option value="17">Table 17</option>
                        
                    </select>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="cancelReservation">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const addReservationBtn = document.getElementById('addReservationBtn');
        const addReservationModal = document.getElementById('addReservationModal');
        const closeModal = document.getElementById('closeModal');
        const cancelReservation = document.getElementById('cancelReservation');

        addReservationBtn.addEventListener('click', () => {
            addReservationModal.style.display = 'flex';
        });

        closeModal.addEventListener('click', () => {
            addReservationModal.style.display = 'none';
        });

        cancelReservation.addEventListener('click', () => {
            addReservationModal.style.display = 'none';
        });

        // Close modal when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === addReservationModal) {
                addReservationModal.style.display = 'none';
            }
        });

        // Form submission
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the data to your backend
            alert('Reservation added successfully!');
            addReservationModal.style.display = 'none';
            // Reset form
            this.reset();
            // In a real app, you would update the reservations table here
        });

        // Delete reservation functionality
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function () {
                
            const row = button.closest('tr');
            const custId = row.getAttribute('data-cust-id');
            const date = row.getAttribute('data-date');
            const time = row.getAttribute('data-time');

            if (confirm("Delete this reservation?")) {
                fetch('http://localhost/modern-eats/admin/deleteReservation.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `cust_id=${encodeURIComponent(custId)}&date=${encodeURIComponent(date)}&time=${encodeURIComponent(time)}`
                })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === 'success') {
                        alert('Reservation Deleted Succesfully');
                        row.remove(); // Remove from frontend
                    } else {
                        alert('Error deleting reservation');
                    }
                });
            }
        });
        });

    </script>
 

</body>
</html>
