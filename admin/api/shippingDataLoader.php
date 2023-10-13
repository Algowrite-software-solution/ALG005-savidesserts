<?php
// shpping data load api
// by madusha pravinda
// version - 1.0.0
// 03-09-2023


//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
}

//search card data
$db = new database_driver();
$searchQuery = "SELECT * FROM `shipping_price`";
$result = $db->query($searchQuery);
$queryResult = $result->fetch_assoc();
$shippingPrice = $queryResult['price'];
$responseObject->status = 'success';
$responseObject->result = $shippingPrice;
response_sender::sendJson($responseObject);
