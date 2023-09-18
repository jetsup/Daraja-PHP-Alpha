<?php
session_start();
include "../../database/db_connection.php";

$user_id = $_SESSION["user_id"];
$productID = $_GET["productID"];
// Search the product using productID if it is in the wishlist
$sql = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $productID";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // remove it
    $sql = "DELETE FROM wishlist WHERE user_id = $user_id AND product_id = $productID";
    if (!$con->query($sql)) {
        echo "<script>console.log('Error: $con->error')</script>";
    }
} else {
    $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ($user_id, $productID)";
    if (!$con->query($sql)) {
        echo "<script>console.log('Error: $con->error')</script>";
    }
}
?>