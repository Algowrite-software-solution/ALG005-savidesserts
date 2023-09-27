<?php

//extra fruit Update API
//by Madusha Pravinda
//version - 1.0.1
//26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'false';

// checking is user logging
$userCheckSession = new SessionManager();
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

// input data
$extraFruitId = $_GET['id'];
$extraFruitName = $_GET['fruit'];
$extraFruitPrice = $_GET['price'];
$extraFruitStatus = $_GET['price'];

//database object
$db = new database_driver();

// data insert
$extraUpdate = "UPDATE `extra` SET `extra_status_id`=?,`fruit`=?,`price`=? WHERE `id`=?";
$db->execute_query($extraUpdate, 'sss', array($extraFruitStatus, $extraFruitName, $extraFruitPrice, $extraFruitId));
$responseObject->status = 'Update Success';
response_sender::sendJson($responseObject);
