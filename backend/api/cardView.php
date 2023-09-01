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

//search card data
$db = new database_driver();
$searchQuery = "SELECT c.id AS card_id, c.product_item_id, c.weight_id AS card_weight_id, c.qty, c.extra_item_id, w.id, w.weight, e.id, e.extra_id, i.id, i.product_product_id FROM `card` AS c 
INNER JOIN `product_item` AS i ON c.product_item_id = i.id  
INNER JOIN `weight` AS w ON  c.weight_id = w.id
INNER JOIN `extra_item` AS e ON c.extra_item_id = e.id WHERE c.user_user_id = ?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];
$stmt = $queryResult['stmt'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->card_id = $row['card_id'];
          $resRowDetailObject->weight_id = $row['card_weight_id'];
          $resRowDetailObject->weight = $row['weight'];
          $resRowDetailObject->qty = $row['qty'];
          $resRowDetailObject->product_item_id = $row['product_item_id'];
          $resRowDetailObject->product_id = $row['product_product_id'];
          $resRowDetailObject->extra_item_id = $row['extra_item_id'];
          $resRowDetailObject->extra_id = $row['extra_id'];

          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $responseObject->status = 'no row data';
     response_sender::sendJson($responseObject);
}
