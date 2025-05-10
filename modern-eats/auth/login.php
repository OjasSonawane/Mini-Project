<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="../styles/login.css">

    <?php
     include '../includes/bootstrapcdn.php' ;
    ?>
</head>
<body>
    <header>
    <?php 
      include '../includes/navbar.php';
    ?>
    </header>

    <section id="login" class="login-section">
        <div class="login-container">
            <h2>Login</h2>
            <p>Choose your login type:</p>
            <div class="login-type">
                <button class="btn" onclick="toggleLoginType('user')">User Login</button>
                <button class="btn" onclick="toggleLoginType('admin')">Admin Login</button>
            </div>
            
            <div id="user-login" class="login-option" style="display: none;">
                <h3>User Login</h3>
                <form action="userLogin.php" method="POST">
                    <input type="email" placeholder="Email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                    <input type="password" placeholder="Password" name="pass" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                    <p>(at least 8 characters long, with at least one uppercase letter, one lowercase letter, one number, and one special character):</p>
                    <button type="submit" class="btn">Login as User</button>
                </form>
                <h6>If not user sign in <a href="<?= $BASE_URL?>/auth/signUp.php">signIn</a></h6>
            </div>

            <div id="admin-login" class="login-option" style="display: none;">
                <h3>Admin Login</h3>
                <form action="../auth/adminLogin.php" method="POST">
                    <input type="email" placeholder="Email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"  >

                    <input type="password" placeholder="Password" name="pass" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                    <p>(at least 8 characters long, with at least one uppercase letter, one lowercase letter, one number, and one special character):</p>
                    <button type="submit" class="btn">Login as Admin</button>
                </form>
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
    <script>
        function toggleLoginType(type) {
            if (type === 'user') {
                document.getElementById('user-login').style.display = 'block';
                document.getElementById('admin-login').style.display = 'none';
            } else {
                document.getElementById('user-login').style.display = 'none';
                document.getElementById('admin-login').style.display = 'block';
            }
        }
    </script>
   
</body>
</html>


