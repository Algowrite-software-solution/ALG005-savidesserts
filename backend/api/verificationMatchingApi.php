<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");

//response sending object
$response = new stdClass();
$response->status = "error";

//is checking email
if (!isset($_POST['email']) || !isset($_POST['verification_id'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
     die();
}
//match user verification_id in database
$db = new database_driver();
$searchQuery = "SELECT `confomation_code` FROM `user` WHERE `email`=?";
$resultSet = $db->execute_query($searchQuery, 's', array($_POST['email']));

//query result
if (!$resultSet['result']->fetch_assoc()) {
     $response->error = "no result";
     response_sender::sendJson($response);
     die();
}
$row = $resultSet['result']->fetch_assoc();

//check db confomation code and user code
if ($row != $_POST['verification_id']) {
     $response->error = "invalid code";
     response_sender::sendJson($response);
} else {
     $response->status = "success";
     response_sender::sendJson($response);
}
