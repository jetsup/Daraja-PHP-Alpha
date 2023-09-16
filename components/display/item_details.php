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
        <span><img src="" alt="Like icon"></span>
    </p>
    <p>
        <button onclick="addToCart()">Cart +</button>
        <button onclick="processBuy()">Buy Now</button>
    </p>

</div>