<?php
require_once "include/connection.php";
require_once "include/head.php";
require_once "include/navbar.php";
require "include/cart.php";

$select_id = "SELECT *FROM carts";
?>

<div class="container mt-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <?php
                $selectCart = "SELECT name, id, SUM(quality) as quality, price FROM carts GROUP BY name, price";
                $result = mysqli_query($conn, $selectCart);
                $total = 0;
                $cartItems = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $quantity = (int) $row['quality'];
                        $price = (float) $row['price'];
                        $itemTotal = $quantity * $price;
                        $total += $itemTotal;

                        // Store cart item for JSON response
                        $cartItems[] = [
                            "name" => htmlspecialchars($row['name']),
                            "price" => $price,
                            "quantity" => $quantity
                        ];
                        ?>
                        <tr>
                            <td> <?= htmlspecialchars($row['name']) ?> </td>
                            <td> <?= number_format($price, 2) ?> </td>
                            <td>(x<?= $quantity ?>)</td>
                            <td> $<?= number_format($itemTotal, 2) ?></td>
                            <td>
                                <a href="action/delect_cart.php?id=<?php echo $row['id']; ?>">
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between">
        <button id="checkout-btn" class="btn btn-primary">Proceed to Checkout</button>
    </div>
</div>

<script>
    document.getElementById("checkout-btn").addEventListener("click", function () {
        let cartData = <?= json_encode($cartItems) ?>; // Convert PHP array to JSON

        fetch("checkout.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ cart: cartData }) // Send cart data as JSON
        })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url; // Redirect to ABA Payway
                } else {
                    alert("Payment Error: " + data.error);
                }
            })
            .catch(error => console.error("Error:", error));
    });
</script>

<?= require_once "include/footer.php"; ?>
<?php require_once "include/foot.php"; ?>

