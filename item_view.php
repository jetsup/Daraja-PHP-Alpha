<?php
session_start();
include 'database/db_connection.php';

if (isset($_COOKIE["product_to_cart_cookie"])) {
    $productID = $_COOKIE["product_to_cart_cookie"];
    $user_id = $_SESSION["user_id"];

    // check if the item is in the cart
    $sql = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $productID";
    $result = $con ->query($sql);
    if ($result->num_rows > 0) {
        // the item is already in the cart
        echo "<script>console.log('Item already in cart')</script>";
        // unset($_COOKIE["product_to_cart_cookie"]);
        // return;
    } else {
        $sql = "INSERT INTO cart_items (user_id, product_id) VALUES ($user_id, $productID)";
        echo "<script>console.log('SQL: $sql')</script>";
        if (!$con->query($sql)) {
            echo "<script>console.log('Error: $con->error')</script>";
            unset($_COOKIE["product_to_cart_cookie"]);
        }
        setcookie("product_to_cart_cookie", "", time() - 3600);
        // using an alert dialog, ask if the user want to redirect to the cart page or stay on the same page
        echo "<script>console.log('Added to cart')</script>";
    }
    unset($_COOKIE["product_to_cart_cookie"]);
}
// Retrieve the productID from the query parameter
$productID = isset($_GET['productID']) ? $_GET['productID'] : -1;
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

    $sql = "SELECT * from products WHERE product_id = $productID";
    $sqlImages = "SELECT * from product_images WHERE product_id = $productID";
    $imagesURL = $con->query($sqlImages)->fetch_all();
    $result = $con->query($sql);
    if ($row = $result->fetch_assoc()) { // will run only once TODO: replace with if()
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
        document.cookie = "product_to_cart_cookie=<?php echo $productID; ?>";
        // reload the page so that the cookie will e processed by php, use AJAX later
        location.reload();
    }
    function processBuy() {
        window.location.href = "checkout.php";
    }
    function toggleWishlist(like) {
        // like = 1 -> unlike
        // like = 0 -> like
        var productID = <?php echo $productID; ?>;
        var userID = <?php echo $_SESSION["user_id"]; ?>;
        console.log("ProductID: " + productID + " UserID: " + userID + " Like: " + like);
        var like = like;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhttp.open("GET", "components/shop/wishlist.php?productID=" + productID + "&userID=" + userID, true);
        xhttp.send();
    }
</script>

</html>