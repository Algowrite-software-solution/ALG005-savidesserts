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
$categoryType = $_POST['category_type'];
// $image = $_FILES['image']; // image

//database object
$db = new database_driver();

// data insert
$categoryUpdate = "UPDATE `category` SET `category_type`=? WHERE `id`=?";
$db->execute_query($categoryUpdate, 'ss', array($categoryType, $categoryId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
