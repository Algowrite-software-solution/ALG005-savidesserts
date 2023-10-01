<?php

//category Adding API
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

if (!isset($_GET['category_type'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$category_type = $_GET['category_type'];

//database object
$db = new database_driver();

// data insert
$insertCategory = "INSERT INTO `category` (`category_type`) VALUES (?)";
$db->execute_query($insertCategory, 's', array($category_type));
$responseObject->status = 'Added Success';
response_sender::sendJson($responseObject);
