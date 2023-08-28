<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

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
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->promotion_id = $row['promotion_id'];
          $resRowDetailObject->start_date_time = $row['start_date_time'];
          $resRowDetailObject->end_date_time = $row['end_date_time'];
          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->response = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->status = 'no results';
     response_sender::sendJson($responseObject);
     die();
}
