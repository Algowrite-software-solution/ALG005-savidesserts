<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
     die();
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];


//item id validation
if (!isset($_POST['product_item_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
     die();
}

//check item already have our watchlist 
$db = new database_driver();
$searchQuery = "SELECT * FROM `watchlist` WHERE `product_item_id`=? AND `user_user_id`=?";
$resultSet = $db->execute_query($searchQuery, 'ss', array($_POST['product_item_id'], $userId));

//result and stmt
$result = $resultSet['result'];
if ($result->num_rows > 0) {
     $responseObject->error = 'this product is already available';
     response_sender::sendJson($responseObject);
     die();
}

//add product for database
$insertQuery = "INSERT INTO `watchlist`(`product_item_id`,`user_user_id`) VALUES (?,?)";
$db->execute_query($insertQuery, 'ss', array($_POST['product_item_id'], $userId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
