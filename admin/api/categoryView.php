<?php

//category view API
//by madusha pravinda
//version - 1.0.1
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/fileSearch.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();

$searchQuery = "SELECT * FROM `category`";
$resultSet = $db->query($searchQuery);
// $result = $resultSet['result'];

$responseArray = array();

// image manager
$directory = '../../resources/images/categoryImages';
$fileExtensions = ['png', 'jpeg', 'jpg'];

// ...
// ...
if ($resultSet->num_rows > 0) {

     $groupedResults = []; // Create an array to group results

     while ($rowData = $resultSet->fetch_assoc()) {
          $categoryType = $rowData['category_type']; // Use categoryName instead of category_type

          $fileSearch = new FileSearch($directory, $categoryType, $fileExtensions); // Use categoryName as the search parameter

          $searchResults = $fileSearch->search();

          $resRowDetailObject = new stdClass();

          $resRowDetailObject->category_id = $rowData['id'];
          $resRowDetailObject->category_type = $categoryType; // Use categoryName

          if (is_array($searchResults)) {
               foreach ($searchResults as $searchResult) {
                    $resRowDetailObject->category_image = $searchResult;
               }
          } else {
               $responseObject->error = $searchResults;
               response_sender::sendJson($responseObject);
          }

          array_push($responseArray, $resRowDetailObject);
     }
     $responseObject->status = 'success';
     $responseObject->results = $responseArray;
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'no row data';
     response_sender::sendJson($responseObject);
}
 // ...
