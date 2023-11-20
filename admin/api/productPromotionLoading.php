<?php
// /include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

//search promotion in database 
$db = new database_driver();
$searchQuery = "SELECT * FROM `promotion` 
INNER JOIN `product` ON `promotion`.`product_product_id`=`product`.`product_id`
INNER JOIN `promotion_status` ON `promotion`.`promotion_status_promotion_status_id`=`promotion_status`.`promotion_status_id`
INNER JOIN `weight` ON `promotion`.`weight_id`=`weight`.`id` ORDER BY `end_date_time` DESC";
$queryResult = $db->query($searchQuery);

//get results
$responseArray = array();
if ($queryResult->num_rows > 0) {
     foreach ($queryResult as $row) {
          array_push($responseArray, $row);
     }
     $responseObject->status = 'success';
     $responseObject->results = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no result';
     response_sender::sendJson($responseObject);
}
