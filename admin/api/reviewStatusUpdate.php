<?php
//dev by madusha
//dev date = 2023/11/27
//version =  1.0.0

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
require_once("../../backend/model/data_validator.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

// validate request
if (!RequestHandler::isPostMethod()) {
       $responseObject->error = "Invalid Request";
       response_sender::sendJson($responseObject);
}

//check is login user
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
       $responseObject->error = 'Please Sign In';
       response_sender::sendJson($responseObject);
}

//status id
$statusId = $_POST['rv_status_id'];
$reviewId = $_POST['rev_id'];

//database
$db = new database_driver();
$updateQuery = "UPDATE `reviews` SET `review_status_id`=? WHERE `rev_id`=?";
$db->execute_query($updateQuery, 'ii', array($statusId, $reviewId));
$responseObject->status = "success";
response_sender::sendJson($responseObject);
