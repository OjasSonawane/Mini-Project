<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/payment.css">
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

    <section id="payment" class="payment-section">
        <div class="payment-container">
            <h1>Complete Your Order</h1>
            <p>Please select a payment method to complete your order at Modern Eats!</p>
            
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div id="payment-items"></div>
                <div id="payment-total" style="font-weight: bold; font-size: 1.2rem; margin-top: 1rem;"></div>
            </div>

            <form id="payment-form">
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="upi" checked>
                        <i class="fas fa-mobile-alt"></i> UPI (Google Pay, PhonePe, Paytm)
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="wallet">
                        <i class="fas fa-wallet"></i> Wallets (Paytm, MobiKwik)
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="cod">
                        <i class="fas fa-cash-register"></i> Cash on Delivery
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment-method" value="credit-card" id="credit-card-radio">
                        <i class="fas fa-credit-card"></i> Credit/Debit Card
                    </label>
                </div>

                <div id="card-details-form" style="display: none; margin-top: 20px;">
                    <div class="input-field">
                        <label for="cardholder-name">Cardholder Name:</label>
                        <input type="text" id="cardholder-name" name="cardholder-name" placeholder="Enter cardholder name" required>
                    </div>
                    <div class="input-field">
                        <label for="card-number">Card Number:</label>
                        <input type="text" id="card-number" name="card-number" placeholder="Enter your card number" required>
                    </div>
                    <div class="input-field">
                        <label for="expiration-date">Expiration Date:</label>
                        <input type="month" id="expiration-date" name="expiration-date" required>
                    </div>
                    <div class="input-field">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required maxlength="3">
                    </div>
                    <div id="card-terms-checkbox" style="text-align: left; margin-bottom: 1.5rem;">
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" name="card-terms" value="agree" required style="margin-right: 8px;">
                            I agree to the terms and conditions.
                        </label>
                    </div>
                </div>

                <button type="button" id="pay-now-btn" class="btn">Pay Now</button>
            </form>
        </div>
    </section>

    <!-- Payment Processing Modal -->
    <div class="payment-modal" id="payment-modal">
        <div class="payment-modal-content">
            <div class="payment-loader">
                <div class="payment-loader-circle"></div>
                <div class="payment-loader-circle"></div>
                <div class="payment-loader-icon">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <div class="success-checkmark" id="success-checkmark">
                <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                </div>
            </div>
            <div class="payment-status" id="payment-status">Processing Payment...</div>
            <div class="progress-bar">
                <div class="progress" id="payment-progress"></div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
        <p>&copy; 2025 Modern Eats. All Rights Reserved.</p>
    </footer>

    <div class="chatbot-icon">
        <i class="fas fa-comments"></i>
    </div>

    <script>
        // DOM Elements
        const creditCardRadio = document.getElementById("credit-card-radio");
        const cardDetailsForm = document.getElementById("card-details-form");
        const payNowBtn = document.getElementById("pay-now-btn");
        const paymentModal = document.getElementById("payment-modal");
        const paymentStatus = document.getElementById("payment-status");
        const paymentProgress = document.getElementById("payment-progress");
        const paymentForm = document.getElementById("payment-form");
        const successCheckmark = document.getElementById("success-checkmark");
        const paymentLoader = document.querySelector('.payment-loader');
        const paymentLoaderIcon = document.querySelector('.payment-loader-icon');

        // Toggle card details form based on payment method selection
        creditCardRadio.addEventListener('change', function () {
            if (creditCardRadio.checked) {
                cardDetailsForm.style.display = 'block';
            } else {
                cardDetailsForm.style.display = 'none';
            }
        });

        // Load cart data on page load
        window.onload = function () {
            const cartData = JSON.parse(localStorage.getItem('cartData')) || [];
            const paymentTotal = document.getElementById('payment-total');
            const paymentItems = document.getElementById('payment-items');

            if (cartData.length > 0) {
                const total = cartData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                paymentTotal.textContent = "Total: ₹" + total.toFixed(2);
                paymentItems.innerHTML = cartData.map(item => `
                    <div style="margin-bottom: 8px;">${item.name} - ₹${item.price.toFixed(2)} x ${item.quantity} = ₹${(item.price * item.quantity).toFixed(2)}</div>
                `).join("");
            } else {
                paymentItems.innerHTML = "<div>No items in cart</div>";
                paymentTotal.textContent = "Total: ₹0.00";
                payNowBtn.disabled = true;
                payNowBtn.style.opacity = "0.7";
                payNowBtn.style.cursor = "not-allowed";
            }
        };

        // Handle payment button click
        payNowBtn.addEventListener('click', function() {
            // Validate form if credit card is selected
            if (creditCardRadio.checked) {
                const cardholderName = document.getElementById('cardholder-name').value;
                const cardNumber = document.getElementById('card-number').value;
                const expirationDate = document.getElementById('expiration-date').value;
                const cvv = document.getElementById('cvv').value;
                const termsChecked = document.querySelector('input[name="card-terms"]:checked');
                
                if (!cardholderName || !cardNumber || !expirationDate || !cvv || !termsChecked) {
                    alert('Please fill all card details and agree to terms');
                    return;
                }
                
                // Simple card number validation
                if (!/^\d{16}$/.test(cardNumber.replace(/\s/g, ''))) {
                    alert('Please enter a valid 16-digit card number');
                    return;
                }
                
                // Simple CVV validation
                if (!/^\d{3}$/.test(cvv)) {
                    alert('Please enter a valid 3-digit CVV');
                    return;
                }
            }
            
            // Show payment processing modal
            paymentModal.style.display = 'flex';
            
            // Reset progress and status
            paymentProgress.style.width = '0%';
            paymentStatus.textContent = "Processing Payment...";
            successCheckmark.style.display = 'none';
            paymentLoader.style.display = 'block';
            paymentLoaderIcon.innerHTML = '<i class="fas fa-lock"></i>';
            
            // Simulate payment processing
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.floor(Math.random() * 10) + 5; // Random increment between 5-15
                if (progress > 100) progress = 100;
                paymentProgress.style.width = `${progress}%`;
                
                // Update status messages at different progress points
                if (progress === 10) {
                    paymentStatus.textContent = "Connecting to payment gateway...";
                } else if (progress === 30) {
                    paymentStatus.textContent = "Verifying payment details...";
                } else if (progress === 60) {
                    paymentStatus.textContent = "Processing payment...";
                } else if (progress === 85) {
                    paymentStatus.textContent = "Finalizing transaction...";
                } else if (progress >= 100) {
                    clearInterval(interval);
                    paymentStatus.textContent = "Payment Successful!";
                    
                    // Hide loader and show success checkmark
                    paymentLoader.style.display = 'none';
                    successCheckmark.style.display = 'block';
                    
                    // Redirect after a delay
                    setTimeout(() => {
                        // Clear cart
                        localStorage.removeItem('cartData');
                        // Redirect to success page
                        window.location.href = 'http://localhost/modern-eats/order/success.php';
                    }, 2000);
                }
            }, 300);
        });

        // Format card number input
        document.getElementById('card-number').addEventListener('input', function(e) {
            // Remove all non-digit characters
            let value = e.target.value.replace(/\D/g, '');
            // Add space after every 4 digits
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            e.target.value = value;
        });

        // Format CVV input to only allow numbers
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>

</html>