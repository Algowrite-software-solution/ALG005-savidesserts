<?php

//Invoice Status load
//by Nisal uthsara
//version - 1.0.1
//27-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->status = 'Please LogIn';
    response_sender::sendJson($responseObject);
}

//load invoice status

$db = new database_driver();

$query = "SELECT `status` FROM `invoice_status`";
$resultSet = $db->query($query);

$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $result = $resultSet->fetch_assoc();
    array_push($responseResultArray, $result);
}

$responseObject->status = 'success';
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);


?>