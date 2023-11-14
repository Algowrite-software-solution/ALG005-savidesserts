<?php
// all user status change
// by kavindu sasanka
// version - 1.0.1
// 25-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");


//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';


// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
    $responseObject->error = 'Please LogIn';
    response_sender::sendJson($responseObject);
}


$user_id = ($_GET["u_id"]) ?? null;
$status_id = ($_GET["s_id"]) ?? null;


// check user id and ststus id
if (empty($user_id)) {
    $responseObject->error = "empty user id";
    response_sender::sendJson($responseObject);
} else if (empty($status_id)) {
    $responseObject->error = "empty status id";
    response_sender::sendJson($responseObject);
}


// db connection
$db = new database_driver();
$update_query = "UPDATE `user` SET `status_id`= ?  WHERE `user_id`=?";
$db->execute_query($update_query, 'ii', array($status_id, $user_id));


$responseObject->status = "success";
response_sender::sendJson($responseObject);
