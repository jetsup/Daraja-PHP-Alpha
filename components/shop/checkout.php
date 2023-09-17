<?php
session_start();
include '../../database/db_connection.php';

$productIDsJSON = isset($_GET['productIDs']) ? $_GET['productIDs'] : "";
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

    // save the order to the database
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO orders (user_id, product_ids, product_quantities, order_total_price) VALUES ($user_id, '$productIDsJSON', '$quantitiesJSON', $totalPrice)";
    $result = $con->query($sql);
    if (!$result) {
        echo "Order not placed. Error: $con->error";
    }
    echo "Data received successfully!";
} else {
    // Handle the case where data was not received or is empty.
    echo "Data not received or is empty.";
}
?>