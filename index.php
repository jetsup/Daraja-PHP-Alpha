<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack Daniels - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include 'components/navbar.php';
    include 'database/db_connection.php';
    
    $sql ="SELECT * from products";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $productImageURL = $row["product_image_url"];
        $productName = $row["product_name"];
        $productPrice = $row["product_price"];
        $productPreviousPrice = $row["product_previous_price"];
        $productDescription = $row["product_description"];

        include "components/display/item.php";
    }
    ?>
    <?php
    include 'components/footer.php';
    ?>
</body>
<script src="index.js"></script>

</html>