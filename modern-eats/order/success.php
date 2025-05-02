<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Modern Eats</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="../styles/success.css">
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

    <div class="success-container" id="successContainer">
        <h1 id="message">Completing your payment...</h1>
        <p id="status">Your payment is being processed. Please wait...</p>
        <div class="redirect">
        </div>
    </div>

    <!-- Add these new elements for the popup -->
    <div class="overlay" id="overlay"></div>
    <div class="location-popup" id="locationPopup">
        <h2>Enable Location Services</h2>
        <p>To provide accurate delivery tracking, please allow Modern Eats to access your location.</p>
        <p>Your location data will only be used for delivery purposes.</p>
        <div class="location-buttons">
            <button class="location-btn allow-btn" id="allowLocation">Allow</button>
            <button class="location-btn deny-btn" id="denyLocation">Deny</button>
        </div>
    </div>

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
        function updateMessage(message, status) {
            document.getElementById('message').innerText = message;
            document.getElementById('status').innerText = status;
        }

        // Show location popup after payment success
        function showLocationPopup() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('locationPopup').style.display = 'block';
        }

        // Handle location permission
        function handleLocationPermission(allowed) {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('locationPopup').style.display = 'none';
            
            if (allowed) {
                updateMessage('Getting your location...', 'Please wait while we determine your position.');
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            // Successfully got location
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            
                            updateMessage('Location acquired!', 'Thank you for allowing location access.');
                            
                            // Get address from coordinates
                            getAddressFromCoordinates(lat, lng);
                        },
                        function(error) {
                            // Error getting location
                            console.error("Error getting location:", error);
                            updateMessage('Location Error', 'Could not determine your location automatically.');
                            setTimeout(() => {
                                window.location.href = "info.php";
                            }, 2000);
                        }
                    );
                } else {
                    updateMessage('Browser Not Supported', 'Your browser does not support geolocation.');
                    setTimeout(() => {
                        window.location.href = "info.html";
                    }, 2000);
                }
            } else {
                updateMessage('Location Denied', 'You can manually enter your address on the next page.');
                setTimeout(() => {
                    window.location.href = "info.html";
                }, 2000);
            }
        }

        // Get address from coordinates using OpenStreetMap Nominatim API
        function getAddressFromCoordinates(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    let address = '';
                    if (data.address) {
                        // Construct address from components
                        const addr = data.address;
                        address = [
                            addr.road, 
                            addr.neighbourhood, 
                            addr.suburb, 
                            addr.city, 
                            addr.state, 
                            addr.postcode, 
                            addr.country
                        ].filter(Boolean).join(', ');
                    } else {
                        address = data.display_name || 'Address not available';
                    }
                    
                    // Store address in sessionStorage
                    sessionStorage.setItem('deliveryAddress', address);
                    
                    // Send to server if needed
                    sendLocationToServer(lat, lng, address);
                    
                    // Redirect to next page
                    setTimeout(() => {
                        window.location.href = "info.html";
                    }, 1500);
                })
                .catch(error => {
                    console.error("Error getting address:", error);
                    updateMessage('Address Error', 'Could not determine your address automatically.');
                    setTimeout(() => {
                        window.location.href = "info.html";
                    }, 2000);
                });
        }

        // Send location data to server
        function sendLocationToServer(latitude, longitude, address = '') {
            const formData = new FormData();
            formData.append('latitude', latitude);
            formData.append('longitude', longitude);
            formData.append('address', address);
            
            fetch('save_location.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => console.log('Location saved:', data))
            .catch(error => console.error('Error saving location:', error));
        }

        // Event listeners for buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('allowLocation').addEventListener('click', function() {
                handleLocationPermission(true);
            });

            document.getElementById('denyLocation').addEventListener('click', function() {
                handleLocationPermission(false);
            });

            // Payment success flow
            setTimeout(function() {
                updateMessage('Payment Successful!', 'Your payment has been successfully processed.');
                
                // Show location popup after another delay
                setTimeout(showLocationPopup, 1500);
            }, 2000);
        });
    </script>
</body>
</html>