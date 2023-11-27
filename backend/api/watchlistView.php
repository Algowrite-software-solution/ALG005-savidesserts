<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");
require_once("../model/imageSearchEngine.php");


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
// image manager
$directory = '../../resources/images/singleProductImg';
$fileExtensions = ['png', 'jpeg', 'jpg'];


$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//search card data
$db = new database_driver();
// $searchQuery = "SELECT w.id AS watchlist_id, w.product_item_id AS watchlist_product_item_id, i.id, i.product_product_id FROM `watchlist` AS w 
// INNER JOIN `product_item` AS i ON w.product_item_id = i.id WHERE w.user_user_id = ?";

$searchQuery = "SELECT wt.id AS `watchlist_id`, wt.*, i.id AS `product_item_id`, i.*, c.id AS `category_id`, c.*, p.*, w.id AS `weight_id`, w.* FROM `watchlist` AS wt 
INNER JOIN `product` AS `p` ON `wt`.`product_product_id`=`p`.`product_id` 
INNER JOIN `weight` AS `w` ON `wt`.`weight_id` = `w`.`id`
INNER JOIN `product_item` AS `i` ON `i`.`product_product_id` = `wt`.`product_product_id` AND `i`.`weight_id`=`wt`.`weight_id`
INNER JOIN `category` AS `c` ON `p`.`category_id`=`c`.`id`
WHERE  `user_user_id`=?";
$resultSet = $db->execute_query($searchQuery, 's', array($userId));

//result and stmt
$result = $resultSet['result'];

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->watchlist_id = $row['watchlist_id'];
          $resRowDetailObject->product_item_id = $row['product_item_id'];
          $resRowDetailObject->product_id = $row['product_product_id'];
          $resRowDetailObject->product_name = $row['product_name'];
          $resRowDetailObject->category_type = $row['category_type'];
          $resRowDetailObject->price = $row['price'];
          $resRowDetailObject->weight = $row['weight'];
          $resRowDetailObject->weight_id = $row['weight_id'];

          $searchResult = new ImageSearch($directory, $row['product_product_id'], $row['weight_id'], $fileExtensions);
          $relatedImage = $searchResult->search();

          if (is_array($relatedImage)) {
               $resRowDetailObject->image = $relatedImage[1];
          }


          array_push($responseArray, $resRowDetailObject);
          // array_push($responseArray, $row);
     }

     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {

     $responseObject->status = 'no row data';
     $responseObject->response = null;
     response_sender::sendJson($responseObject);
}
