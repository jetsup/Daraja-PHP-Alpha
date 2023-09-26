<h1 class="logo">Jack-Daniels</h1>
<div>
    <tr class="navbar">
        <td><a href="index.php" class="nav-link">Home</a></td>
        <td><a href="products.php" class="nav-link">Products and Services</a></td>
        <td><a href="about.php" class="nav-link">About Us</a></td>
        <td><a href="news.php" class="nav-link">News</a></td>
        <td><a href="contacts.php" class="nav-link">Contacts</a></td>
        <?php
        if (isset($_SESSION["user_id"])) {
            echo "<td><a href='cart.php' class='nav-link'>Cart</a></td>";
            // TODO: replace signout with profile, there there will be a sign out link and other custom settings the user can change
            // echo "<li><a href='signout.php' class='nav-link'>Sign out</a></li>";
            echo "<td><a href='user.php' class='nav-link'>Profile</a></td>";
        } else {
            echo "<td><a href='signin.php' class='nav-link'>Sign in</a></td>";
        }
        ?>
        <td><a href="daraja/access_token.php" class="nav-link">Token</a></td>
    </tr>
</div>