<div class="navbar">
    <table>
        <td>
            <tr>
            <h1>Jack-Daniels </h1>
            </tr>
        </td>
    </table>
    <tr>
        <td><a href="index.php" class="nav-link">Home</a></td>
        <td><a href="products.php" class="nav-link">Products and Services</a></td>
        <td><a href="about.php" class="nav-link">About Us</a></td>
        <td><a href="news.php" class="nav-link">News</a></td>
        <td><a href="contacts.php" class="nav-link">Contacts</a></td>
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