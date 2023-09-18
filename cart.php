<?php
session_start();
include 'database/db_connection.php';

if (isset($_GET['querySelectedItems'])) {
    $productID = isset($_GET['productID']) ? $_GET['productID'] : -1;
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : -1;
    $user_id = $_SESSION["user_id"];
    $sql = "UPDATE cart_items SET product_quantity = $quantity WHERE user_id = $user_id AND product_id = $productID";
    $result = $con->query($sql);
    echo "<script>console.log('Quantity updated:',$quantity);</script>";
    if (!$result) {
        echo "<script>console.log('Error: $con->error')</script>";
    }
}
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
    $checkItems = 0; // count the number of items checked by the user
    if ($result->num_rows > 0) {
        // the user has products in the cart
        while ($row = $result->fetch_assoc()) {
            $productID = $row["product_id"];
            $sql = "SELECT * FROM products WHERE product_id = $productID";
            $product = $con->query($sql)->fetch_assoc();
            $productName = $product["product_name"];
            $productPrice = $product["product_price"];
            $productQuantity = $row["product_quantity"];
            $productDescription = $product["product_description"];
            $productImageURL = $product["product_image_url"];
            include "components/display/cart_item.php";
        }
        echo "<p>Total: $<span id='total-price'>0.00</span></p>";
        echo "<p>Total Items: <span class='total'>$checkItems</span></p>";
        echo "<button id='checkout-button' onclick='checkout()'>Checkout ($checkItems)</button>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

    <?php
    include 'components/footer.php';
    ?>
</body>
<script src="index.js"></script>
<script src="shop_helper.js"></script>
<script>
    // query all div elements
    const cartItems = document.querySelectorAll("div[class='quantity-control']");
    // console.log(cartItems);
    // get the ID of the div whose child was clicked
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("increment-button")) {
            // increment the quantity
            const quantity = e.target.parentElement.querySelector(".quantity");
            quantity.innerText = parseInt(quantity.innerText) + 1;
            // update the total price
            const productID = e.target.parentElement.id.replace("quantity-control", "");
            const productPrice = document.querySelector(`#product-price${productID}`).innerText;
            if (document.querySelector(`#cart-item${productID}`).querySelector(".checkout-box").checked) {
                const totalPrice = document.querySelector("#total-price");
                totalPrice.innerText = parseFloat(totalPrice.innerText) + parseFloat(productPrice);
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Update done!");
                }
            };
            xhttp.open("GET", "cart.php?productID=" + productID + "&quantity=" + quantity.innerText + "&querySelectedItems=" + 0, true);
            xhttp.send();
        } else if (e.target.classList.contains("decrement-button")) {
            // decrement the quantity
            const quantity = e.target.parentElement.querySelector(".quantity");
            if (parseInt(quantity.innerText) > 1) {
                quantity.innerText = parseInt(quantity.innerText) - 1;
                // update the total price
                const productID = e.target.parentElement.id.replace("quantity-control", "");
                const productPrice = document.querySelector(`#product-price${productID}`).innerText;
                if (document.querySelector(`#cart-item${productID}`).querySelector(".checkout-box").checked) {
                    const totalPrice = document.querySelector("#total-price");
                    totalPrice.innerText = parseFloat(totalPrice.innerText) - parseFloat(productPrice);
                }

                // TODO: Using AJAX, update the quantity column of the cart items table
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("Update done!");
                    }
                };
                xhttp.open("GET", "helpers/shop/checkout.php?queryType=addToCart&productID=" + productID + "&quantity=" + quantity.innerText, true);
                xhttp.send();
            }
        }
        // Process checkout
        // if (e.target.id == "checkout-button" && document.querySelector(".total").innerText > 0) {
        //     // get all the checked items
        //     const checkedItems = document.querySelectorAll("input[class='checkout-box']:checked");
        //     // get the productID and quantity of each checked item
        //     var productIDs = [];
        //     var quantities = [];
        //     checkedItems.forEach(item => {
        //         const productID = item.parentElement.id.replace("cart-item", "");
        //         const quantity = item.parentElement.querySelector(".quantity").innerText;
        //         productIDs.push(productID);
        //         quantities.push(quantity);
        //     });
        //     // send the productIDs and quantities to the server
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function () {
        //         if (this.readyState == 4 && this.status == 200) {
        //             console.log("Checkout done!");
        //             console.log(this.responseText);
        //         }
        //     };
        //     var productIDsJSON = JSON.stringify(productIDs);
        //     var quantitiesJSON = JSON.stringify(quantities);
        //     xhttp.open("GET", "helpers/shop/checkout.php?queryType=checkout&productIDs=" + productIDsJSON + "&quantities=" + quantitiesJSON, true);
        //     xhttp.send();
        // }
    });
    // update the total price when the checkbox is checked
    document.addEventListener("change", function (e) {
        if (e.target.classList.contains("checkout-box")) {
            const checkbox = e.target;
            const quantity = checkbox.parentElement.querySelector(".quantity");
            const productID = checkbox.parentElement.id.replace("cart-item", "");
            const productPrice = document.querySelector(`#product-price${productID}`).innerText;
            const totalPrice = document.querySelector("#total-price");
            const totalItems = document.querySelector(".total");
            if (checkbox.checked) {
                totalPrice.innerText = parseFloat(totalPrice.innerText) + (parseFloat(productPrice) * parseInt(quantity.innerText));
                totalItems.innerText = parseInt(totalItems.innerText) + 1;
            } else {
                totalPrice.innerText = parseFloat(totalPrice.innerText) - (parseFloat(productPrice) * parseInt(quantity.innerText));
                totalItems.innerText = parseInt(totalItems.innerText) - 1;
            }
            document.querySelector("#checkout-button").innerText = `Checkout (${totalItems.innerText})`;
        }
    });
</script>

</html>