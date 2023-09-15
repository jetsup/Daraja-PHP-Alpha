<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack Daniels - Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    // Last page after clicking checkout from the cart page
    include "components/navbar.php"; // get rid of this
    ?>
    <form action="" method="get">
        <table>
            <tr>
                <td>Phone Number</td>
                <td><input type="tel" name="phone" id="phone" placeholder="254XXXXXXXXX"
                        autocomplete="tel-country-code"></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><input type="number" name="amount" id="amount"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Pay">
                </td>
                <td>
                    <input type="button" value="Cancel" onclick="backToCart()">
                </td>
            </tr>
        </table>
    </form>
    <?php
    include "components/footer.php";
    ?>
</body>
<script>
function backToCart() {
    window.location.href = "cart.php";
}
</script>

</html>