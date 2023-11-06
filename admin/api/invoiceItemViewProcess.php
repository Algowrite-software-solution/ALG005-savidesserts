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
// $userCheckSession = new SessionManager();
// if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
//      $responseObject->error = 'Please login';
//      response_sender::sendJson($responseObject);
// }

if (!RequestHandler::isGetMethod()) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['order_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

$orderId = $_GET['order_id'];

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

$searchItemsQuery = "SELECT * FROM `invoice_item` 
INNER JOIN `product_item` ON `invoice_item`.`product_item_id`=`product_item`.`id`
INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id`
INNER JOIN `extra` ON `invoice_item`.`extra_id`=`extra`.`id`
INNER JOIN `weight` ON `invoice_item`.`weight_id`=`weight`.`id`
INNER JOIN `product_status` ON `product_item`.`product_status_id`=`product_status`.`id` WHERE `order_id`=?";
$invoiceItemResult = $db->execute_query($searchItemsQuery, 's', array($orderId));

$invoiceItemData = [];

while ($rowData = $invoiceItemResult['result']->fetch_assoc()) {
     array_push($invoiceItemData, $rowData);
}

$responseObject->status = "success";
$responseObject->result = $invoiceItemData;
response_sender::sendJson($responseObject);
