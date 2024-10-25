<?php
include "credentials.php";
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

try {
    $con = new mysqli($DATABASE_HOST, $DATABASE_USERNAME, 
    $DATABASE_PASSWORD, $DATABASE_DB, $DATABASE_PORT, $DATABASE_SOCKET);
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
