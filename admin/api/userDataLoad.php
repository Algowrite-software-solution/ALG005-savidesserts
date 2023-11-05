<?php

// all user data load
// by kavindu sasanka
// version - 1.0.1
// 25-09-2023


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

$search_quary = "SELECT * FROM `user` INNER JOIN `user_status` ON `user`.`status_id` = `user_status`.`id` ";
$resultSet = $db->query($search_quary);

$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $newResults = (object) [];
    $results   = $resultSet->fetch_assoc();
    $newResults->user_id = $results["user_id"];
    $newResults->email = $results["email"];
    $newResults->full_name = $results["full_name"];
    $newResults->status_id = $results["status_id"];
    $newResults->register_date = $results["register_date"];
    $newResults->marketing_email_validation_m_id = $results["marketing_email_validation_m_id"];
    $newResults->terms_and_condition_ta_id = $results["terms_and_condition_ta_id"];
    array_push($responseResultArray, $newResults);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);
