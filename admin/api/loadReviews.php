<?php

//dev by madusha
//dev date = 2023/11/27
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
$searchQuery = "SELECT `user`.`email`, `user`.`full_name`, `review_status`.* , `reviews`.* FROM `reviews` 
INNER JOIN `user` ON `user`.`user_id`= `reviews`.`user_user_id`
INNER JOIN `review_status` ON `review_status`.`id`=`reviews`.`review_status_id`";

$resultSet = $db->query($searchQuery);

if ($resultSet->num_rows < 1) {
       $responseObject->error = "no reviews";
       response_sender::sendJson($responseObject);
}

$responseResultArray = [];

while ($row = $resultSet->fetch_assoc()) {
       array_push($responseResultArray, $row);
}

$responseObject->status = "success";
$responseObject->result = $responseResultArray;
response_sender::sendJson($responseObject);
