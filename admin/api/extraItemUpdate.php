<?php

//extra fruit Update API
//by Madusha Pravinda
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

// checking is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_POST['id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$extraFruitId = $_POST['id'];
$extraFruitName = $_POST['fruit'];
$extraFruitPrice = $_POST['price'];
$extraFruitStatus = $_POST['extra_status_id'];

//database object
$db = new database_driver();

// data insert
$extraUpdate = "UPDATE `extra` SET `extra_status_id`=?,`fruit`=?,`price`=? WHERE `id`=?";
$db->execute_query($extraUpdate, 'sssi', array($extraFruitStatus, $extraFruitName, $extraFruitPrice, $extraFruitId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
