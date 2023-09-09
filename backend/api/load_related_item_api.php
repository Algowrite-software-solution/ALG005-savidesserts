<?php
// load related items api
// by janith nirmal
// version - 1.0.0 
// developed - 06-09-2023

require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/RequestHandler.php");
require_once("../model/SuggestionLoader.php");

header("Content-Type: application/json; charset=UTF-8");

//responseObject sending object
$responseObject = new stdClass();
$responseObject->status = "failed";

//handle the request
if (RequestHandler::getMethodHasError("search")) {
    $responseObject->error = "invalid request";
    response_sender::sendJson($responseObject);
}

$search = (!empty($_GET['search'])) ? $_GET['search'] : ""; // defult search


$validateReadyObject = (object) [
    "string_or_null" => [
        (object) ["datakey" => "search", "value" => $search]
    ],
];
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
    if ($value) {
        $responseObject->error = "Invalid Input for : " . $key;
        response_sender::sendJson($responseObject);
    }
}

$resultSet = new SuggestionLoader();
$results = $resultSet->getSuggestions($search);

$responseObject->status = "success";
$responseObject->results = $results;
response_sender::sendJson($responseObject);
