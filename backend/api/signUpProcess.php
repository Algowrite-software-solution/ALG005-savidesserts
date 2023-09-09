<?php
require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/passwordEncryptor.php");

// $requestData = json_decode($_POST["signUpdata"]);

$email = $_POST['email'];
$password = $_POST['password'];
$fullName = $_POST['fullName'];
$confPassword = $_POST['confPassword'];

//response sending object
$response = new stdClass();

//database class
$db = new database_driver();

//email address check database
$searchQuery = "SELECT email FROM `user` WHERE email = ? ";
$queryResult = $db->execute_query($searchQuery, 's', array($email));

$stmt = $queryResult['stmt'];
$result = $queryResult['result'];

if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
     $response->error = "This Email Already exists";
     response_sender::sendJson($response);
     exit;
}



//data validation sending object
$validationReady = new stdClass();

$emailData = new stdClass();
$emailData->datakey = 'emailSignUp';
$emailData->value = $email;

//name validation
$nameData = new stdClass();
$nameData->datakey = "nameSignUp";
$nameData->value = $fullName;

//password validation
$passwordData = new stdClass();
$passwordData->datakey = "passwordSignUp";
$passwordData->value = $password;

$validationReady->email = array($emailData);
// $validationReady->name = array($nameData);
$validationReady->password = array($passwordData);

$dataValidator = new data_validator($validationReady);

$validator = $dataValidator->validate();

if ($validator->emailSignUp != null) {
     //invalid email
     $response->error = $validator;
     // $response->error = "Invalid";
     response_sender::sendJson($response);
     exit();
} else if ($validator->passwordSignUp != null) {
     // invalid password
     $response->error = $validator;
     response_sender::sendJson($response);
     exit();
} else if ($validator->nameSignUp != null) {
     //invalid name
     $response->error = $validator;
     response_sender::sendJson($response);
     exit();
} else {

     //password and confirmationPassword check
     if ($password != $confPassword) {
          $response->error = 'Passwords do not match';
          response_sender::sendJson($response);
          exit;
     }

     //password encryption
     $passwordData = SecurePasswordHandler::encryptPassword($password);
     $hashedPassword = $passwordData['hash'];
     $saltPassword = $passwordData['salt'];

     //php date object
     $currentDate = date('Y-m-d');

     // user data insert query
     $insertQuery = "INSERT INTO `user`(`email`, `full_name`,`password_salt`, `password_hash`,`confomation_code`,`status_id`,`register_date`)  VALUES (?,?,?,?,?,?,?) ";
     $db->execute_query($insertQuery, 'sssssss', array($email, $fullName, $saltPassword, $hashedPassword, '0', '1', $currentDate));
     $response->statusCode = 200;
     $response->statusMessage = 'success';
     response_sender::sendJson($response);
}
