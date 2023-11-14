<?php
// all user status change
// by janith nirmal
// version - 1.0.0
// 14-11-2023


//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");


//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->error = 'Please LogIn';
    response_sender::sendJson($responseObject);
}



// db connection
$db = new database_driver();
$query = "SELECT * FROM `promotion_status`";
$db_result =  $db->query($query);

$responseObject->status = "success";
$responseObject->results = $db_result->fetch_all();
response_sender::sendJson($responseObject);
