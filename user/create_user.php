<?php
session_start();

include "../database/db_connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $id = $_SESSION["registration_user_id"]; // delete it later
    $sql = "INSERT INTO users (username, user_log_password, user_id) VALUES ('$username', '$password', $id)";

    if ($con->query($sql) === TRUE) {
        echo "Account created successfully!";
        unset($_SESSION["registration_user_id"]);
        header("Location: ../signin.php");
        exit();
    } else {
        $sql = "DELETE FROM user_details WHERE user_id = $id";
        $con->query($sql);
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Account</title>
</head>

<body>
    <h2>Account</h2>
    <form action="create_user.php" method="post" onsubmit="return verifyInputs()">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="verify_password">Verify Password:</label>
        <input type="password" id="verify_password" name="verify_password" required><br><br>

        <input type="submit" value="Create Account">
    </form>
</body>

</html>