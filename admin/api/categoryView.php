<?php

//category view API
//by madusha pravinda
//version - 1.0.1
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

//chekcing is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->status = 'Please LogIn';
     response_sender::sendJson($responseObject);
}
//database object
$db = new database_driver();

$searchQuery = "SELECT * FROM `category`";
$resultSet = $db->query($searchQuery);
// $result = $resultSet['result'];

$responseArray = array();

if ($resultSet->num_rows > 0) {
     while ($rowData = $resultSet->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->category_id = $rowData['id'];
          $resRowDetailObject->category_type = $rowData['category_type'];

          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->result = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->status = 'no row data';
     $responseObject->result = null;
     response_sender::sendJson($responseObject);
}
