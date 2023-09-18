<?php
session_start();
include "../../database/db_connection.php";

$data = file_get_contents("php://input");
$responseJSON = json_decode($data, true);

error_log(print_r($data, true), 0);

$merchantRequestID = $responseJSON['Body']['stkCallback']['MerchantRequestID'];
$checkoutRequestID = $responseJSON['Body']['stkCallback']['CheckoutRequestID'];
$resultCode = $responseJSON['Body']['stkCallback']['ResultCode'];
$resultDesc = $responseJSON['Body']['stkCallback']['ResultDesc'];
$item = $responseJSON['Body']['stkCallback']['CallbackMetadata']['Item'];

$user_id = $_SESSION["user_id"];
$transactionCode = $item[1]["Value"];
$amount = $item[0]["Value"];
$transactionDate = $item[3]["Value"];
$paidBy = $item[4]["Value"];

// Get the pending order whose payment is being processed
$sql = "SELECT * FROM pending_orders WHERE order_total_price = $amount AND user_id = $user_id";
$result = $con->query($sql);
if (!$result) {
    echo "Error: $con->error";
}
$pendingOrderID = $result->fetch_assoc()["pending_order_id"];

$sql = "INSERT INTO orders (user_id, pending_order_id, payment_date) VALUES ($user_id, $pendingOrderID, $transactionDate)";
$result = $con->query($sql);
if (!$result) {
    echo "Error: $con->error";
}
echo "Order $pendingOrderID is now being prepared for delivery.";
?>