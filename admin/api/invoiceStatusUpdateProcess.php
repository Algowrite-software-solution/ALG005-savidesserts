<?php

//Invoice Status update
//by Nisal uthsara
//version - 1.0.1
//27-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = "failed";

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseDataObject->error = "Please LogIn";
    response_sender::sendJson($responseObject);
}

//use POST method
$invoiceId = $_GET['invoice_id'];
$invoice_statusId = $_GET['invoice_status_Id'];

$db = new database_driver();

//update invoice status
$updateQuery = "UPDATE `invoice` SET `invoice_status_invoice_status_id`=? WHERE `invoice_id`=?";
$db->execute_query($updateQuery, 'ss', array($invoice_statusId, $invoiceId));
$responseObject->status = "success";
response_sender::sendJson($responseObject);
