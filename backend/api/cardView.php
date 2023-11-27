<?php

// cart item load api
// by madusha pravinda
// version - 1.0.2
// 03-09-2023


//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");
require_once("../model/imageSearchEngine.php");

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

// image manager
$directory = '../../resources/images/singleProductImg';
$fileExtensions = ['png', 'jpeg', 'jpg'];

//search card data
$db = new database_driver();

$searchQuery = "SELECT c.id AS card_id, c.qty AS card_qty, ct.id AS category_id, ct.*, `product`.*, w.*, i.id AS product_item_id, i.price AS product_item_price, i.*, w.id AS weight_id, e.id AS extra_id, e.price AS extra_price, e.fruit AS extra_fruit FROM `card` AS c
INNER JOIN `product` ON `product`.`product_id` = `c`.`product_product_id` 
INNER JOIN `weight` AS w ON `w`.`id` = `c`.`weight_id` 
INNER JOIN `extra` AS e ON `e`.`id` = `c`.`extra_id`
INNER JOIN `product_item` AS i ON `i`.`product_product_id` = `c`.`product_product_id` AND `i`.`weight_id` = `c`.`weight_id` 
INNER JOIN `category` AS ct ON `ct`.`id` = `product`.`category_id`
WHERE `user_user_id` = ?";


$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->card_id = $row['card_id'];
          $resRowDetailObject->weight_id = $row['weight_id'];
          $resRowDetailObject->weight = $row['weight'];
          $resRowDetailObject->qty = $row['card_qty'];
          $resRowDetailObject->product_item_id = $row['product_item_id'];
          $resRowDetailObject->price = $row['product_item_price'];
          $resRowDetailObject->product_id = $row['product_id'];
          $resRowDetailObject->extra_price = $row['extra_price'];
          $resRowDetailObject->extra_id = $row['extra_id'];
          $resRowDetailObject->extra_fruit = $row['extra_fruit'];
          $resRowDetailObject->product_name = $row['product_name'];
          $resRowDetailObject->category_id = $row['category_id'];
          $resRowDetailObject->category_name = $row['category_type'];


          $searchResult = new ImageSearch($directory, $row['product_id'], $row['weight_id'], $fileExtensions);
          $relatedImage = $searchResult->search();

          if (is_array($relatedImage)) {
               $resRowDetailObject->image = $relatedImage[1];
          }

          array_push($responseArray, $resRowDetailObject);
          // array_push($responseArray, $row);
     }

     printf("", $responseArray);

     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $responseObject->status = 'no row data';
     $responseObject->response = null;
     response_sender::sendJson($responseObject);
}
