<?php
//product Item Update API
//by madusha pravinda
//version - 1.0.0
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$productItemId = $_GET['id'];

//database object
$db = new database_driver();

//data update
$productItemDelete = "DELETE  FROM `product_item` WHERE `id`=?";
$db->execute_query($productItemDelete, 's', array($productItemId));
$responseObject->status = 'Product Item Delete';
response_sender::sendJson($responseObject);
