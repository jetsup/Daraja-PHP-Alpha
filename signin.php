<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    include "database/db_connection.php";

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT user_id, username, user_log_password FROM users WHERE username = '$username'";
    $result = $con->query($sql);
    $result = $result->fetch_all();
    $user_id = $result[0][0];
    $user_password = $result[0][2];
    
    echo "<script>console.log('Username: $username Password: $password DBPassword: $user_password UserID: $user_id')</script>";
    
    if (count($result) == 1) {
        // Verify the password
        if ($password === $user_password) {
            // store the user_id in a session variable
            $_SESSION["user_id"] = $user_id;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jack Daniels - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Login</h2>
    <?php
    if (isset($error_message)) {
        echo "<p>$error_message</p>";
    }
    ?>
    <form action="signin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
        <p>Don't have an account? <a href="register.php"><i>signup</i></a></p>
    </form>
</body>

</html>