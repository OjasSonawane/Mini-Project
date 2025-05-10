<?php
session_start();
$conn = new mysqli("localhost", "root", "", "modern_eats");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$customerName = $_SESSION['username'];
// Start transaction
$conn->begin_transaction();

try {
    // 1. Get form data
    $orderData = json_decode($_SESSION['orderInfo'], true);
    $customerName = $conn->real_escape_string($_SESSION['username']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // 2. Calculate total
    $totalAmount = 0;
    foreach ($orderData as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // 3. Insert into `orders`
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, total_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $customerName, $phone, $totalAmount);
    $stmt->execute();
    $orderId = $conn->insert_id;
    $stmt->close();

    // 4. Insert each item into `order_items`
    foreach ($orderData as $item) {
        $itemName = $conn->real_escape_string($item['name']);
        $quantity = (int)$item['quantity'];
        $price = (float)$item['price'];

        // Find item_id from menu_items
        $result = $conn->query("SELECT id FROM menu_items WHERE name = '$itemName' LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $itemId = $row['id'];

            $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $orderId, $itemId, $quantity, $price);
            $stmt->execute();
            $stmt->close();
        } else {
            throw new Exception("Item '$itemName' not found in menu_items.");
        }
    }

    // Everything went well
    $conn->commit();
    echo "✅ Order placed successfully. Order ID: $orderId";
    header("Location: http://localhost/modern-eats/order/success.php");

} catch (Exception $e) {
    // Something failed
    $conn->rollback();
    echo "❌ Order failed: " . $e->getMessage();
}

$conn->close();
?>
