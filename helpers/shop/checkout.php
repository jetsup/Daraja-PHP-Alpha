<?php
session_start();
include '../../database/db_connection.php';

if (isset($_GET['queryType'])) {
    $queryType = $_GET['queryType'];
    if ($queryType == "processPayment") {
        $productIDsJSON = isset($_GET['productIDs']) ? $_GET['productIDs'] : "";
        // TODO: Remove quantities from the parameters and use the quantities already in DB
        $quantitiesJSON = isset($_GET['quantities']) ? $_GET['quantities'] : "";

        $productIDs = json_decode($productIDsJSON, true);
        $quantities = json_decode($quantitiesJSON, true);

        if (!empty($productIDs) && !empty($quantities)) {
            $totalPrice = 0;
            for ($i = 0; $i < count($productIDs); $i++) {
                $productID = $productIDs[$i];
                $quantity = $quantities[$i];

                $sql = "SELECT * FROM products WHERE product_id = $productID";
                $product = $con->query($sql)->fetch_assoc();
                $productPrice = $product["product_price"];
                $productDiscount = $product["product_discount"];
                $totalPrice += ($productPrice - $productDiscount) * $quantity;
            }

            // save the order to the pending order tabe in database
            $user_id = $_SESSION["user_id"];
            $sql = "INSERT INTO pending_orders (user_id, product_ids, product_quantities, order_total_price) VALUES ($user_id, '$productIDsJSON', '$quantitiesJSON', $totalPrice)";
            $result = $con->query($sql);
            if (!$result) {
                echo "Order not placed. Error: $con->error";
            }
            $pendingOrderID = $result->fetch_assoc()["pending_order_id"];
            echo "Payment pending for order NO.: $pendingOrderID";
        } else {
            // Handle the case where data was not received or is empty.
            echo "Data not received or is empty.";
        }
    } else if ($queryType == "addToCart") {
        $productID = isset($_GET['productID']) ? $_GET['productID'] : -1;
        $user_id = $_SESSION["user_id"];

        // check if the item is in the cart
        $sql = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $productID";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "Item with ID '$productID' already in cart";
        } else {
            $sql = "INSERT INTO cart_items (user_id, product_id) VALUES ($user_id, $productID)";
            if (!$con->query($sql)) {
                echo "Error: $con->error";
            }
            echo "Item with ID '$productID' added to cart";
        }
    } else if ($queryType == "buyProduct") {
        $user_id = $_SESSION["user_id"];
        $productID = json_encode(isset($_GET['productID']) ? $_GET['productID'] : -1);
        $quantity = json_encode(1);
        // get the product price
        $sql = "SELECT * FROM products WHERE product_id = $productID";
        $product = $con->query($sql)->fetch_assoc();
        $productPrice = $product["product_price"];
        $productDiscount = ($product["product_discount"] / 100) * $productPrice;
        $totalPrice = json_encode($productPrice - $productDiscount);

        // save the order to the pending order table in database
        $sql = "INSERT INTO pending_orders (user_id, product_ids, product_quantities, order_total_price) VALUES ($user_id, '$productID', '$quantity', $totalPrice)";
        $result = $con->query($sql);
        if (!$result) {
            echo "Order not placed. Error: $con->error";
        }
        echo "Item with ID '$productID' placed in pending orders";
    } else if ($queryType == "updateCart") {
        $productID = isset($_GET['productID']) ? $_GET['productID'] : -1;
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : -1;
        $user_id = $_SESSION["user_id"];

        $sql = "UPDATE cart_items SET product_quantity = $quantity WHERE user_id = $user_id AND product_id = $productID";
        $result = $con->query($sql);
        if (!$result) {
            echo "Error: $con->error";
        }
        echo "Quantity updated: $quantity";
    }
}
?>