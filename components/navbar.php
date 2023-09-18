<div class="navbar">
    <ul>
        <li><a href="index.php" class="nav-link">Home</a></li>
        <li><a href="products.php" class="nav-link">Products and Services</a></li>
        <li><a href="about.php" class="nav-link">About Us</a></li>
        <li><a href="news.php" class="nav-link">News</a></li>
        <li><a href="contacts.php" class="nav-link">Contacts</a></li>
        <?php
        if (isset($_SESSION["user_id"])) {
            echo "<li><a href='cart.php' class='nav-link'>Cart</a></li>";
            // TODO: replace signout with profile, there there will be a sign out link and other custom settings the user can change
            // echo "<li><a href='signout.php' class='nav-link'>Sign out</a></li>";
            echo "<li><a href='user.php' class='nav-link'>Profile</a></li>";
        } else {
            echo "<li><a href='signin.php' class='nav-link'>Sign in</a></li>";
        }
        ?>
        <li><a href="daraja/access_token.php" class="nav-link">Token</a></li>
    </ul>
</div>