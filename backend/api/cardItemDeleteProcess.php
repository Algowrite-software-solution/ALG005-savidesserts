<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/user_access_updater.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check card_id 
if (!$_POST['card_id']) {
     $responseObject->error = "Access denied";
     response_sender::sendJson($responseObject);
     die();
}

//check is login user
$userCheckSession = new UseerAccess();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
     die();
}

//database object
$db = new database_driver();
$card_id = $_POST['card_id'];
$deleteQuery = "DELETE FROM `card` WHERE `card_id`=?";
$db->execute_query($deleteQuery, 's', $card_id);
$responseObject->error = "Delete successfully";
response_sender::sendJson($responseObject);
