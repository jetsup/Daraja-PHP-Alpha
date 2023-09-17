<?php
session_start();

if (isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    // Redirect back to the previous page
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // If HTTP_REFERER is not set, you can redirect to a default page
        header('Location: index.php'); // Replace 'index.php' with your desired default page
    }
}
exit();
?>