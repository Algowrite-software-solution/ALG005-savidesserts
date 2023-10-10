<?php

//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

if (!isset($_POST['total']) && !isset($_POST['orderId'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

$totalPayment = $_POST['total'];
$order_id = $_POST['orderId'];

// // currency Convert
// $currency_string = $totalPayment;
// $parts = explode(" ", $currency_string);
// $numerical_value = floatval($parts[1]);

//values
// $amount = $numerical_value;
$merchant_id = "1224343";

$merchant_secret = 'MTYyNzU1ODg2MDEwNTg1OTM5MjIzNjgzMzQwMzM2MTY3Mjg0Njk3NA=='; // Replace with your Merchant Secret
$currency = "LKR";

//hash generate
$hash = strtoupper(
     md5(
          $merchant_id .
               $order_id .
               number_format($totalPayment, 2, '.', '') .
               $currency .
               strtoupper(md5($merchant_secret))
     )
);

$responseObject->status = 'success';
$responseObject->results = $hash;
response_sender::sendJson($responseObject);
