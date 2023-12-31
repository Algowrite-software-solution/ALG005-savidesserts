<?php

// load single product api
// by janith nirmal
// version - 1.0.0
// developed - 06-09-2023

require_once("../model/data_validator.php");
require_once("../model/database_driver.php");
require_once("../model/AdvancedSearchEngine.php");
require_once("../model/response_sender.php");
require_once("../model/RequestHandler.php");
require_once("../model/imageSearchEngine.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

$responseObject = new stdClass();
$responseObject->status = "failed";

// validate request
if (RequestHandler::getMethodHasError("product_id")) {
    $responseObject->error = "Invalid Request";
    response_sender::sendJson($responseObject);
}
if (RequestHandler::getMethodHasError("weightId")) {
    $responseObject->error = "Invalid Request";
    response_sender::sendJson($responseObject);
}

// catch inputs
$id = (isset($_GET['product_id']) ? $_GET['product_id'] : null);
$weightId = (isset($_GET['weightId']) ? $_GET['weightId'] : null);

// validate input
$validateReadyObject = (object) [
    "id_int" => [
        (object) ["datakey" => "product_id", "value" => $id]
    ],
    "id_int" => [
        (object) ["datakey" => "weightId", "value" => $weightId]
    ]
];

$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
    if ($value) {
        $responseObject->error = "Invalid Input for : " . $key;
        response_sender::sendJson($responseObject);
    }
}

// search relevent data
$searchEngine = new AdvancedSearchEngine();
$results = $searchEngine->searchSingleProduct($id, $weightId);

$imageSearch = new ImageSearch("../../resources/images/singleProductImg/", $results["product_id"], $results["weight_id"], ["jpg"]);
$results["images"] = (is_array($imageSearch->search())) ? $imageSearch->search() : [];

// response
$responseObject->status = "success";
$responseObject->results = $results;
response_sender::sendJson($responseObject);
