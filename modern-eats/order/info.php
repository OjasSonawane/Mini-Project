<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Details - Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/info.css">
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

    <section id="add-details" class="add-details-section">
        <div class="add-details-container">
            <h1>Add Details</h1>
            <p>Please provide your details for a seamless delivery experience.</p>
            
            <form action="order.php" method="get">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <div style="display: flex; align-items: center;">
                        <select id="country-code" name="country-code" style="padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; font-family: 'Poppins', sans-serif; margin-right: 1rem;">
                            <option value="+91" selected>+91</option>
                            <option value="+1">+1</option>
                        </select>
                        <input type="tel" id="contact" name="contact" placeholder="Enter your contact number" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; font-family: 'Poppins', sans-serif;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <textarea id="address" name="address" placeholder="Enter your full address" required></textarea>
                    <div id="locationSuggestion" class="location-suggestion" style="display: none;">
                        <span>We found your location: </span>
                        <span id="suggestedAddress"></span>
                        <button type="button" id="useSuggestedAddress">Use this address</button>
                    </div>
                </div>

                <button type="submit" class="submit-button">Submit Details</button></a>
            </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const addressField = document.getElementById('address');
            const locationSuggestion = document.getElementById('locationSuggestion');
            const suggestedAddress = document.getElementById('suggestedAddress');
            const useSuggestedAddressBtn = document.getElementById('useSuggestedAddress');
            
            // Check for stored address when page loads
            const storedAddress = sessionStorage.getItem('deliveryAddress');
            
            if (storedAddress && addressField) {
                // Show the suggestion
                suggestedAddress.textContent = storedAddress;
                locationSuggestion.style.display = 'flex';
                
                // Clear the stored address from sessionStorage
                sessionStorage.removeItem('deliveryAddress');
            }
            
            // Handle click on "Use this address" button
            useSuggestedAddressBtn.addEventListener('click', function() {
                if (addressField) {
                    addressField.value = suggestedAddress.textContent;
                    locationSuggestion.style.display = 'none';
                }
            });
            
            // You can also check URL parameters if needed
            const urlParams = new URLSearchParams(window.location.search);
            const addressParam = urlParams.get('address');
            if (addressParam && addressField) {
                addressField.value = decodeURIComponent(addressParam);
            }
        });
    </script>
</body>
</html>