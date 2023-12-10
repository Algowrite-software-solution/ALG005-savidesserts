<?php

//dev by Janith
//dev date = 2023/11/29
//version =  1.0.0

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
require_once("../../backend/model/data_validator.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

// validate request
if (!RequestHandler::isGetMethod()) {
       $responseObject->error = "Invalid Request";
       response_sender::sendJson($responseObject);
}

// //check is login user
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
       $responseObject->error = 'Please Sign In';
       response_sender::sendJson($responseObject);
}

//load
$db = new database_driver();
$searchQuery = "SELECT * FROM `review_status`";

$resultSet = $db->query($searchQuery);

$responseObject->status = "success";
$responseObject->results = $resultSet->fetch_all(1);
response_sender::sendJson($responseObject);
