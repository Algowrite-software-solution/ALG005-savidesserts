<?php

// cart item load api
// by madusha pravinda
// version - 1.0.2
// 03-09-2023


//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

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

//search card data
$db = new database_driver();
$searchQuery = "SELECT c.id AS card_id, c.product_item_id, c.weight_id AS card_weight_id, c.qty, c.extra_id, w.id, w.weight, e.id, e.price AS extra_price, e.fruit, i.id, i.product_product_id,i.price FROM `card` AS c 
INNER JOIN `product_item` AS i ON c.product_item_id = i.id  
INNER JOIN `weight` AS w ON  c.weight_id = w.id
INNER JOIN `extra` AS e ON c.extra_id = e.id WHERE c.user_user_id = ?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->card_id = $row['card_id'];
          $resRowDetailObject->weight_id = $row['card_weight_id'];
          $resRowDetailObject->weight = $row['weight'];
          $resRowDetailObject->qty = $row['qty'];
          $resRowDetailObject->product_item_id = $row['product_item_id'];
          $resRowDetailObject->price = $row['price'];
          $resRowDetailObject->product_id = $row['product_product_id'];
          $resRowDetailObject->extra_price = $row['extra_price'];
          $resRowDetailObject->extra_id = $row['extra_id'];
          $resRowDetailObject->extra_fruit = $row['fruit'];

          $searchProductNamesQuery = "SELECT * FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` WHERE `product_id`=? ";
          $productAndCategoryresult = $db->execute_query($searchProductNamesQuery, 's', array($row['product_product_id']));

          $productAndCategory = $productAndCategoryresult['result'];
          $pcRow = $productAndCategory->fetch_assoc();
          $resRowDetailObject->product_name = $pcRow['product_name'];
          $resRowDetailObject->category_type = $pcRow['category_type'];

          // $extraItemSearchQuery = "SELECT `extra_fruit` FROM `extra` WHERE `id`=?";
          // $extraItemName = $db->execute_query($extraItemSearchQuery, 's', array($row['extra_id']));

          // $extraItem = $extraItemName['result'];
          // $exRow = $extraItem->fetch_assoc();
          // $resRowDetailObject->extra_fruit_name = $exRow['extra_fruit'];

          array_push($responseArray, $resRowDetailObject);
     }

     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $responseObject->status = 'no row data';
     $responseObject->response = null;
     response_sender::sendJson($responseObject);
}
