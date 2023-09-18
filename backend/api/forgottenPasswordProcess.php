<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/passwordEncryptor.php");

//response sending object
$response = new stdClass();
$response->status = "failed";

//handle the request
if (!isset($_POST['email']) || !isset($_POST['newPassword']) && !isset($_POST['confPassword'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
     die();
}
//check conPassword and new Password
if ($_POST['newPassword'] != $_POST['confPassword']) {
     $response->error = "not matching password";
     response_sender::sendJson($response);
     die();
}

//update db
//password encryption
$passwordData = SecurePasswordHandler::encryptPassword($_POST['newPassword']);
$hashedPassword = $passwordData['hash'];
$saltPassword = $passwordData['salt'];

$db = new database_driver();
$updateQuery = "UPDATE `user` SET `password_salt`=? AND `password_hash`=? WHERE `email`=?";
$db->execute_query($updateQuery, 'sss', array($saltPassword, $hashedPassword, $_POST['email']));
$response->status = "success";
response_sender::sendJson($response);
