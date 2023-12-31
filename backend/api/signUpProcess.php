<?php
require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/password_encryptor.php");


// headers
header("Content-Type: application/json; charset=UTF-8");

$email = $_POST['email'];
$password = $_POST['password'];
$fullName = $_POST['fullName'];
$confPassword = $_POST['confPassword'];
$termsAndCondition = $_POST['termsAndCondition'];
$marketingPerpose = $_POST['marketingPerpose'];

//response sending object
$response = new stdClass();
$response->status = 'failed';

//database class
$db = new database_driver();

// empty filed check
if ($email == null) {
     $response->error = "Email is empty";
     response_sender::sendJson($response);
}
if ($password == null) {
     $response->error = "Password is empty";
     response_sender::sendJson($response);
}
if ($fullName == null) {
     $response->error = "Full Name is empty";
     response_sender::sendJson($response);
}

//email address check database
$searchQuery = "SELECT email FROM `user` WHERE email = ? ";
$queryResult = $db->execute_query($searchQuery, 's', array($email));

$result = $queryResult['result'];

if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
     $response->error = "This Email Already exists";
     response_sender::sendJson($response);
}

//data validation sending object
$dataToValidate = [
     'email' => [
          (object)['datakey' => 'email', 'value' => $email],
          // Add more email data objects if needed
     ],
     'password' => [
          (object)['datakey' => 'password', 'value' => $password],
          // Add more password data objects if needed
     ],
     'fullname' => [
          (object)['datakey' => 'fullname', 'value' => $fullName],
          // Add more fullname data objects if needed
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

//password and confirmationPassword check
if ($password != $confPassword) {
     $response->error = 'Retype Passwords does not match';
     response_sender::sendJson($response);
}

//password encryption
$passwordData = SecurePasswordHandler::encryptPassword($password);
$hashedPassword = $passwordData['hash'];
$saltPassword = $passwordData['salt'];

//php date object
$currentDate = date('Y-m-d');

// user data insert query
$insertQuery = "INSERT INTO `user`(`email`, `full_name`,`password_salt`, `password_hash`,`confomation_code`,`status_id`,`register_date`,`marketing_email_validation_m_id`,`terms_and_condition_ta_id`)  VALUES (?,?,?,?,?,?,?,?,?) ";
$db->execute_query($insertQuery, 'sssssssss', array($email, $fullName, $saltPassword, $hashedPassword, '0', '1', $currentDate,$marketingPerpose,$termsAndCondition));
$response->status = 'success';
response_sender::sendJson($response);
