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
     $responseObject->error = 'Please Sign In';
     response_sender::sendJson($responseObject);
}

$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//JSON object decodes and get the productItemId & qty & weightId & extraItemId  & productTotalPrice
//user the POST method
$incomingQty = $_POST['qty'];
$productId = $_POST['product_id'];
$weightId = $_POST['loadWeightContainer'];
$extraItemId = $_POST['extraItemContainer'];

$db = new database_driver();
//search product Item Id
$searchProductItemQuery = "SELECT * FROM `product_item` WHERE `product_product_id`=? AND `weight_id`=?";
$resultSetProductItem = $db->execute_query($searchProductItemQuery, 'ss', array($productId, $weightId));

//result and stmt
$resultSetProductItem = $resultSetProductItem['result'];

$productRow = $resultSetProductItem->fetch_assoc();
$productItemId = $productRow['id'];
$qty = $productRow['qty'];

//qty checking
if ($qty < $incomingQty) {
     $responseObject->error = 'stock limited';
     response_sender::sendJson($responseObject);
}

// check Already have
$searchQuery = "SELECT * FROM `card` WHERE `product_item_id`=? AND `weight_id`=? AND `extra_id`=? AND `user_user_id`=?";
$resultCard = $db->execute_query($searchQuery, 'iiii', array($productItemId, $weightId, $extraItemId, $userId));


if ($resultCard['result']->num_rows > 0) {
     $responseObject->error = 'Already Added this Product';
     response_sender::sendJson($responseObject);
}

// //add this product to the cart
$insertQuery = "INSERT INTO `card`(`qty`,`product_item_id`,`weight_id`,`extra_id`,`user_user_id`) VALUES (?,?,?,?,?) ";
$db->execute_query($insertQuery, 'sssss', array($incomingQty, $productItemId, $weightId, $extraItemId, $userId));
$responseObject->status = 'product added successfully';
response_sender::sendJson($responseObject);
