<div class="cart-items" id="cart-item<?php echo $productID; ?>">
    <input type="checkbox" class="checkout-box">
    <img src="<?php echo $productImageURL ?>" alt="Image of the Product">
    <h3>Product Name</h3>
    <p>$<span id="product-price<?php echo $productID; ?>">
            <?php echo $productPrice ?>
        </span></p>
    <div class="quantity-control" id="quantity-control<?php echo $productID; ?>">
        <button class="decrement-button">-</button>
        <span class="quantity">
            <?php echo $productQuantity; ?>
        </span>
        <button class="increment-button">+</button>
    </div>
</div>