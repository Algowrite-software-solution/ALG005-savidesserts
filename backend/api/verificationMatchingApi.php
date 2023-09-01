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
}
//match user verification_id in database
$db = new database_driver();
$searchQuery = "SELECT `confomation_code` FROM `user` WHERE `email`=?";
$db->execute_query($searchQuery,'s',$_POST['email']);


