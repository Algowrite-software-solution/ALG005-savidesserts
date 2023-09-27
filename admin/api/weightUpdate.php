<?php

//weight Update API
//by madusha pravinda
//version - 1.0.1
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
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$weightId = $_GET['id'];
$newWeight = $_GET['newWeight'];

//database object
$db = new database_driver();

// data insert
$weightUpdate = "UPDATE `weight` SET `weight`=? WHERE `id`=?";
$db->execute_query($weightUpdate, 'ss', array($newWeight, $weightId));
$responseObject->status = 'Update Success';
response_sender::sendJson($responseObject);
