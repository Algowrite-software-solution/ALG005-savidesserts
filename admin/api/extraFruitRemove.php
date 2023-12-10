<?php

//extra fruit Status Table load API
//by Janith Nirmal
//version - 1.0.0
//28-11-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// checking is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

$id = $_GET["id"];

//database object
$db = new database_driver();

try {
     $extraStatusSearch = "DELETE FROM `extra` WHERE `id`=? ";
     $result = $db->execute_query($extraStatusSearch, 'i', [$id]);
} catch (\Throwable $th) {
     $responseObject->error = 'Something Went Wrong!';
     response_sender::sendJson($responseObject);
}

$responseObject->status = 'success';
response_sender::sendJson($responseObject);
