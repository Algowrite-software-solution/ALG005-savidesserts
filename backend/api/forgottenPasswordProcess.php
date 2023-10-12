<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/password_encryptor.php");
require_once("../model/data_validator.php");

//response sending object
$response = new stdClass();
$response->status = "failed";

//handle the request
if (!isset($_POST['email']) && !isset($_POST['newPassword']) && !isset($_POST['confPassword'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
}
//check conPassword and new Password
if ($_POST['newPassword'] != $_POST['confPassword']) {
     $response->error = "not matching password";
     response_sender::sendJson($response);
}

//data validation sending object
$dataToValidate = [
     'password' => [
          (object)['datakey' => 'new-password', 'value' => $_POST['newPassword']],
          // Add more password data objects if needed
     ],
];

// validate input
$validator = new data_validator($dataToValidate);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
    if ($value) {
        $response->error = "Invalid Input for : " . $key;
        response_sender::sendJson($response);
    }
}

//update db
//password encryption
$passwordData = SecurePasswordHandler::encryptPassword($_POST['newPassword']);
$hashedPassword = $passwordData['hash'];
$saltPassword = $passwordData['salt'];

$db = new database_driver();
$updateQuery = "UPDATE `user` SET `password_salt`=?,`password_hash`=? WHERE `email`=?";
$db->execute_query($updateQuery, 'sss', array($saltPassword, $hashedPassword, $_POST['email']));
$response->status = "success";
response_sender::sendJson($response);
