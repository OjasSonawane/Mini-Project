<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Modern Eats</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../styles/menu.css">
    <?php
       include '../includes/bootstrapcdn.php';
     ?>
</head>
<body>
    <header>
     <?php
       include '../includes/navbar.php';
     ?>

        <div class="cart-icon" onclick="toggleCart()">
            <i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span>
        </div>

        <div class="cart-dropdown" id="cart-dropdown">
            <div class="cart-items" id="cart-items"></div>
            <div class="cart-total">
                Total: ₹<span id="cart-total">0</span>
            </div>
            <div class="cart-actions">
                <button onclick="proceedToPayment()">Proceed to Payment</button>
            </div>
        </div>
    </header>

    <section class="menu">
        <h2>Our Delicious Menu</h2>
        <h2>Explore our range of mouth-watering dishes. Perfect for any occasion!</h2>

        <div class="menu-category">
            <h2>Indian</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1603894584373-5ac82b2ae398" alt="Butter Chicken">
                    <h3>Butter Chicken</h3>
                    <p>A rich and creamy curry with tender chicken pieces.</p>
                    <span>₹700</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1631452180519-c014fe946bc7?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Paneer Tikka">
                    <h3>Paneer Tikka</h3>
                    <p>Grilled marinated cottage cheese served with mint chutney.</p>
                    <span>₹350</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a" alt="Biryani">
                    <h3>Chicken Biryani</h3>
                    <p>Fragrant rice dish cooked with chicken, spices, and saffron.</p>
                    <span>₹600</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1580064003296-29deb3521370?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Aloo Paratha">
                    <h3>Aloo Paratha</h3>
                    <p>Flatbread stuffed with spiced mashed potatoes.</p>
                    <span>₹180</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://plus.unsplash.com/premium_photo-1695297516676-04a259917c03?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Samosa">
                    <h3>Samosa</h3>
                    <p>Crispy pastry filled with spiced potatoes and peas.</p>
                    <span>₹120</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <h2>Italian</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1574071318508-1cdbab80d002" alt="Classic Margherita">
                    <h3>Classic Margherita</h3>
                    <p>A classic pizza with mozzarella cheese, fresh tomatoes, and basil.</p>
                    <span>₹999</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1574894709920-11b28e7367e3" alt="Lasagna">
                    <h3>Lasagna</h3>
                    <p>Layered pasta with cheese, meat sauce, and béchamel.</p>
                    <span>₹850</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1588013273468-315fd88ea34c" alt="Spaghetti Carbonara">
                    <h3>Spaghetti Carbonara</h3>
                    <p>A classic Italian pasta with eggs, cheese, pancetta, and pepper.</p>
                    <span>₹1100</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1693609929945-b01ae4f2d602?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Fettuccine Alfredo">
                    <h3>Fettuccine Alfredo</h3>
                    <p>Creamy pasta with fettuccine noodles and parmesan cheese.</p>
                    <span>₹950</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1628885363743-fbf9c98d4196?q=80&w=3135&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Ravioli">
                    <h3>Ravioli</h3>
                    <p>Italian dumplings filled with ricotta cheese and spinach.</p>
                    <span>₹899</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <h2>Mexican</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1565299585323-38d6b0865b47" alt="Tacos">
                    <h3>Beef Tacos</h3>
                    <p>Soft tortillas filled with seasoned beef and fresh toppings.</p>
                    <span>₹450</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1570461226513-e08b58a52c53?q=80&w=2948&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Burritos">
                    <h3>Chicken Burrito</h3>
                    <p>Wrapped tortilla with grilled chicken, rice, beans, and salsa.</p>
                    <span>₹550</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1628838233717-be047a0b54fb?q=80&w=2956&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Quesadilla">
                    <h3>Cheese Quesadilla</h3>
                    <p>Grilled tortilla filled with melted cheese and served with salsa.</p>
                    <span>₹450</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://plus.unsplash.com/premium_photo-1713687789756-b38c7870eef6?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Churros">
                    <h3>Churros</h3>
                    <p>Crispy fried dough pastry dusted with cinnamon sugar.</p>
                    <span>₹250</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://plus.unsplash.com/premium_photo-1681406994499-737a170e9c43?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Enchiladas">
                    <h3>Chicken Enchiladas</h3>
                    <p>Corn tortillas rolled up and filled with spiced chicken, covered in sauce.</p>
                    <span>₹700</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>
        </div>

        <div class="menu-category">
            <h2>Chinese</h2>
            <div class="menu-items">
                <div class="menu-item">
                    <img src="https://plus.unsplash.com/premium_photo-1695756121533-3f60bee7ba7b?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Spring Rolls">
                    <h3>Spring Rolls</h3>
                    <p>Crispy rolls filled with mixed vegetables.</p>
                    <span>₹250</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a" alt="Fried Rice">
                    <h3>Fried Rice</h3>
                    <p>Stir-fried rice with vegetables and soy sauce.</p>
                    <span>₹400</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=3125&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Chow Mein">
                    <h3>Chow Mein</h3>
                    <p>Stir-fried noodles with vegetables and your choice of meat.</p>
                    <span>₹350</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://images.unsplash.com/photo-1541095441899-5d96a6da10b8?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sweet and Sour Chicken">
                    <h3>Sweet and Sour Chicken</h3>
                    <p>Chicken in a tangy sauce with bell peppers and pineapple.</p>
                    <span>₹550</span>
                    <button class="add-to-cart">Add to Cart</button>
                </div>
                <div class="menu-item">
                    <img src="https://plus.unsplash.com/premium_photo-1674601031608-1a38ca161523?q=80&w=2330&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Dim Sum">
                    <h3>Dim Sum</h3>
                    <p>Steamed dumplings filled with pork and vegetables.</p>
                    <span>₹300</span>
                    <button class="add-to-cart">Add to Cart</button>
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

    

    <script>
     let cart = [];
const cartCount = document.getElementById("cart-count");
const cartTotal = document.getElementById("cart-total");
const cartItems = document.getElementById("cart-items");
const cartDropdown = document.getElementById("cart-dropdown");

function toggleCart() {
    cartDropdown.style.display = cartDropdown.style.display === "block" ? "none" : "block";
}

function addToCart(itemName, itemPrice) {
    const existingItem = cart.find(item => item.name === itemName);
    if (existingItem) {
        existingItem.quantity += 1; 
    } else {
        cart.push({ name: itemName, price: itemPrice, quantity: 1 }); 
    }
    updateCart();
}

function removeFromCart(itemName) {
    cart = cart.filter(item => item.name !== itemName); 
    updateCart();
}

function updateQuantity(itemName, newQuantity) {
    const item = cart.find(item => item.name === itemName);
    if (item && newQuantity > 0) {
        item.quantity = newQuantity;
        updateCart();
    }
}

function updateCart() {
    cartCount.textContent = cart.length;
    cartTotal.textContent = "₹" + cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartItems.innerHTML = cart.map(item => `
        <div>
            ${item.name} - ₹${item.price} x 
            <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity('${item.name}', this.value)">
            = ₹${item.price * item.quantity}
            <button onclick="removeFromCart('${item.name}')">Remove</button>
        </div>
    `).join("");
}

function proceedToPayment() {
    localStorage.setItem('cartData', JSON.stringify(cart));
    window.location.href = 'http://localhost/modern-eats/order/payment.php';
}

document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", function () {
        const menuItem = this.closest(".menu-item");
        const itemName = menuItem.querySelector("h3").textContent;
        const itemPrice = parseInt(menuItem.querySelector("span").textContent.replace('₹', ''));
        addToCart(itemName, itemPrice);
    });
});

    </script>
</body>
</html>
