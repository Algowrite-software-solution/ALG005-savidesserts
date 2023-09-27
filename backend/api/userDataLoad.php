<?php

// all user data load
// by kavindu sasanka
// version - 1.0.1
// 25-09-2023


//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

// headers
header("Content-Type: application/json; charset=UTF-8");


//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

// db connection
$db = new database_driver();

$search_quary = "SELECT * FROM `user` INNER JOIN `delivery_details` ON `user`.`status_id` = `delivery_details`.`id` INNER JOIN `city` ON `delivery_details`.`city_id`=`city`.`id`";
$resultSet = $db->query($search_quary);

$responseResultArray = [];
for ($i = 0; $i < $resultSet->num_rows; $i++) {
    $result = $resultSet->fetch_assoc();
    array_push($responseResultArray, $result);
}

$responseObject->status = "success";
$responseObject->results = $responseResultArray;
response_sender::sendJson($responseObject);


