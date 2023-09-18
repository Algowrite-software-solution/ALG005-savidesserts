<?php
// sign Out
// by madusha pravinda
// version - 1.0.0
// 18-09-2023

//include models
require_once("../model/response_sender.php");
require_once("../model/SessionManager.php");

$responseObject = new stdClass();
$responseObject->status = "failed";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
     $responseObject->error = "request method is not valid";
     response_sender::sendJson($responseObject);
     exit(); // Exit the script after sending the response
}

// Assuming that the user_access_updater.php file contains the UserAccess class
if (session_status() === PHP_SESSION_NONE) {
     session_start();
}

$UserAccess = new SessionManager();
$UserAccess->logout();

// Logout was successful, update the status in the response
$responseObject->status = "success";
response_sender::sendJson($responseObject);
