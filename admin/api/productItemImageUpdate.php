<?php
//product Item Adding API
//by janith nirmal
//version - 1.0.0
//28-11-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/data_validator.php");


// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

$url =  $_POST["image_url"];
$image = $_POST["image"];




list($type, $data) = explode(';', $image);
list(, $data) = explode(',', $data);
$newImageData = base64_decode($data);

// Update the existing image with the new data
file_put_contents($url, $newImageData);

$responseObject->status = 'success';
response_sender::sendJson($responseObject);
