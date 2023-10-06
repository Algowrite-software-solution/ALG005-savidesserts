<?php

//weights Adding API
//by madusha pravinda
//version - 1.0.2
//06-10-2023

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
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['weight'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$weight = $_POST['weight'];

//database object
$db = new database_driver();

// data insert
$insertWeight = "INSERT INTO `weight` (`weight`) VALUES (?)";
$db->execute_query($insertWeight, 's', array($weight));

$responseObject->status = 'success';
response_sender::sendJson($responseObject);
