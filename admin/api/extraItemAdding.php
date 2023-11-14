<?php

//extra Item Adding API
//by madusha pravinda
//version - 1.0.2 (last updated - 18-10-2023)
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['fruit']) && !isset($_POST['price'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$extraFruit = $_POST['fruit'];
$extraPrice = $_POST['price'];

//database object
$db = new database_driver();

// data insert
$insertCategory = "INSERT INTO `extra` (`extra_status_id`,`fruit`,`price`) VALUES (?,?,?)";
$db->execute_query($insertCategory, 'sss', array('1', $extraFruit, $extraPrice));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
