<?php
//product Item Load API
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
// $userCheckSession = new SessionManager();
// if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
//      $responseObject->error = 'Please LogIn';
//      response_sender::sendJson($responseObject);
// }

//database object
$db = new database_driver();
$productItemSearchQuery = "SELECT * FROM `product_item`";
$resultSet = $db->query($productItemSearchQuery);

//get all product item data
$responseArray = array();

if ($resultSet->num_rows > 0) {
     while ($rowData = $resultSet->fetch_assoc()) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->product_item_id = $rowData['id'];
          $resRowDetailObject->qty = $rowData['qty'];
          $resRowDetailObject->price = $rowData['price'];
          $resRowDetailObject->product_status_id = $rowData['product_status_id'];
          $resRowDetailObject->product_id = $rowData['product_product_id'];
          $resRowDetailObject->weight_id = $rowData['weight_id'];

          //product status search
          $searchProductStatus = "SELECT * FROM `product_status` WHERE `id`=? ";
          $searchProductStatusResult = $db->execute_query($searchProductStatus, 's', array($rowData['product_status_id']));

          $resultStatus = $searchProductStatusResult['result'];
          $itemStatusRow = $resultStatus->fetch_assoc();
          $resRowDetailObject->category_type = $itemStatusRow['type'];

          //weight search
          $searchWeight = "SELECT * FROM `weight` WHERE `id`=? ";
          $searchWeightResult = $db->execute_query($searchWeight, 's', array($rowData['weight_id']));

          $resultWeight = $searchWeightResult['result'];
          $itemWeightRow = $resultWeight->fetch_assoc();
          $resRowDetailObject->weight = $itemWeightRow['weight'];

          //product search
          $searchProduct = "SELECT * FROM `product` WHERE `product_id`=? ";
          $searchProductResult = $db->execute_query($searchProduct, 's', array($rowData['product_product_id']));

          $resultProduct = $searchProductResult['result'];
          $itemProductRow = $resultProduct->fetch_assoc();
          $resRowDetailObject->product_name = $itemProductRow['product_name'];

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
