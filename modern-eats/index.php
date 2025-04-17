
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/index.css">
    <?php
       include './includes/bootstrapcdn.php';
    ?>
    <style>
        button {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            color: inherit;
            outline: none;
            box-shadow: none;
            appearance: none;
            cursor: pointer;
        }
    </style>
</head>


<body>
   
        <!-- <a href="index.php" class="logo">
            <div>Modern Eats</div>
        </a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="signUp.php">Sign Up</a></li>
            <li><button type="button" onclick="logout()">Log Out</button></li>
            <li><a href="login.php">👤</a></li>
        </ul> -->
       <header>

           <?php 
        include "./includes/navbar.php";
        ?>
        </header>
    

    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Welcome to Modern Eats</h1>
            <p>Experience the finest dining in town</p>
            <a href="<?= $BASE_URL ?>/reservation/booking.php" class="btn">Book a Table</a>
            <br>
            <a href="<?= $BASE_URL ?>/order/menu.php" class="btn">Order</a>
            
        </div>
    </section>

    <section id="about" class="about">
        <div class="about-content">
            <h2>About Modern Eats</h2>
            <div class="about-grid">
                <div class="about-item">
                    <i class="fas fa-utensils"></i>
                    <h3>Exquisite Cuisine</h3>
                    <p>Our menu is crafted with the finest ingredients, offering a blend of traditional and modern flavors.</p>
                </div>
                <div class="about-item">
                    <i class="fas fa-glass-cheers"></i>
                    <h3>Elegant Ambiance</h3>
                    <p>Enjoy a sophisticated dining experience in our beautifully designed restaurant.</p>
                </div>
                <div class="about-item">
                    <i class="fas fa-heart"></i>
                    <h3>Exceptional Service</h3>
                    <p>Our dedicated staff ensures every guest feels special and well taken care of.</p>
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
       function logout() {
    fetch("logout.php")
        .then(() => window.location.href = "http://localhost/modern-eats/auth/login.php"); // Redirect after logging out
}

    </script>
</body>

</html>