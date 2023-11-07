<?php

//Invoice Item Details Viewing
//by Janith Nirmal
//version - 1.0.0
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


//database object
$db = new database_driver();

$searchItemsQuery = "SELECT * FROM `invoice` 
INNER JOIN `invoice_status` ON `invoice`.`invoice_status_invoice_status_id` = `invoice_status`.`invoice_status_id` 
WHERE `invoice_status`.`status` = 'Accept' OR  `invoice_status`.`status` = 'Packaging'";
$invoiceItemResult = $db->query($searchItemsQuery);


$responseObject->status = "success";
$responseObject->results = $invoiceItemResult->fetch_all();
response_sender::sendJson($responseObject);
