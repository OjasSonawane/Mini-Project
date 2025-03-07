<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Table</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/booking.css">
  

</head>
<body>
    
    <header>
        <div class="logo">Modern Eats</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="booking.php">Reservation</a></li>
        </ul>
    </header>
    
    <div class="">
    <main class="main-container">
        <section class="form-container">
            <h2>Book a Table</h2>
            <form id="booking-form" class="booking-form" method="post" action="bookTables.php">
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
                    <select id="time" name="time" required></select>
                </div>
                
                <div class="input-group">
                    <label for="people">Number of People:</label>
                    <input type="number" id="people" name="people" required min="1" placeholder="Enter number of people">
                </div>

                <input type="hidden" id="postId" name="postId" value= />
                
                <button type="submit" class="submit-btn">Book Table</button>
            </form>
        </section>
        
        <!-- <section class="table-booking-container">
            
            <h2>Select Your Table</h2>
            <img src="tableLayout.png" alt="tableLayout">
            <div id="table-selection" class="table-selection">
                
                </div>
            </section> -->
        </main>
        
    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <h3>Booking Confirmed!</h3>
            <p>Your table has been successfully booked.</p>
            <div class="modal-actions">
                <button onclick="bookAnother()" class="modal-btn">Book Another</button>
                <button onclick="redirectToHome()" class="modal-btn">Go to Homepage</button>
            </div>
        </div>
    </div>
    
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

        const postIdInput = document.getElementById('postId');
        const form = document.getElementById('booking-form');
// Add event listener for form submission
form.addEventListener('submit', function (e) {
  // Generate a random number (example: 5-digit random number)
  const randomValue = Math.floor(10000 + Math.random() * 90000);
  
  // Set the new random value
  postIdInput.value = randomValue;

  console.log("New Random postId:", postIdInput.value); // Debug log
});

    </script>

</body>
</html>
