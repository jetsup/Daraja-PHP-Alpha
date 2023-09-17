<?php
session_start();
include 'database/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack Daniels - Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include 'components/navbar.php';

    echo "<h2>Cart</h2>";
    // check if the user has products in the cart
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM cart_items WHERE user_id = $user_id";
    $result = $con->query($sql);
    $checkItems = 0;
    if ($result->num_rows > 0) {
        // the user has products in the cart
        while ($row = $result->fetch_assoc()) {
            $productID = $row["product_id"];
            $sql = "SELECT * FROM products WHERE product_id = $productID";
            $product = $con->query($sql)->fetch_assoc();
            $productName = $product["product_name"];
            $productPrice = $product["product_price"];
            $productDescription = $product["product_description"];
            $productImageURL = $product["product_image_url"];
            include "components/display/cart_item.php";
        }
        echo "<p>Total: $<span id='total-price'>0.00</span></p>";
        echo "<button onclick='checkout()'>Checkout ($checkItems)</button>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

    <?php
    include 'components/footer.php';
    ?>
</body>
<script src="index.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const decrementButtons = document.querySelectorAll(".decrement-button");
        const incrementButtons = document.querySelectorAll(".increment-button");
        const quantityElements = document.querySelectorAll(".quantity");
        const totalElements = document.querySelectorAll(".total");
        const price = 10.00; // Change the price as needed

        // Function to update the total price and quantity
        function updateTotalPriceAndQuantity(index) {
            const quantity = parseInt(quantityElements[index].textContent);
            const total = (quantity * price).toFixed(2);
            totalElements[index].textContent = total;
        }

        // Add click event listeners to decrement buttons
        decrementButtons.forEach((button, index) => {
            button.addEventListener("click", function () {
                const quantity = parseInt(quantityElements[index].textContent);
                if (quantity > 1) {
                    quantityElements[index].textContent = quantity - 1;
                    updateTotalPriceAndQuantity(index);
                }
            });
        });

        // Add click event listeners to increment buttons
        incrementButtons.forEach((button, index) => {
            button.addEventListener("click", function () {
                const quantity = parseInt(quantityElements[index].textContent);
                quantityElements[index].textContent = quantity + 1;
                updateTotalPriceAndQuantity(index);
            });
        });
    });
</script>

</html>