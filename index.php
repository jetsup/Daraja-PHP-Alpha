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
    $sql = "SELECT * from users";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Username</th><th>Password</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["password"] . "</td></tr>";
        }
        echo "</table>";
    }
    ?>
    <?php
    include 'components/footer.php';
    ?>
</body>
<script src="index.js"></script>

</html>