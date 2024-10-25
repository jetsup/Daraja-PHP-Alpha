<?php
include "access_token.php";
include "daraja_credentials.php";

date_default_timezone_set('Africa/Nairobi');

$processRequestURL = $PROCESS_REQUEST_URL;
$callBackURL = $NGROK_URL;
$passKey = $PASS_KEY;
$businessShortCode = $BUSINESS_USE_TILL ? $BUSINESS_TILL_NUMBER : $BUSINESS_SHORTCODE; // PayBill Number or Store Number for Till Number
$timestamp = date("YmdHis");

$password = base64_encode($businessShortCode . $passKey . $timestamp);
$phone = "254704439347";

$partyA = $BUSINESS_SHORTCODE;
$partyB = $BUSINESS_USE_TILL ? $BUSINESS_TILL_NUMBER : $BUSINESS_SHORTCODE;
$accountReference = $ACCOUNT_REFERENCE;
$transactionDesc = $PAYMENT_DESCRIPTION;
$amount = "1";
$stkPushHeader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];


echo "Password: " . $password . "<br>";
echo "Timestamp: " . $timestamp . "<br>";
echo "Phone: " . $phone . "<br>";
echo "Party A: " . $partyA . "<br>";
echo "Party B: " . $partyB . "<br>";
echo "Account Reference: " . $accountReference . "<br>";
echo "Transaction Description: " . $transactionDesc . "<br>";
echo "Amount: " . $amount . "<br>";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processRequestURL);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkPushHeader);
$curl_post_data = array(
    'BusinessShortCode' => $businessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $partyA,
    'PartyB' => $partyB,
    'PhoneNumber' => $phone,
    'CallBackURL' => $callBackURL,
    'AccountReference' => $accountReference,
    'TransactionDesc' => $transactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);

echo "Curl Response: " . $curl_response;
