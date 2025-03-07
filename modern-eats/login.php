<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <header>
    <a href="index.php" class="logo"><div >Modern Eats</div></a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#offers">Offers</a></li>
            <li><a href="php.html">Menu</a></li>
        </ul>
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
                <form action="user-dashboard.html" method="POST">
                    <input type="email" placeholder="Email" required>
                    <input type="password" placeholder="Password" required>
                    <button type="submit" class="btn">Login as User</button>
                </form>
            </div>

            <div id="admin-login" class="login-option" style="display: none;">
                <h3>Admin Login</h3>
                <form action="admin-dashboard.html" method="POST">
                    <input type="email" placeholder="Email" required>
                    <input type="password" placeholder="Password" required>
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

   
</body>
</html>
