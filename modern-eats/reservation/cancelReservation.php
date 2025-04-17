

<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: http://localhost/modern-eats/auth/login.php");
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Table</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/booking.css">
  
    <?php
     include '../includes/bootstrapcdn.php' ;
    ?>

</head>
<body>
    
    <header>
    <?php
    include '../includes/navbar.php';
    if(!isset($_SESSION['user_id'])){
        header("Location: http://localhost/modern-eats/auth/login.php");
        }
    ?>
    </header>
    
    <div class="">
    <main class="main-container">
        <section class="form-container">
            <h2>Cancel Reservation</h2>
            <form id="booking-form" class="booking-form" method="post" action="./cancelReservationScript.php">
                <div class="input-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name"  required value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                </div>
                
                <div class="input-group">
                    <label for="id">Reservation id</label>
                    <input type="number" id="id" name="userId" required   placeholder="Enter your reservation id">
                </div>

                <div class="input-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="reservation_date" required>
                </div>
                
                <div class="input-group">
                    <label for="time">Time:</label>
                    <select id="time" name="reservation_time" required></select>
                </div>
                
                <button type="submit" class="submit-btn" onclick="return cancelReservation()">Cancel Reservation</button>
            </form>
        </section>
        
       
        </main>
        
   
    
</div>
    
    <script>
       document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').setAttribute('min', today);

            const timeSelect = document.getElementById('time');
            const startTime = 12; 
            const endTime = 23; 

            for (let hour = startTime; hour <= endTime; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const time = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                }
            }

           
        });
      function confirmCancel() {
  return confirm("Are you sure you want to cancel your reservation?");
}

    </script>

</body>
</html>
