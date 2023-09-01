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

//JSON object decodes and get the productItemId & qty & weightId & extraItemId  & productTotalPrice
//user the POST method
$cardAddingData = json_decode($_POST["cardAddingData"]);
$incomingQty = $cardAddingData->qty;
$productItemId = $cardAddingData->productItemId;
$weightId = $cardAddingData->weightId;
$extraItemId = $cardAddingData->extraItemId;

//check qty have our store
$db = new database_driver();
$searchQuery = "SELECT qty FROM `product_item` WHERE `id`=? AND `weight_id`=?";
$resultSet = $db->execute_query($searchQuery, 's', array($productItemId, $weightId));

//result and stmt
$result = $resultSet['result'];
$stmt = $queryResult['stmt'];

//fetch related data
$qty = $result->fetch_assoc();

//qty checking
if ($qty < $incomingQty) {
     $responseObject->error = 'Qty invalid ';
     response_sender::sendJson($responseObject);
     die();
}

//add this product to the cart
$insertQuery = "INSERT INTO `card`(`qty`,`product_item_id`,`weight_id`,`extra_item_id`,`user_user_id`) VALUES (?,?,?,?,?) ";
$db->execute_query($insertQuery, 'sssss', array($incomingQty, $productItemId, $weightId, $extraItemId, $userId));
$responseObject->status = 'product added successfully';
response_sender::sendJson($responseObject);
