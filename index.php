<?php
session_start();
include 'database/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack Daniels - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include 'components/navbar.php';
    $selectedProductID = -1; //update so that it can be used in the item_view.php
    
    $sql = "SELECT * from products";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $productID = $row["product_id"];
        $productImageURL = $row["product_image_url"];
        $productName = $row["product_name"];
        $productPrice = $row["product_price"];
        $productPreviousPrice = $row["product_previous_price"];
        $productDescription = $row["product_description"];

        $selectedProductID = $productID;

        // Generate a unique ID for the "View Details" button
        $buttonID = "viewButton_$productID";

        include "components/display/item.php";
    }
    ?>
    <?php
    include 'components/footer.php';
    ?>
</body>
<script src="index.js"></script>
<script src="shop_helper.js"></script>
<script>
    function viewDetails(productID) {
        window.location.href = "item_view.php?productID=" + productID;
    }
</script>

</html>