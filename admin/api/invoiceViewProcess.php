<?php

//Invoice Details Viewing
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
$responseObject->status = "failed";

//chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->error = 'Please login';
    response_sender::sendJson($responseObject);
}


//load invoice details
$db = new database_driver();

$query = "SELECT `invoice`.*, `user`.`user_id`,`user`.`email`,`user`.`full_name`,`invoice_status`.*,`delivery_details`.*,`province`.*,`distric`.* FROM `invoice` 
INNER JOIN `user` ON `invoice`.`user_user_id`=`user`.`user_id`
INNER JOIN `invoice_status` ON `invoice_status`.`invoice_status_id`=`invoice`.`invoice_status_invoice_status_id` 
INNER JOIN `delivery_details` ON `user`.`user_id`=`delivery_details`.`user_user_id`
INNER JOIN `province` ON `delivery_details`.`province_province_id` = `province`.`province_id`
INNER JOIN `distric` ON `delivery_details`.`distric_distric_id` = `distric`.`distric_id`
ORDER BY `order_date` DESC";
$resultSet = $db->query($query);

$responseResultArray = [];

for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $result = $resultSet->fetch_assoc();
    array_push($responseResultArray, $result);
}

$responseObject->status = 'success';
$responseObject->result = $responseResultArray;
response_sender::sendJson($responseObject);
