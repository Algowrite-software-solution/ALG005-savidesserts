<?php

// load product list api
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
if (!RequestHandler::isGetMethod()) {
    $responseObject->error = "Invalid Request";
    response_sender::sendJson($responseObject);
}

// catch inputs
$search = (isset($_GET['search'])) ? $_GET['search'] : "";
$options = (isset($_GET['options'])) ? json_decode($_GET['options']) : (object) [];

// options validation
$category = '';
$orderBy = '';
$orderDirection = '';
$limit = '';
foreach ($options as $key => $value) {
    if ($key == "category") {
        $category = (!empty($value)) ? $value : "";
    } else if ($key == "orderBy") {
        $orderBy = (!empty($value)) ? $value : "price";
    } else if ($key == "orderDirection") {
        $orderDirection = (!empty($value)) ? $value : "high to low";
    } else if ($key == "limit") {
        $limit = (!empty($value))  ? $value : "10"; // default limit
    }
}


$validateReadyObject = (object) [
    "string_or_null" => [
        (object) ["datakey" => "search", "value" => $search],
        (object) ["datakey" => "category", "value" => $category],
        (object) ["datakey" => "orderBy", "value" => $orderBy],
        (object) ["datakey" => "orderDirection", "value" => $orderDirection]
    ],
    "int_or_null" => [
        (object) ["datakey" => "limit", "value" => $limit]
    ]
];
// validate input
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
$results = $searchEngine->searchProducts($search, $category, $orderBy, $orderDirection, $limit);

// response
$responseObject->status = "success";
$responseObject->results = $results;
response_sender::sendJson($responseObject);
