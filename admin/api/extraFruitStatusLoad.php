<?php

//extra fruit Status Table load API
//by Madusha Pravinda
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
$responseObject->status = 'failed';

// checking is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();

// data insert
$extraStatusSearch = "SELECT * FROM `extra_status`";
$result = $db->query($extraStatusSearch);

$responseArray = array();

if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->extra_status_id = $row['id'];
          $resRowDetailObject->extra_status = $row['status'];

          array_push($responseArray, $resRowDetailObject);
     }

     $responseObject->status = 'success';
     $responseObject->results = $responseArray;
     response_sender::sendJson($responseObject);
}
