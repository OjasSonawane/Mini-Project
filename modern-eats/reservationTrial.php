<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Table - Epicurean Bistro</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="reservationTrial.php">
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <div>Modern Eats</div>
        </a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="#">Cancel Reservation</a></li>
        </ul>
    </header>
    <div class="cont">

        <main class="main-container">
            <section class="form-container">
                <h2>Book a Table</h2>
                <?php if (isset($booking_error)): ?>
                    <div class="error"><?php echo $booking_error; ?></div>
                <?php elseif (isset($booking_success)): ?>
                    <div class="success"><?php echo $booking_success; ?></div>
                <?php endif; ?>
                <form id="booking-form" class="booking-form" method="POST" action="">
                    <div class="input-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required placeholder="Enter your full name">
                    </div>
                    <div class="input-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
                    </div>
                    <div class="input-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="input-group">
                        <label for="time">Time:</label>
                        <select id="time" name="time" required>
                            <?php
                            $startTime = 12;
                            $endTime = 23;
                            for ($hour = $startTime; $hour <= $endTime; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 30) {
                                    $time = sprintf("%02d:%02d", $hour, $minute);
                                    echo "<option value='$time'>$time</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="people">Number of People:</label>
                        <input type="number" id="people" name="people" required min="1" placeholder="Enter number of people">
                    </div>
                    <input type="hidden" id="tableId" name="tableId">
                    <button type="submit" name="book_table" class="submit-btn">Book Table</button>
                </form>
            </section>

            <section class="table-booking-container">
            <h2>Select Your Table</h2>
            <div class="table-photo">
                <img src="2.jpg" alt="Table Layout" style="width: 100%; border-radius: 10px;">
            </div>
            <div id="table-selection" class="table-selection">
                <?php foreach ($tables as $table): ?>
                    <div class="table" data-table-id="<?php echo $table['id']; ?>" onclick="selectTable(this)">
                        Table <?php echo $table['table_number']; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section> -->

             <section class="cancel-reservation-container">
                <h2>Cancel Reservation</h2>
                <?php if (isset($cancel_error)): ?>
                    <div class="error"><?php echo $cancel_error; ?></div>
                    <?php elseif (isset($cancel_success)): ?>
                        <div class="success"><?php echo $cancel_success; ?></div>
                        <?php endif; ?>
            <form id="cancel-form" method="POST" action="">
                <div class="input-group">
                    <label for="cancel-phone">Phone Number:</label>
                    <input type="tel" id="cancel-phone" name="cancel-phone" required placeholder="Enter your phone number">
                </div>
                <button type="submit" name="cancel_reservation" class="submit-btn">Cancel Reservation</button>
            </form>
        </section>
        </main>
    </div>

    <footer>
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </div>
        <p>&copy; 2025 Modern Eats. All Rights Reserved.</p>
    </footer>

    <script>
        function selectTable(tableDiv) {
            const tables = document.querySelectorAll('.table');
            tables.forEach(table => table.classList.remove('selected'));
            tableDiv.classList.add('selected');
            document.getElementById('tableId').value = tableDiv.dataset.tableId;
        }
    </script>
</body>

</html>
<?php
$conn->close();
?>