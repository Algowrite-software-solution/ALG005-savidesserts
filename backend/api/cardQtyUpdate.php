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

//if check JSON object
if (!isset($_POST['cardQtyUpdate'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
     die();
}
//destruction JSON object
$cardQtyUpdateData = json_decode($_POST['cardQtyUpdate']);
$cardId = $cardQtyUpdateData->cardId;
$productItemId = $cardQtyUpdateData->productItemId;
$incomingQty = $cardQtyUpdateData->qty;
$weightId = $cardQtyUpdateData->weightId;

//qty validation
$db = new database_driver();
$searchQuery = "SELECT qty FROM `product_item` WHERE `id`=? AND `weight_id`=?";
$resultSet = $db->execute_query($searchQuery, 'ss', array($productItemId, $weightId));

//result and stmt
$result = $resultSet['result'];

//fetch related data
$qty = $result->fetch_assoc();

//qty checking
if ($qty['qty'] < $incomingQty || $incomingQty <= 0) {
     $responseObject->error = 'Qty invalid ';
     response_sender::sendJson($responseObject);
     die();
} else {
     //update qty
     $updateQuery = "UPDATE `card` SET `qty`=? WHERE `id`=? AND `user_user_id`=?";
     $db->execute_query($updateQuery, 'sss', array($incomingQty, $cardId, $userId));
     $responseObject->status = 'Updated';
     response_sender::sendJson($responseObject);
}
