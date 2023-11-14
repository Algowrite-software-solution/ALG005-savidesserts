<?php

// admin signIn Process
// by kavindu sasanka
// version - 1.0.0
// 26-09-2023

//include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//handle the request
if (!isset($_POST['password']) || !isset($_POST['mobile'])) {
    $responseObject->status = "invalid request";
    response_sender::sendJson($responseObject);
}

$mobile = $_POST["mobile"];
$passoword = $_POST["password"];

// db connection
$db = new database_driver();

$search_quary = "SELECT * FROM `admin` WHERE `mobile`=? AND `password`=?";
$db_response = $db->execute_query($search_quary, "ss", array($mobile, $passoword));

$resultSet = $db_response["result"];

if ($resultSet->num_rows == 1) {
    $row = $resultSet->fetch_assoc();

    $userAccess = new SessionManager("alg005_admin");
    $userAccess->login($row);

    $responseObject->status = "success";
    response_sender::sendJson($responseObject);
}

$responseObject->status = 'failed';
response_sender::sendJson($responseObject);
