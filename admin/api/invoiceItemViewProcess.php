<?php

//Invoice Item Details Viewing
//by Madusha
//version - 1.0.1
//27-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
require_once("../../backend/model/data_validator.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = "failed";

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
}

if (!RequestHandler::isGetMethod()) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['order_id']) || empty($_GET["order_id"])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

$orderId = "#" . $_GET['order_id'];

$validateReadyObject = (object) [
     "string_or_null" => [
          (object) ["datakey" => "orderId", "value" => $orderId],
     ],
];
// validate input
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
     if ($value) {
          $responseObject->error = "Invalid Input for : " . $key;
          response_sender::sendJson($responseObject);
     }
}

//database object
$db = new database_driver();

$searchItemsQuery = "SELECT * FROM `invoice_item` WHERE `order_id`=?";
$invoiceItemResult = $db->execute_query($searchItemsQuery, 's', array($orderId));

$responseObject->status = "success";
$responseObject->results = $invoiceItemResult['result']->fetch_all(1);
response_sender::sendJson($responseObject);
