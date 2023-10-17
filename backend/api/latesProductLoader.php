<?php
//Invoice Details Viewing
//by Madusha Pravinda
//version - 1.0.1;a
//27-09-2023

//include models
require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/RequestHandler.php");
require_once("../model/imageSearchEngine.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = "failed";


$limit = (!empty($_GET['limit'])) ? $_GET['limit'] : 3; // defult limit


// image manager
$directory = '../../resources/images/singleProductImg';
$fileExtensions = ['png', 'jpeg', 'jpg'];

$validateReadyObject = (object) [
     "id_int" => [
          (object) ["datakey" => "limit", "value" => $limit]
     ],
];

//validation
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
     if ($value) {
          $responseObject->error = "Invalid Input for : " . $key;
          response_sender::sendJson($responseObject);
     }
}

//search query
$database = new database_driver();
$searchQuery = "SELECT * FROM `product_item` INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` INNER JOIN `weight` ON `weight`.`id`=`product_item`.`weight_id` LIMIT ? ";
$db_response = $database->execute_query($searchQuery, "i", [$limit]);
$resultSet = $db_response["result"];


$responseResultArray = [];

for ($i = 0; $i < $resultSet->num_rows; $i++) {
     
     $resRowDetailObject = new stdClass();

     $result = $resultSet->fetch_assoc();
     $resRowDetailObject->product_id = $result['product_product_id'];
     $resRowDetailObject->weight_id = $result['weight_id'];
     $resRowDetailObject->product_name = $result['product_name'];
     $resRowDetailObject->price = $result['price'];
     $resRowDetailObject->description = $result['product_description'];


     $searchResult = new ImageSearch($directory, $result['product_product_id'], $result['weight_id'], $fileExtensions);
     $relatedImage = $searchResult->search();

     if (is_array($relatedImage)) {
          $resRowDetailObject->image = $relatedImage[1];
     }

     array_push($responseResultArray, $resRowDetailObject);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);
