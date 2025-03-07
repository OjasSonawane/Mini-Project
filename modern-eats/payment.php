<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Modern Eats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/payment.css">
</head>

<body>
    <div class="background-image"></div>
    <header>
    <a href="index.php" class="logo"><div >Modern Eats</div></a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#offers">Offers</a></li>
            <li><a href="menu.php">Menu</a></li>
        </ul>
    </header>

    <section id="payment" class="payment-section">
        <div class="payment-container">
            <h1>Complete Your Order</h1>
            <p>Please select a payment method to complete your order at Modern Eats!</p>
            
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div id="payment-items"></div>
                <div id="payment-total"></div>
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

                <div id="card-details-form" style="display: none; margin-top: 10px;">
                    <div class="input-field">
                        <label for="card-number">Card Number:</label>
                        <input type="text" id="card-number" name="card-number" placeholder="Enter your card number" required
                            pattern="\d{16}" aria-label="Card Number" aria-required="true">
                    </div>
                    <div class="input-field">
                        <label for="expiration-date">Expiration Date:</label>
                        <input type="month" id="expiration-date" name="expiration-date" required aria-label="Expiration Date"
                            aria-required="true">
                    </div>
                    <div class="input-field">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required pattern="\d{3}"
                            aria-label="CVV" aria-required="true">
                    </div>
                    <div id="card-terms-checkbox">
                        <label>
                            <input type="checkbox" name="card-terms" value="agree" required aria-required="true">
                            I agree to the terms and conditions.
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn">Pay Now</button>
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
        const creditCardRadio = document.getElementById("credit-card-radio");
        const cardDetailsForm = document.getElementById("card-details-form");

        creditCardRadio.addEventListener('change', function () {
            if (creditCardRadio.checked) {
                cardDetailsForm.style.display = 'block';
            } else {
                cardDetailsForm.style.display = 'none';
            }
        });

        window.onload = function() {
            const cartData = JSON.parse(localStorage.getItem('cartData'));
            const paymentTotal = document.getElementById('payment-total');
            const paymentItems = document.getElementById('payment-items');

            if (cartData) {
                paymentTotal.textContent = "₹" + cartData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                paymentItems.innerHTML = cartData.map(item => `
                    <div>${item.name} - ₹${item.price} x ${item.quantity} = ₹${item.price * item.quantity}</div>
                `).join("");
            }
        };
    </script>
</body>

</html>
