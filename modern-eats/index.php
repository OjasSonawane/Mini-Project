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

    <div class="chatbot-icon" onclick="toggleChatbot()">
        <i class="fas fa-comments"></i>
    </div>

    <div class="chatbot-container" id="chatbotContainer">
        <div class="chatbot-header">
            <h2>AharBot Your Personal Chatbot Assistant</h2>
            <span class="close-btn" onclick="toggleChatbot()">×</span>
        </div>
        <div class="chatbot-body" id="chatDisplay">
            <div class="chat-message bot">
                Hello! Aharabot I'm your restaurant assistant. How can I help you today?
            </div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chatInput" placeholder="Type your message..." />
            <button id="sendButton">Send</button>
        </div>
    </div>

    <script>
        function logout() {
            fetch("logout.php")
                .then(() => window.location.href = "http://localhost/modern-eats/auth/login.php"); // Redirect after logging out
        }

        const GEMINI_API_KEY = 'AIzaSyAEcGa5Jkmv8lEzhVGgtn4aUXOYa9d9QW4';


        function toggleChatbot() {
            const chatbotContainer = document.getElementById('chatbotContainer');
            chatbotContainer.classList.toggle('active');
        }

        async function sendMessage() {
            const chatInput = document.getElementById('chatInput');
            const chatDisplay = document.getElementById('chatDisplay');

            if (chatInput.value.trim() !== '') {

                const userMessage = document.createElement('div');
                userMessage.className = 'chat-message user';
                userMessage.textContent = chatInput.value;
                chatDisplay.appendChild(userMessage);

                const userQuery = chatInput.value;
                chatInput.value = '';

                try {
                    const response = await fetch(
                        `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${GEMINI_API_KEY}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                contents: [{
                                    parts: [{
                                        text: `
You are **Aharbot**, a helpful chatbot assistant for the restaurant "Modern Eats". You ONLY answer questions about this restaurant in hospitable voice Always. reply using basic HTML formatting. For example:
- Use <br> for line breaks
- Use <b> for bold
- Use <ul><li> for lists
Do NOT include <html>, <body>, or <head> tags., such as:

- Menu
- Location
- Hours
- Payments
- Reservations
- Services

Restaurant Info:
- Location: Pune, Maharashtra
- Open: 10 AM – 10 PM
- Cuisine: Indian,Italian,Mexican,Chinese
- Accepts: UPI, Cash, Card
- Menu includes: Butter Chicken(700 Rs),Paneer Tikka(350 Rs), Chicken Biryani(600 Rs),Aloo paratha (180 Rs), Samosa (120 Rs),Classic Margherita, Lasagna, Spaghetti Carbonara, Fettuccine Alfredo, Ravioli, Beef Tacos, Chicken Burrito, Cheese Quesadilla, Churros, Chicken Enchiladas, Spring Rolls, Fried Rice, Chow Mein, Sweet and Sour Chicken, Dim Sum


If someone asks something not related to the restaurant, politely reply:
> "I'm Aharabot, your restaurant assistant. I can only help with questions about Spice Garden."

User's question: ${userQuery}
                    `
                                    }]
                                }]
                            })

                        }
                    );

                    const data = await response.json();
                    const botReply = data.candidates[0].content.parts[0].text;

                    const botMessage = document.createElement('div');
                    botMessage.className = 'chat-message bot';
                    botMessage.innerHTML = botReply;
                    chatDisplay.appendChild(botMessage);
                } catch (error) {
                    console.error('Error:', error);
                    const botMessage = document.createElement('div');
                    botMessage.className = 'chat-message bot';
                    botMessage.textContent = 'Sorry, something went wrong. Please try again later.';
                    chatDisplay.appendChild(botMessage);
                }

                chatDisplay.scrollTop = chatDisplay.scrollHeight;
            }
        }

        document.getElementById('sendButton').addEventListener('click', sendMessage);

        document.getElementById('chatInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>

</html>