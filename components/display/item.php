<div class="item" id="<?php echo $buttonID; ?>">
    <img src="<?php echo $productImageURL ?>" alt="Product Image" onclick="viewDetails(<?php echo $productID; ?>)">
    <h3 onclick="viewDetails(<?php echo $productID; ?>)">
        <?php echo $productName; ?>
    </h3>
    <p>$
        <?php echo $productPrice; ?>
        <s>$
            <?php echo $productPreviousPrice; ?>
        </s>
        <?php
        if (isset($_SESSION["user_id"])) {
            echo "<span><button onclick='addToCart()'>Cart +</button><button onclick='processBuy()'>Buy Now</button></span>";
        }
        ?>
    </p>
    <p><b>
            <?php echo $productDescription; ?>
        </b></p>
</div>