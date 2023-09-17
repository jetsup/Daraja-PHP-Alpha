<?php
session_start();

include "../database/db_connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_first_name = $_POST["user_first_name"];
    $user_last_name = $_POST["user_last_name"];
    $user_email = $_POST["user_email"];
    $user_phone = $_POST["user_phone"];
    $user_state = $_POST["user_state"];
    $user_county = $_POST["user_county"];
    $user_town = $_POST["user_town"];

    // Insert user data into the database
    $sql = "INSERT INTO user_details (user_first_name, user_last_name, user_email, user_phone, user_state, user_county, user_town)
            VALUES ('$user_first_name', '$user_last_name', '$user_email', '$user_phone', '$user_state', '$user_county', '$user_town')";

    if ($con->query($sql) === TRUE) {
        echo "Registration successful!";
        $sql = "SELECT user_id FROM user_details WHERE user_email = '$user_email'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $m_user_id = $row["user_id"];
        $_SESSION["registration_user_id"] = $m_user_id;
        header("Location: create_user.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Signup</h2>
    <form action="register.php" method="post" onsubmit="return verifyInputs()">
        <label for="user_first_name">First Name:</label>
        <input type="text" id="user_first_name" name="user_first_name" required><br><br>

        <label for="user_last_name">Last Name:</label>
        <input type="text" id="user_last_name" name="user_last_name" required><br><br>

        <label for="user_email">Email:</label>
        <input type="email" id="user_email" name="user_email" required><br><br>

        <label for="user_phone">Phone:</label>
        <input type="text" id="user_phone" name="user_phone" required><br><br>

        <label for="user_state">State/Province:</label>
        <input type="text" id="user_state" name="user_state" required><br><br>

        <label for="user_county">County:</label>
        <input type="text" id="user_county" name="user_county" required><br><br>

        <label for="user_town">Town:</label>
        <input type="text" id="user_town" name="user_town" required><br><br>

        <input type="submit" value="Proceed">
        <p>Already have an account? <a href="login.php"><i>login</i></a></p>
    </form>
</body>
<script>
    function verifyInputs() {
        var user_first_name = document.getElementById("user_first_name").value;
        var user_last_name = document.getElementById("user_last_name").value;
        var user_email = document.getElementById("user_email").value;
        var user_phone = document.getElementById("user_phone").value;
        var user_state = document.getElementById("user_state").value;
        var user_county = document.getElementById("user_county").value;
        var user_town = document.getElementById("user_town").value;

        if (user_first_name == "" || user_last_name == "" || user_email == "" || user_phone == "" || user_state == "" || user_county == "" || user_town == "") {
            alert("Please fill in all the fields.");
            return false;
        } else {
            return true;
        }
    }
</script>
</html>