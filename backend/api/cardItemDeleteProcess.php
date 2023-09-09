<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//check card_id 
if (!isset($_POST['card_id'])) {
     $responseObject->error = "Access denied";
     response_sender::sendJson($responseObject);
     die();
}

//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
     die();
}

//database object
$db = new database_driver();
$card_id = $_POST['card_id'];
$deleteQuery = "DELETE FROM `card` WHERE `id`=?";
$db->execute_query($deleteQuery, 's', array($card_id));
$responseObject->status = "Delete successfully";
response_sender::sendJson($responseObject);
