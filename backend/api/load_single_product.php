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

// headers
header("Content-Type: application/json; charset=UTF-8");

$responseObject = new stdClass();
$responseObject->status = "failed";

// validate request
if (RequestHandler::getMethodHasError("product_id")) {
    $responseObject->error = "Invalid Request";
    response_sender::sendJson($responseObject);
}

// catch inputs
$id = (isset($_GET['product_id']) ? $_GET['product_id'] : null);

// validate input
$validateReadyObject = (object) [
    "id_int" => [
        (object) ["datakey" => "product_id", "value" => $id]
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
$results = $searchEngine->searchSingleProduct($id);

// response
$responseObject->status = "success";
$responseObject->results = $results;
response_sender::sendJson($responseObject);
