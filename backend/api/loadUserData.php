<?php
// user data load api
// by madusha pravinda
// version - 1.0.
// 03-09-2023


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

//user search query
$db = new database_driver();
$searchQuery = "SELECT * FROM `user` WHERE `user_id`=?";
$result = $db->execute_query($searchQuery, 's', array($userId));

//result
$rowData = $result['result']->fetch_assoc();


$responseDataObject = new stdClass();
$responseDataObject->user_name = $rowData['full_name'];
$responseDataObject->email = $rowData['email'];

$responseObject->response = $responseDataObject;
$responseObject->status = "success";
response_sender::sendJson($responseObject);
