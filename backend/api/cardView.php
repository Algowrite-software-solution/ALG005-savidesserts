<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/user_access_updater.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new UseerAccess();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
     die();
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//search card data
$db = new database_driver();
$searchQuery = "SELECT * FROM `card` WHERE `user_user_id` = ?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];
$stmt = $queryResult['stmt'];

while ($result->num_rows()) { 
     
}
