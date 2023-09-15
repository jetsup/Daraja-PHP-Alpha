<?php
date_default_timezone_set('Africa/Nairobi');

$processRequestURL = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$callBackURL = "";
$passKey ="";
$businessShortCode = "";
$timestamp = date("YmdHis");
$password = base64_encode($businessShortCode . $passKey . $timestamp);
$phone = "";
$partyA = "";
$partyB = "";
$accountReference = "";
$transactionDesc = "";
$amount = "";
$stkPushHeader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

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
    // 'PartyB' => $partyB,
    'partyB' => $businessShortCode,
    'PhoneNumber' => $partyA,
    'CallBackURL' => $callBackURL,
    'AccountReference' => $accountReference,
    'TransactionDesc' => $transactionDesc
);