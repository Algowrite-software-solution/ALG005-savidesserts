<?php

//category Update API
//by madusha pravinda
//version - 1.0.2
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

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

if (!isset($_POST['id'])) {
     $responseObject->error = 'Invalid Parameter';
     response_sender::sendJson($responseObject);
}

// input data
$categoryId = $_POST['id'];
$categoryType = isset($_POST['category_type']) ? $_POST['category_type'] : null;
$image = isset($_POST['image']) ? $_POST['image'] : null; // image
if (empty($categoryType) && empty($image)) {
     $responseObject->error = 'Empty arguments';
     response_sender::sendJson($responseObject);
}

//database object
$db = new database_driver();
$fileRelativeLocation = "../../resources/images/categoryImages/";
$oldImageName = $db->execute_query("SELECT * FROM `category` WHERE `id`=? ", "i", array($categoryId));
$oldImageName =  $oldImageName["result"]->fetch_assoc();

if (isset($image) && !empty($image)) {
     $uri = substr($image, strpos($image, ",") + 1);
     file_put_contents($fileRelativeLocation . $categoryType . ".jpg",  base64_decode($uri));
}

if (isset($categoryType) && !empty($categoryType)) {
     rename($fileRelativeLocation . $oldImageName["category_type"] . ".jpg", $fileRelativeLocation . $categoryType . ".jpg");
}


// data insert
$categoryUpdate = "UPDATE `category` SET `category_type`=? WHERE `id`=?";
$db->execute_query($categoryUpdate, 'ss', array($categoryType, $categoryId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
