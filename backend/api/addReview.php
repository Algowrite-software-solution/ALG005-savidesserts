<?php

//dev by madusha
//dev date = 2023/11/27
//version =  1.0.0

//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");
require_once("../model/RequestHandler.php");
require_once("../model/data_validator.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

// validate request
if (!RequestHandler::isPostMethod()) {
       $responseObject->error = "Invalid Request";
       response_sender::sendJson($responseObject);
}

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
       $responseObject->error = 'Please Sign In';
       response_sender::sendJson($responseObject);
}

//get user data
$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//get data
$reviewText = $_POST['review_text'];

$validateReadyObject = (object) [
       "string_or_null" => [
              (object) ["datakey" => "Review", "value" => $reviewText],
       ],
];

// validate input
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
       if ($value) {
              $responseObject->error = "Invalid Input for : " . $key;
              response_sender::sendJson($responseObject);
       }
}

$defaultStatusId = 2;

//data base
$db = new database_driver();
$insertQuery = "INSERT INTO `reviews` (`review`,`review_status_id`,`user_user_id`) VALUES (?,?,?)";
$db->execute_query($insertQuery, 'sii', array($reviewText, $defaultStatusId, $userId));
$responseObject->status = "success";
response_sender::sendJson($responseObject);
