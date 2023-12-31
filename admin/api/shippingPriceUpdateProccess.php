<?php

//shipping price updating
//by Nisal uthsara
//version - 1.0.2
//19-11-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->status = 'Please LogIn';
    response_sender::sendJson($responseObject);
}

//use the POST method
$ship_price = $_POST['shippingPrice'];
$ship_id = 1;
// $ship_id = $_POST['shipping_id'];


$db = new database_driver();

//update price
$updateQuery = "UPDATE `shipping_price` SET `price`=? WHERE `shipping_price_id`=?";
$db->execute_query($updateQuery, 'ss', array($ship_price, $ship_id));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
