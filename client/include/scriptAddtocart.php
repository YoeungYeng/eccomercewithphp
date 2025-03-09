<script>
    document.addEventListener("DOMContentLoaded", function () {
        updateCartCount(); // Update cart count on page load

        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function () {
                let productId = this.getAttribute("data-product-id");
                addToCart(productId);
            });
        });
    });

    function addToCart(productId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || {}; // Get existing cart or empty object
        cart[productId] = (cart[productId] || 0) + 1; // Increase quantity
        localStorage.setItem("cart", JSON.stringify(cart)); // Save to localStorage
        updateCartCount(); // Update the cart navbar count
    }

    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem("cart")) || {};
        let totalItems = Object.values(cart).reduce((sum, qty) => sum + qty, 0); // Sum all quantities
        document.getElementById("cart-count").innerText = totalItems;
    }
</script>