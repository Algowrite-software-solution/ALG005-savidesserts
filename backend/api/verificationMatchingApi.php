<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

//response sending object
$response = new stdClass();
$response->status = "failed";

//is checking email
if (!isset($_POST['email']) || !isset($_POST['verification_id'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
}
//match user verification_id in database
$db = new database_driver();
$searchQuery = "SELECT * FROM `user` WHERE `email`=?";
$resultSet = $db->execute_query($searchQuery, 's', array($_POST['email']));

$rowResult =  $resultSet['result'];

//query result
if ($rowResult->num_rows != 1) {
     $response->error = "email does not match";
     response_sender::sendJson($response);
}

$row = $rowResult->fetch_assoc();

//check db confomation code and user code
if ($row['confomation_code'] != $_POST['verification_id']) {
     $response->error = "invalid code";
     response_sender::sendJson($response);
} else {
     $response->status = "success";
     response_sender::sendJson($response);
}
