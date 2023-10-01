<?php
//product View API
//by madusha pravinda
//version - 1.0.0
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

// chekcing is user logging
$userCheckSession = new SessionManager();
// if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
//      $responseObject->error = 'Please LogIn';
//      response_sender::sendJson($responseObject);
// }

//database object
$db = new database_driver();

//search all product
$searchQuery = "SELECT * FROM `product`";
$resultSet = $db->query($searchQuery);


$responseArray = array();

if ($resultSet->num_rows > 0) {
     while ($rowData = $resultSet->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->product_id = $rowData['product_id'];
          $resRowDetailObject->product_name = $rowData['product_name'];
          $resRowDetailObject->product_description = $rowData['product_description'];
          $resRowDetailObject->category_id = $rowData['category_id'];
          $resRowDetailObject->add_date = $rowData['add_date'];


          $searchCategory = "SELECT * FROM `category` WHERE `id`=? ";
          $searchCategoryResult = $db->execute_query($searchCategory, 's', array($rowData['category_id']));

          $result =$searchCategoryResult['result'];
          $categoryItemRow = $result->fetch_assoc();
          $resRowDetailObject->category_type = $categoryItemRow['category_type'];


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
