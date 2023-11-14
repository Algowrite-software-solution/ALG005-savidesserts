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
$fullName = $_POST['fullName'];
$mobile = $_POST['mobile'];
$addressLine1 = $_POST['addressLine1'];
$city = $_POST['city'];
$district = $_POST['district'];
$province = $_POST['province'];

if (empty($fullName) || $fullName === null ) {
     $responseObject->error = 'please enter the full name';
     response_sender::sendJson($responseObject);
}
if (empty($mobile) || $mobile === null ) {
     $responseObject->error = 'please enter the mobile';
     response_sender::sendJson($responseObject);
}
if (empty($addressLine1) || $addressLine1 === null ) {
     $responseObject->error = 'please enter the address line 1';
     response_sender::sendJson($responseObject);
}
if (empty($city) || $city === 0 ) {
     $responseObject->error = 'please select the city';
     response_sender::sendJson($responseObject);
}
if (empty($district) || $district === 0 ) {
     $responseObject->error = 'please select the district';
     response_sender::sendJson($responseObject);
}
if (empty($province) || $province === 0 ) {
     $responseObject->error = 'please select the province';
     response_sender::sendJson($responseObject);
}

//values
// $amount = $numerical_value;
$merchant_id = "229586";

$merchant_secret = 'MTI2Nzk5NjE4MTIzMTY4NzA4MzE0OTYwNDM4OTk1MTI3NjYwNTk='; // Replace with your Merchant Secret
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
