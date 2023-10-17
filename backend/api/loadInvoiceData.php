<?php

//Invoice Details Viewing
//by Madusha Pravinda
//version - 1.0.1;a
//27-09-2023

//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = "failed";

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//load invoice details
$db = new database_driver();

$query = "SELECT * FROM `invoice` INNER JOIN `invoice_status` ON `invoice`.`invoice_status_invoice_status_id`=`invoice_status`.`invoice_status_id` WHERE `user_user_id`=? ORDER BY `order_date` DESC";
$resultSet = $db->execute_query($query, 's', array($userId));

$dataObjectsArray = [];
if ($resultSet['result']->num_rows > 0) {
     while ($rows = $resultSet['result']->fetch_assoc()) {

          array_push($dataObjectsArray, $rows);
     }

     $responseObject->status = 'success';
     $responseObject->result = $dataObjectsArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no row data';
     response_sender::sendJson($responseObject);
}
