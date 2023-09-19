<?php
session_start();
include 'database/db_connection.php';

if (isset($_COOKIE["product_to_cart_cookie"])) {
    $productID = $_COOKIE["product_to_cart_cookie"];
    $user_id = $_SESSION["user_id"];

    // check if the item is in the cart
    $sql = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $productID";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        // the item is already in the cart
        echo "Item already in cart";
        // unset($_COOKIE["product_to_cart_cookie"]);
        // return;
    } else {
        $sql = "INSERT INTO cart_items (user_id, product_id) VALUES ($user_id, $productID)";
        if (!$con->query($sql)) {
            echo "Error: $con->error";
            unset($_COOKIE["product_to_cart_cookie"]);
        }
        setcookie("product_to_cart_cookie", "", time() - 3600);
        // using an alert dialog, ask if the user want to redirect to the cart page or stay on the same page
        echo "Added to cart";
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
<script src="shop_helper.js"></script>
<script>
    function toggleWishlist(like) {
        // like = 1 -> unlike
        // like = 0 -> like
        var productID = <?php echo $productID; ?>;
        var userID = <?php
        if (isset($_SESSION["user_id"])) {
            echo $_SESSION["user_id"];
        } else {
            echo -1;
        }
        ?>;
        console.log("ProductID: " + productID + " UserID: " + userID + " Like: " + like);
        var like = like;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhttp.open("GET", "helpers/shop/wishlist.php?productID=" + productID, true);
        xhttp.send();
    }
</script>

</html>