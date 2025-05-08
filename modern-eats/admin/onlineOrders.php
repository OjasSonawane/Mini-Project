<?php
session_start();
$user = $_SESSION['admin_name'];
$conn = new mysqli("localhost", "root", "", "modern_eats");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get orders and their items
$sql = "
SELECT 
    o.id AS order_id,
    o.customer_name,
    o.phone,
    o.order_time,
    o.total_amount,
    o.status,
    o.payment_status,
    m.name AS item_name,
    oi.quantity,
    oi.price
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
JOIN menu_items m ON oi.item_id = m.id
ORDER BY o.order_time DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders</title>
    <link rel="stylesheet" href="../styles/onlineOrders.css">
</head>
<body>
<header class="admin-header">
        <a href="http://localhost/modern-eats/admin/admin.php"" class="logo">Modern Eats Admin</a>
        <div class="admin-nav">
            <a href="#"><i class="fas fa-bell"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
                <span>Admin <?= htmlspecialchars($user) ?></span>  
            <a href="http://localhost/modern-eats/auth/logout.php"><button class="logout-btn">Logout</button></a>
            <a href="http://localhost/modern-eats/admin/onlineOrders.php"><button class="logout-btn">View Online Orders</button></a>
            
        </div>
    </header>
    <h1>All Orders</h1>

    <?php
    if ($result->num_rows > 0) {
        $currentOrderId = null;

        while ($row = $result->fetch_assoc()) {
            if ($row['order_id'] !== $currentOrderId) {
                // Close previous table if not first
                if ($currentOrderId !== null) {
                    echo "</table>";
                    echo "</div>";
                }

                // Start new order block
                $currentOrderId = $row['order_id'];
                echo "<div class='order-block'>";
                echo "<h2>Order #{$row['order_id']}</h2>";
                echo "<p><strong>Customer:</strong> {$row['customer_name']}<br>";
                echo "<strong>Phone:</strong> {$row['phone']}<br>";
                echo "<strong>Order Time:</strong> {$row['order_time']}<br>";
                echo "<strong>Total:</strong> ₹{$row['total_amount']}<br>";
                echo "<strong>Status:</strong> {$row['status']}<br>";
                echo "<strong>Payment:</strong> {$row['payment_status']}</p>";
                echo "<table>";
                echo "<tr><th>Item</th><th>Quantity</th><th>Price</th></tr>";
            }

            // Add item row
            echo "<tr>
                    <td>{$row['item_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>₹{$row['price']}</td>
                  </tr>";
        }

        // Close final table and block
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p>No orders found.</p>";
    }

    $conn->close();
    ?>

</body>
</html>
