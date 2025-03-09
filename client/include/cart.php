<?php
require_once "connection.php";

// header('Content-Type: application/json');



// Get updated cart items
$selectCart = "SELECT name, SUM(quality) as quality, price FROM carts GROUP BY name, price";
$result = mysqli_query($conn, $selectCart);

$total = 0;
?>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
  <div class="offcanvas-header justify-content-center">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="order-md-last">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Your cart</span>
        <span class="badge bg-primary rounded-pill">
          <?= ($result->num_rows > 0) ? $result->num_rows : 0; ?>
        </span>
      </h4>
      <ul class="list-group mb-3" id="cart-items">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $quantity = (int) $row['quality']; // Ensure "quality" is correct
            $price = (float) $row['price'];
            $itemTotal = $quantity * $price;
            $total += $itemTotal;
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
              <div class="d-flex align-items-center">
                <h6 style="width: 150px"> <?= htmlspecialchars($row['name']) ?></h6>

                <!-- Decrease Button (-) -->
                <button type="button" class="btn btn-sm btn-danger decrease"
                  data-name="<?= htmlspecialchars($row['name']); ?>"
                  style="width: 40px; padding: 12px 14px; height: 40px; display: flex; justify-content: center; align-items: center; border-radius: 5px 7px;">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                      d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                  </svg>
                </button>

                <h6 class="my-0 mx-2">(x<?= $quantity ?>)</h6>

                <!-- Increase Button (+) -->
                <button type="button" class="btn btn-sm btn-primary increase"
                  data-name="<?= htmlspecialchars($row['name']); ?>"
                  style="width: 40px; padding: 12px 14px; height: 40px; display: flex; justify-content: center; align-items: center; border-radius: 5px 7px;">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                      d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                  </svg>
                </button>
              </div>
              <span class="text-body-secondary item-total">$<?= number_format($itemTotal, 2) ?></span>
            </li>
            <?php
          }
        } else {
          echo '<li class="list-group-item">Your cart is empty.</li>';
        }
        ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong id="total-price">$<?= number_format($total, 2) ?></strong>
        </li>
      </ul>

      <a href="index.php?p=checkout">
        <button class="w-100 btn btn-primary btn-lg" type="button">Continue to Checkout</button>
      </a>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
  $(document).ready(function () {
    // Increase Quantity
    $(".increase").click(function () {
      let itemName = $(this).attr("data-name");

      $.ajax({
        url: "include/carts.php",
        type: "POST",
        data: { action: "increase", name: itemName },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            updateCartUI(response.cart);
          } else {
            alert("Error updating cart.");
          }
        },
        error: function (xhr, status, error) {
          console.log("Error:", error);
        }
      });
    });

    // Decrease Quantity
    $(".decrease").click(function () {
      let itemName = $(this).attr("data-name");

      $.ajax({
        url: "include/carts.php",
        type: "POST",
        data: { action: "decrease", name: itemName },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            updateCartUI(response.cart);
          } else {
            alert("Error updating cart.");
          }
        },
        error: function (xhr, status, error) {
          console.log("Error:", error);
        }
      });
    });

    // Function to Update Cart UI
    function fetchCart() {
      $.ajax({
        url: "cart.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
          if (response.success) {
            updateCartUI(response.cart);
          } else {
            $("#cart-items").html('<li class="list-group-item">Your cart is empty.</li>');
            $("#total-price").text("$0.00");
          }
        },
        error: function (xhr, status, error) {
          console.log("Error fetching cart:", error);
        }
      });
    }

    // Update Cart UI
    function updateCartUI(cart) {
      let cartHTML = "";
      let total = 0;

      if (cart.length > 0) {
        cart.forEach(item => {
          let itemTotal = item.quantity * item.price;
          total += itemTotal;

          cartHTML += `
                    <li class="list-group-item d-flex justify-content-between align-items-center lh-sm">
                        <div class="d-flex align-items-center">
                            <h6 style="width: 150px">${item.name}</h6>
                            
                            <button type="button" class="btn btn-sm btn-danger decrease" data-name="${item.name}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32 32l352 0c17.7 0 32 14.3 32 32z"/>
                                </svg>
                            </button>

                            <h6 class="my-0 mx-2">(x${item.quantity})</h6>

                            <button type="button" class="btn btn-sm btn-primary increase" data-name="${item.name}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                                </svg>
                            </button>
                        </div>
                        <span class="text-body-secondary item-total">$${itemTotal.toFixed(2)}</span>
                    </li>
                `;
        });
      } else {
        cartHTML = '<li class="list-group-item">Your cart is empty.</li>';
      }

      $("#cart-items").html(cartHTML);
      $("#total-price").text(`$${total.toFixed(2)}`);
    }

    // Fetch cart items on page load
    fetchCart();

  });

</script>