<?php
include 'database/db_connection.php';
if (isset($_COOKIE["product_to_cart_cookie"])) {
    $productID = $_COOKIE["product_to_cart_cookie"];
    echo $productID;
    $sql = "INSERT INTO cart_items (user_id, product_id) VALUES ($productID)";
    $con->query($sql);
    setcookie("product_to_cart_cookie", "", time() - 3600);
    // using an alert dialog, ask if the user want to redirect to the cart page or stay on the same page
    echo "<script>console.log('Added to cart')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo "Product Name"; ?>
    </title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include 'components/navbar.php';
    include 'database/db_connection.php';

    $sql = "SELECT * from products WHERE product_id = $selectedProductID";
    $sqlImages = "SELECT * from product_images WHERE product_id = $selectedProductID";
    $imagesURL = $con->query($sqlImages)->fetch_all();
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) { // will run only once TODO: replace with if()
        $productImageURL = $row["product_image_url"];
        $productName = $row["product_name"];
        $productPrice = $row["product_price"];
        $productPreviousPrice = $row["product_previous_price"];
        $productDescription = $row["product_description"];

        include "components/display/item_details.php";
    }
    // reviews
    // recommendations
    // other products that works best/ relates to the current product
    ?>
    <?php
    include 'components/footer.php';
    ?>
</body>
<script>
    function addToCart() {
        document.cookie = "product_to_cart_cookie=<?php echo $selectedProductID; ?>";
        // reload the page so that the cookie will e processed by php, use AJAX later
        location.reload();
    }
    function processBuy() {
        window.location.href = "checkout.php";
    }
</script>

</html>