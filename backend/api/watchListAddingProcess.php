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
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];


//item id validation
if (!isset($_POST['productId']) || !isset($_POST['weightId'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// set variable
$productId = $_POST['productId'];
$weightId = $_POST['weightId'];

$db = new database_driver();

//search product Item Id
$searchProductItemQuery = "SELECT id FROM `product_item` WHERE `product_product_id`=? AND `weight_id`=?";
$resultSetProductItem = $db->execute_query($searchProductItemQuery, 'ss', array($productId, $weightId));

//result and stmt
$resultSetProductItemRow = $resultSetProductItem['result'];
$productItemIdArray = $resultSetProductItemRow->fetch_assoc();
$productItemId = intval($productItemIdArray['id']);

//check item already have our watchlist 
$searchQuery = "SELECT * FROM `watchlist` WHERE `product_item_id`=? AND `user_user_id`=?";
$resultSet = $db->execute_query($searchQuery, 'ss', array($productItemId, $userId));

//result and stmt
$result = $resultSet['result'];
if ($result->num_rows > 0) {
     $responseObject->error = 'this product is already available';
     response_sender::sendJson($responseObject);
}

//add product for database
$insertQuery = "INSERT INTO `watchlist`(`product_item_id`,`user_user_id`) VALUES (?,?)";
$db->execute_query($insertQuery, 'ss', array($productItemId, $userId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
