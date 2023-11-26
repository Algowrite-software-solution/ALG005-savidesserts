<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//access check
if (!isset($_POST['product_id'])) {
     $responseObject->error = "Access denied";
     response_sender::sendJson($responseObject);
}

$productId = $_POST['product_id'];

$stock = 1;
//database object
$db = new database_driver();
$searchQuery = "SELECT * FROM `extra_item` 
INNER JOIN `extra` ON `extra_item`.`extra_id`=`extra`.`id` 
WHERE `product_product_id`=? AND `extra`.`extra_status_id`=? ";
$resultSet = $db->execute_query($searchQuery, 'si', array($productId, $stock));

//result
$result = $resultSet['result'];

//fetch all result
$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->extra_id = $row['id'];
          $resRowDetailObject->extra_fruit = $row['fruit'];
          $resRowDetailObject->price = $row['price'];

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
