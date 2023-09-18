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
$searchQuery = "SELECT w.id AS watchlist_id, w.product_item_id AS watchlist_product_item_id, i.id, i.product_product_id FROM `watchlist` AS w 
INNER JOIN `product_item` AS i ON w.product_item_id = i.id WHERE w.user_user_id = ?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->watchlist_id = $row['watchlist_id'];
          $resRowDetailObject->product_item_id = $row['watchlist_product_item_id'];
          $resRowDetailObject->product_id = $row['product_product_id'];

          $searchProductNamesQuery = "SELECT * FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` WHERE `product_id`=? ";
          $productAndCategoryresult = $db->execute_query($searchProductNamesQuery, 's', array($row['product_product_id']));

          $productAndCategory = $productAndCategoryresult['result'];
          $pcRow = $productAndCategory->fetch_assoc();
          $resRowDetailObject->product_name = $pcRow['product_name'];
          $resRowDetailObject->category_type = $pcRow['category_type'];

          $searchProductItemAndPrice = "SELECT * FROM `product_item` AS `pi` INNER JOIN `weight` AS `w` ON `pi`.`weight_id`=`w`.`id` WHERE `pi`.`id`=?";
          $searchProductItemAndPriceresult = $db->execute_query($searchProductItemAndPrice, 's', array($row['watchlist_product_item_id']));

          $productItemAndPrice = $searchProductItemAndPriceresult['result'];
          $ppRow = $productItemAndPrice->fetch_assoc();
          $resRowDetailObject->price = $ppRow['price'];
          $resRowDetailObject->weight = $ppRow['weight'];

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
