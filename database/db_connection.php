<?php
include "../helpers/credentials.php";
// change the values below to match your database settings
$database_username = $DATABASE_USERNAME;
$database_password = $DATABASE_PASSWORD;
$database_name = "jack_daniels";
$database_host = "localhost";
$con = new mysqli($database_host, $database_username, $database_password, $database_name);
?>