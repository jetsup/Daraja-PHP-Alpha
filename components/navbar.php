<div class="navbar">
    <ul>
        <li><a href="index.php" class="nav-link">Home</a></li>
        <li><a href="products.php" class="nav-link">Products and Services</a></li>
        <li><a href="about.php" class="nav-link">About Us</a></li>
        <li><a href="news.php" class="nav-link">News</a></li>
        <li><a href="contacts.php" class="nav-link">Contacts</a></li>
        <!-- <li><a href="cart.php" class="nav-link">Cart</a></li> -->
        <?php
        if (isset($_SESSION["user_id"])) {
            echo "<li><a href='cart.php' class='nav-link'>Cart</a></li>";
            echo "<li><a href='logins/logout.php' class='nav-link'>Logout</a></li>";
        } else {
            echo "<li><a href='logins/login.php' class='nav-link'>Login</a></li>";
        }
        ?>
        <li><a href="daraja/access_token.php" class="nav-link">Token</a></li>
    </ul>
</div>