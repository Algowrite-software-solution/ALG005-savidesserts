<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");


//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please Sign In';
     response_sender::sendJson($responseObject);
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];


$db = new database_driver();
$query = "SELECT * FROM `delivery_details` INNER JOIN `user` ON `delivery_details`.`user_user_id` = `user`.`user_id` WHERE `user_user_id`=?";
$result = $db->execute_query($query, 's', array($userId));


$responseArray = array();
if ($row = $result['result']->fetch_assoc()) {
     $responseResultObject =  new stdClass();
     $responseResultObject->fullName = $row['full_name'];
     $responseResultObject->address_line_1 = $row['address_line_1'];
     $responseResultObject->address_line_2 = $row['address_line_2'];
     $responseResultObject->mobile = $row['mobile'];
     $responseResultObject->province_id = $row['province_province_id'];
     $responseResultObject->distric_id = $row['distric_distric_id'];
     $responseResultObject->city = $row['city'];
     $responseResultObject->postal_code = $row['postal_code'];


     array_push($responseArray, $responseResultObject);

     $responseObject->status = 'success';
     $responseObject->results = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $nameQuery = "SELECT * FROM `user` WHERE `user_id`=? ";
     $nameResult = $db->execute_query($nameQuery, 's', array($userId));
     $row = $nameResult['result']->fetch_assoc();
     $name = $row['full_name'];

     $responseObject->status = 'now shipping row data';
     $responseObject->name = $name;
     response_sender::sendJson($responseObject);
}
