<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//search promotion in database   if available == 1
$db = new database_driver();
$promotionStatus = '1';
$searchQuery = "SELECT * FROM `promotion` WHERE `promotion_status_promotion_status_id`=?";
$queryResult = $db->execute_query($searchQuery, 's', array($promotionStatus));

//get results
$responseArray = array();
if ($queryResult['result']->num_rows > 0) {
     foreach ($queryResult['result'] as $row) {
          array_push($responseArray, $row);
     }
     $responseObject->status = 'success';
     $responseObject->result = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no result';
     response_sender::sendJson($responseObject);
}
