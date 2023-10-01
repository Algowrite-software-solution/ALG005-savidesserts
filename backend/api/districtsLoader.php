<?php
// /include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

$limit = (!empty($_GET['limit'])) ? $_GET['limit'] : 25;

//database object
$db = new database_driver();
$searchQuery = "SELECT * FROM `distric` LIMIT ? ";
$db_response = $db->execute_query($searchQuery, 'i', [$limit]);
$resultSet = $db_response["result"];

$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
     $result = $resultSet->fetch_assoc();
     array_push($responseResultArray, $result);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);
