<?php
//Invoice Item Details Viewing
//by Madusha Pravinda
//version - 1.0.1;a
//27-09-2023

//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = "failed";

$orderId = $_POST['order_id'];

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
}

//load invoice details
$db = new database_driver();

$query = "SELECT ii.*, pi.*, ex.*, w.*, p.*, ii.qty AS invoice_item_qty FROM `invoice_item` AS `ii` INNER JOIN `product_item` AS `pi` ON `ii`.`product_item_id`= `pi`.`id` INNER JOIN `extra` AS `ex` ON `ii`.`extra_id`=`ex`.`id` INNER JOIN `weight` AS `w` ON `ii`.`weight_id`=`w`.`id` INNER JOIN `product` AS `p` ON `pi`.`product_product_id`=`p`.`product_id` WHERE `order_id`=? ";
$resultSet = $db->execute_query($query, 's', array($orderId));

$dataObjectsArray = [];
if ($resultSet['result']->num_rows > 0) {
     while ($rows = $resultSet['result']->fetch_assoc()) {

          array_push($dataObjectsArray, $rows);
     }

     $responseObject->status = 'success';
     $responseObject->result = $dataObjectsArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no row data';
     response_sender::sendJson($responseObject);
}
