<?php

// all user status change
// by kavindu sasanka
// version - 1.0.0
// 25-09-2023


//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

// headers
header("Content-Type: application/json; charset=UTF-8");


//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

$user_id = $_GET["id"];

// check user id
if(empty($user_id)){
    $responseObject->status = "empty user id";
    response_sender::sendJson($responseObject);
}

// db connection
$db = new database_driver();

$update_query = "UPDATE `user` SET `status_id`= '3'  WHERE `user_id`=?";
$db->execute_query($update_query,'i',array($user_id));


$responseObject->status = "Updated";
response_sender::sendJson($responseObject);
