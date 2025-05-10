<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking - Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/order.css">
    <?php
       include '../includes/bootstrapcdn.php';
     ?>
</head>

<body>
    <div class="background-image"></div>
    <header>
    <?php
       include '../includes/navbar.php';
     ?>
    </header>

    <section id="order-tracking" class="order-tracking-section">
        <div class="order-tracking-container">
            <h1>Order Tracking</h1>
            <p>Track the status of your order in real-time.</p>
            
            <div class="order-status">
                <div class="status-item pending" id="status-order-placed">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Order Placed</span>
                </div>
                <div class="status-item pending" id="status-order-confirmed">
                    <i class="fas fa-check-circle"></i>
                    <span>Order Confirmed</span>
                </div>
                <div class="status-item pending" id="status-order-prepared">
                    <i class="fas fa-utensils"></i>
                    <span>Order Prepared</span>
                </div>
                <div class="status-item pending" id="status-order-delivered">
                    <i class="fas fa-truck"></i>
                    <span>Order Delivered</span>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </div>
        <p>&copy; 2025 Modern Eats. All Rights Reserved.</p>
    </footer>

    <div class="chatbot-icon">
        <i class="fas fa-comments"></i>
    </div>

    <script>
        const statusOrderPlaced = document.getElementById('status-order-placed');
        const statusOrderConfirmed = document.getElementById('status-order-confirmed');
        const statusOrderPrepared = document.getElementById('status-order-prepared');
        const statusOrderDelivered = document.getElementById('status-order-delivered');

        const statusElements = [statusOrderPlaced, statusOrderConfirmed, statusOrderPrepared, statusOrderDelivered];

        let currentStatusIndex = 0;

        function updateOrderStatus() {
            if (currentStatusIndex < statusElements.length) {
                statusElements[currentStatusIndex].classList.remove('pending');
                statusElements[currentStatusIndex].classList.add('completed');
                currentStatusIndex++;
            } else {
                clearInterval(interval);
            }
        }


        const interval = setInterval(updateOrderStatus, 5000);


        updateOrderStatus();
    </script>
</body>

</html>