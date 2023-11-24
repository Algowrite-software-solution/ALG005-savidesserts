<?php
//product Item Load API
//by madusha pravinda
//version - 1.0.2
//02-10-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/imageSearchEngine.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->error = 'Please LogIn';
    response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();
$productItemSearchQuery = "SELECT *, `product_item`.`id` as `product_item_id` FROM `product_item` 
INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id`
INNER JOIN `product_status` ON `product_item`.`product_status_id`=`product_status`.`id`
INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` WHERE `is_deleted` = '0' ";
$resultSet = $db->query($productItemSearchQuery);

//get all product item data
$responseArray = array();


// image manager
$directory = '../../resources/images/singleProductImg';
$fileExtensions = ['png', 'jpeg', 'jpg'];

// ...
if ($resultSet->num_rows > 0) {
    $groupedResults = []; // Create an array to group results

    while ($rowData = $resultSet->fetch_assoc()) {
        $productId = $rowData['product_product_id'];
        $weightId = $rowData['weight_id'];

        $fileSearch = new ImageSearch($directory, $productId, $weightId, $fileExtensions);
        $searchResults = $fileSearch->search();

        // Create a new object for each product item
        $resRowDetailObject = new stdClass();
        $resRowDetailObject->product_item_id = $rowData['product_item_id'];
        $resRowDetailObject->qty = $rowData['qty'];
        $resRowDetailObject->price = $rowData['price'];
        $resRowDetailObject->product_status_id = $rowData['product_status_id'];
        $resRowDetailObject->type = $rowData['type'];
        $resRowDetailObject->product_name = $rowData['product_name'];
        $resRowDetailObject->weight = $rowData['weight'];
        $resRowDetailObject->product_id = $productId;
        $resRowDetailObject->weight_id = $weightId;


        $imageArray = array();
        // Add images to the new object if available
        if (is_array($searchResults)) {
            foreach ($searchResults as $index => $searchResult) {
                // $resRowDetailObject->{"images[$index]"} = $searchResult;
                array_push($imageArray, $searchResult);
            }
        }
        $resRowDetailObject->images = $imageArray;

        // Check if there's an existing object with the same productId and weightId
        $key = "{$productId}_{$weightId}";
        if (!isset($groupedResults[$key])) {
            $groupedResults[$key] = $resRowDetailObject;
        } else {
            // Merge images into the existing object
            $existingObject = $groupedResults[$key];
            foreach ($resRowDetailObject as $property => $value) {
                // Skip merging productId and weightId properties
                if ($property !== 'product_id' && $property !== 'weight_id') {
                    $existingObject->$property = $value;
                }
            }
        }
    }

    // Convert groupedResults associative array to a numeric array
    $responseArray = array_values($groupedResults);

    $responseObject->status = 'success';
    $responseObject->results = $responseArray;
    response_sender::sendJson($responseObject);
} else {
    $responseObject->error = 'no row data';
    $responseObject->results = []; // Ensure result is an empty array
    response_sender::sendJson($responseObject);
}
 // ...
