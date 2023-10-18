<?php
// load category api
// by janith nirmal
// version - 1.0.1 (updated - 06-09-2023)
// developed - 03-09-2023

require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/RequestHandler.php");
require_once("../model/fileSearch.php");

header("Content-Type: application/json; charset=UTF-8");

//responseObject sending object
$responseObject = new stdClass();
$responseObject->status = "failed";

//handle the request
if (!RequestHandler::isGetMethod()) {
    $responseObject->error = "invalid request";
    response_sender::sendJson($responseObject);
}

$limit = (!empty($_GET['limit'])) ? $_GET['limit'] : 15; // defult limit


// image manager
$directory = '../../resources/images/categoryImages';
$fileExtensions = ['png', 'jpeg', 'jpg'];

$validateReadyObject = (object) [
    "id_int" => [
        (object) ["datakey" => "limit", "value" => $limit]
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

$database = new database_driver();
$searchQuery = "SELECT * FROM `category` LIMIT ? ";
$db_response = $database->execute_query($searchQuery, "i", [$limit]);
$resultSet = $db_response["result"];

$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $result = $resultSet->fetch_assoc();

    $fileSearch = new FileSearch($directory, $result['category_type'], $fileExtensions); // Use categoryName as the search parameter

    $searchResults = $fileSearch->search();

    $resRowDetailObject = new stdClass();

    $resRowDetailObject->category_id = $result['id'];
    $resRowDetailObject->category_type = $result['category_type'];

    if (is_array($searchResults)) {
        foreach ($searchResults as $searchResult) {
            $resRowDetailObject->category_image = $searchResult;
        }
    } else {
        $responseObject->error = $searchResults;
        response_sender::sendJson($responseObject);
    }





    array_push($responseResultArray, $resRowDetailObject);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);
