<?php
require_once("../model/database_driver.php");
require_once("../model/data_validator.php");
require_once("../model/response_sender.php");
require_once("../model/password_encryptor.php");
require_once("../model/SessionManager.php");

//response sending object
$response = new stdClass();
$response->status = 'failed';


//handle the request
if (!isset($_POST['email']) || !isset($_POST['password'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
}



$email = $_POST['email'];
$password = $_POST['password'];

//data validation sending object
$validationReady = new stdClass();
//email validation object
$emailData = new stdClass();
$emailData->datakey = 'Email';
$emailData->value = $email;

//password validation
$passwordData = new stdClass();
$passwordData->datakey = "Password";
$passwordData->value = $password;

$validationReady->email = array($emailData);

$validationReady->password = array($passwordData);

//data validation
$dataValidator = new data_validator($validationReady);
$validator = $dataValidator->validate();

foreach ($validator as $key => $value) {
     if ($value) {
          $response->error = "Invalid " . $key;
          response_sender::sendJson($response);
     }
}

//search for DB
$db = new database_driver();
$searchQuery = "SELECT * FROM `user` WHERE `email`=?";
$queryResult = $db->execute_query($searchQuery, 's', array($email));

$result = $queryResult['result'];

if ($result->num_rows == 0) {
     $response->error = "Invalid Email";
     response_sender::sendJson($response);
} else {
     //Fetch the row from the result
     $row = $result->fetch_assoc();

     //Extract the data values
     $userId = $row['user_id'];
     $userEmail = $row['email'];
     $password_hash = $row['password_hash'];
     $password_salt = $row['password_salt'];

     //password check
     if (!SecurePasswordHandler::isValid($password, $password_salt, $password_hash)) {
          $response->error = "Invalid Password";
          response_sender::sendJson($response);
     } else {
          //success login

          //set a session variable for email and password and userId
          $userAccess = new SessionManager();
          $userAccess->login($row);


          $response->status = "success";
          $response->result = 'Sign In success';
          response_sender::sendJson($response);
     }
}
