<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';


//check is login user
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please login';
     response_sender::sendJson($responseObject);
   
}
$userData = $userCheckSession->getUserId();
$userId = $userData["user_id"];

//check card_id 
if (!isset($_POST['watchlist_id'])) {
     $responseObject->error = "Access denied";
     response_sender::sendJson($responseObject);
    
}



//database object
$db = new database_driver();
$watchlist = $_POST['watchlist_id'];
$deleteQuery = "DELETE FROM `watchlist` WHERE `id`=? AND `user_user_id`=?";
$db->execute_query($deleteQuery, 'ss', array($watchlist,$userId));
$responseObject->status = "Delete successfully";
response_sender::sendJson($responseObject);
