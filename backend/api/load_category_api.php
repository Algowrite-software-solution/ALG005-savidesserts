<?php
// load category api
// by janith nirmal
// version - 1.0.2 (updated - 20-09-2023)
// developed - 03-09-2023

require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/RequestHandler.php");

header("Content-Type: application/json; charset=UTF-8");

//responseObject sending object
$responseObject = new stdClass();
$responseObject->status = "failed";

// request handling  layer
if (!RequestHandler::isGetMethod()) {
    $responseObject->error = "invalid request";
    response_sender::sendJson($responseObject); // end the process if request method is invalid
}

$limit = (!empty($_GET['limit'])) ? $_GET['limit'] : 15; // defult limit

// input validation layer
$validateReadyObject = (object) [
    "id_int" => [
        (object) ["datakey" => "limit", "value" => $limit]
    ],
];
$validator = new data_validator($validateReadyObject);
$errors = $validator->validate(); // validate
foreach ($errors as $key => $value) {
    if ($value) {
        $responseObject->error = "Invalid Input for : " . $key;
        response_sender::sendJson($responseObject); // end process if error for an input data
    }
}

// database call
$database = new database_driver();
$searchQuery = "SELECT * FROM `category` LIMIT ? ";
$db_response = $database->execute_query($searchQuery, "i", [$limit]);
$resultSet = $db_response["result"];

// response preparing
$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $result = $resultSet->fetch_assoc();
    array_push($responseResultArray, $result);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);
