<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/mail/MailSender.php");
require_once("../model/data_validator.php");

//response sending object
$response = new stdClass();
$response->status = "failed";

//is checking email
if (!isset($_POST['email'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
     die();
}

$email = $_POST['email'];

//data validation sending object
$dataToValidate = [
     'email' => [
          (object)['datakey' => 'email', 'value' => $email],
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

//send 6 number of verification code our email and update our db();
//generate 6 number of id
$six_digit_random_number = random_int(100000, 999999);
$db = new database_driver();

$searchEmail = "SELECT * FROM `user` WHERE `email`=?";
$result = $db->execute_query($searchEmail, 's', array($email));

if ($result['result']->num_rows === 0) {
     $response->error = "invalid email";
     response_sender::sendJson($response);
}

$updateQuery = "UPDATE `user` SET `confomation_code`=? WHERE `email`=?";
$db->execute_query($updateQuery, 'ss', array($six_digit_random_number, $email));

// send verification code user email
$sendMail = new MailSender($email);
$sendMail->mailInitiate('Verification Code', 'Sawee Dessert', "Your Verification Code : $six_digit_random_number ");
$sendMail->sendMail();

$response->status = "success";
response_sender::sendJson($response);
