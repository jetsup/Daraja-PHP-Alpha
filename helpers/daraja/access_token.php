<?php
session_start();
include "daraja_credentials.php";

$consumerKey = $CONSUMER_KEY;
$consumerSecret = $CONSUMER_SECRET;
$accessTokenURL = $ACCESS_TOKEN_URL;//"https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

$headers = ['Content-Type:application/json; charset=utf8'];

$curl = curl_init($accessTokenURL);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ":" . $consumerSecret);

$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;

curl_close($curl);
