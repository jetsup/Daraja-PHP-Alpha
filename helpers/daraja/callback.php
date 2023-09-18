<?php
session_start();

$data = file_get_contents("php://input");
$data = json_decode($data, true);

error_log(print_r($data, true), 0);

echo "{
    'ResponseCode': 0,
    'ResponseDesc': 'Accept Service'
}";
?>