<?php
// Include models
require_once("../../backend/model/imageSearchEngine.php");
require_once("../../backend/model/response_sender.php");

// Response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// Usage
$directory = '../../resources/images/singleProductImg';
$productId = 122314522;
$weightId = 1;
$fileExtensions = ['png', 'jpeg', 'jpg'];

$fileSearch = new ImageSearch($directory, $productId, $weightId, $fileExtensions);
$searchResults = $fileSearch->search();

$responseArray = array();

if (is_array($searchResults)) {
     foreach ($searchResults as $index => $searchResult) {
          $resRowDetailObject = new stdClass();
          $resRowDetailObject->{"images[$index]"} = $searchResult;
          array_push($responseArray, $resRowDetailObject);
     }

     $responseObject->status = 'success';
     $responseObject->result = $responseArray;
} else {
     $responseObject->error = 'error';
     $responseObject->result = $searchResults;
}

// Send the JSON response after processing all search results
response_sender::sendJson($responseObject);
