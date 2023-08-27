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
$searchQuery = "SELECT w.id AS watchlist_id, w.product_item_id AS watchlist_product_item_id, i.id, i.product_product_id FROM `watchlist` AS w 
INNER JOIN `product_item` AS i ON w.product_item_id = i.id WHERE w.user_user_id = ?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];
$stmt = $queryResult['stmt'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->watchlist_id = $row['watchlist_id'];
          $resRowDetailObject->product_item_id = $row['product_item_id'];
          $resRowDetailObject->product_id = $row['product_product_id'];

          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $responseObject->status = 'no row data';
     response_sender::sendJson($responseObject);
}