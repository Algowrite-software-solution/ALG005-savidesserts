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
if (!RequestHandler::isGetMethod()) {
       $responseObject->error = "Invalid Request";
       response_sender::sendJson($responseObject);
}

$limit = (!empty($_GET['limit'])) ? $_GET['limit'] : 3; // defult limit


$validateReadyObject = (object) [
       "id_int" => [
              (object) ["datakey" => "limit", "value" => $limit]
       ],
];

//validation
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
       if ($value) {
              $responseObject->error = "Invalid Input for : " . $key;
              response_sender::sendJson($responseObject);
       }
}

//status code
$statusCode = 1;

//load
$db = new database_driver();
$searchQuery = "SELECT `user`.`full_name`, `reviews`.`review` FROM `reviews` 
INNER JOIN `user` ON `user`.`user_id`= `reviews`.`user_user_id` WHERE `review_status_id`=? LIMIT ? ";

$result = $db->execute_query($searchQuery, 'ii', array($statusCode, $limit));

$resultSet = $result['result'];

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
