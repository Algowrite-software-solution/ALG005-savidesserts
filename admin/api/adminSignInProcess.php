<?php

// admin signIn Process
// by kavindu sasanka
// version - 1.0.0
// 26-09-2023

//include models
require_once("./backend/model/database_driver.php");
require_once("./backend/model/response_sender.php");
require_once("./backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//handle the request
if (!isset($_POST['username']) || !isset($_POST['mobile'])) {
    $responseObject->status = "invalid request";
    response_sender::sendJson($responseObject);
}

$username = $_POST["username"];
$mobil = $_POST["mobile"];

// db connection
$db = new database_driver();

$search_quary = "SELECT * FROM `admin` WHERE `username`=? AND `mobile`=?";
$db_response = $db->execute_query($search_quary,"ss", array($username,$mobil));

$resultSet = $db_response["result"];

if($resultSet->num_rows == 1){
    $row = $resultSet->fetch_assoc();

    $userAccess = new SessionManager();
    $userAccess->login($row);

    $responseObject->status = "success";
    response_sender::sendJson($responseObject);
}else{
    
    $responseObject->status = 'Invalid Details';
    response_sender::sendJson($responseObject);
}
