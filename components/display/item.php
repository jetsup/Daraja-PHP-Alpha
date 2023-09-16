<div class="item" onclick="viewDetails()">
    <img src="<?php echo $productImageURL ?>" alt="Product Image">
    <h3>
        <?php echo $productName; ?>
    </h3>
    <p>$
        <?php echo $productPrice; ?>
        <s>$
            <?php echo $productPreviousPrice; ?>
        </s>
    </p>
    <p><b>
            <?php echo $productDescription; ?>
        </b></p>
</div>