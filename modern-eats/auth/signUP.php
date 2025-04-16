


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/booking.css">
  <style>
    input[type="text"], input[type="email"], input[type="password"]{
    width: 100%; /* Ensure both types of input take full width */
}
input[type="email"],input[type="password"] {
  height: 2.3rem;
}

  </style>
 <?php
 include '../includes/bootstrapcdn.php'
 ?>
</head>

<body>

  <header>
   <?php 
   include '../includes/navbar.php'
   ?>
  </header>


  <main class="main-container">
  <section class="form-container">
            <h2>Sign Up</h2>
            <form id="sign-up" class="booking-form" method="post" action="../auth/signUpProcess.php">
                <div class="input-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name">
                </div>
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  placeholder="Enter your email" >
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <p>(at least 8 characters long, with at least one uppercase letter, one lowercase letter, one number, and one special character)</p>
                    <input type="password" id="password" name="password" required placeholder="Enter your password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" >
                </div>
               

               
                
                <button type="submit" class="submit-btn">Sign Up</button>
               
            </form>
             
        </section>
  </main>




</body>

</html>