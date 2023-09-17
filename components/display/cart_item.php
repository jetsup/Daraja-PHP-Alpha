<div>
    <input type="checkbox">
    <img src="<?php echo $productImageURL ?>" alt="Image of the Product">
    <h3>Product Name</h3>
    <p>$<span>
            <?php echo $productPrice ?>
        </span></p>
    <div class="quantity-control">
        <button class="decrement-button">-</button>
        <span class="quantity">1</span>
        <button class="increment-button">+</button>
    </div>
</div>