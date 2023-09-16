<div>
    <div>
        <!-- make a flipper effect for products with multiple images -->
        <img src="<?php echo $productImageURL ?>" alt="<?php echo $productName ?>">
        <?php
        foreach ($imagesURL as $imageURL) {
            echo "<img src='$imageURL' alt='$productName'>";
        }
        ?>
    </div>
    <h3>
        <?php echo $productName; ?>
    </h3>
    <p>$
        <?php echo $productPrice; ?>
        <s>$
            <?php echo $productPreviousPrice; ?>
        </s>
        <!-- Spacer -->
        <?php
        if(isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            // search if the user had added this product to the wishlist
            $sql = "SELECT * FROM wishlist WHERE user_id = $user_id AND product_id = $productID";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                echo "<span><img src='resources/icons/heart_filled-96.png' alt='Unlike icon' onclick='toggleWishlist(1)'></span>";
            } else {
                echo "<span><img src='resources/icons/heart-96.png' alt='Like icon' onclick='toggleWishlist(0)'></span>";
            }
        }
        ?>
    </p>
    <p>
        <button onclick="addToCart()">Cart +</button>
        <button onclick="processBuy()">Buy Now</button>
    </p>

</div>