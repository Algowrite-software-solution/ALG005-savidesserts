<?php

//extraItem view API
//by madusha pravinda
//version - 1.0.2 (last updated - 18-10-2023)
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}
//database object
$db = new database_driver();

$searchQuery = "SELECT * FROM `extra`";
$resultSet = $db->query($searchQuery);
// $result = $resultSet['result'];

$responseArray = array();

if ($resultSet->num_rows > 0) {
     while ($rowData = $resultSet->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->extra_id = $rowData['id'];
          $resRowDetailObject->extra_fruit = $rowData['fruit'];
          $resRowDetailObject->extra_status_id = $rowData['extra_status_id'];
          $resRowDetailObject->price = $rowData['price'];


          $searchExtraItem = "SELECT * FROM `extra_status` WHERE `id`=? ";
          $searchExtraItemResult = $db->execute_query($searchExtraItem, 's', array($rowData['extra_status_id']));

          $result = $searchExtraItemResult['result'];
          $extraItemRow = $result->fetch_assoc();
          $resRowDetailObject->extraItem_status_type = $extraItemRow['status'];


          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->results = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no row data';
     response_sender::sendJson($responseObject);
}
