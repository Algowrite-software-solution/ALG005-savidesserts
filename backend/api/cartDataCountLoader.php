<?php
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

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];


//search card data
$db = new database_driver();
$countQuery = "SELECT COUNT(*) AS row_count FROM `card` WHERE `user_user_id`=?";
$result = $db->execute_query($countQuery, 'i', array($userId));
$resultSet = $result['result'];

if ($resultSet->num_rows === 0) {
     $responseObject->status = 'no rows';
     $responseObject->result = null;
     response_sender::sendJson($responseObject);
}

$rowCount = $resultSet->fetch_assoc();

$responseObject->status = 'success';
$responseObject->result = $rowCount;
response_sender::sendJson($responseObject);
