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

//api sending template
$mailer = new MailSender($email);
$body = <<< HTML
<div style="border-radius: 20px; background-color: #122620;">
  <h2 style="text-align: center; color: #b68b40; padding: 20px 0 0 0;">SAWEE DESSERT</h2>
  <hr>
  <div style="background-color: #b68b40; color: black; border-radius: 20px; ">
    <h3 style="text-align: center; background-color: #122620;color: #b68b40; padding: 10px;">Verification Code</h3>
    <div style="text-align: center; padding: 10px; font-weight: bold;">{$six_digit_random_number}</div>
  </div>
</div>
HTML;
$mailer->mailInitiate("Sawee Dessert", "Your Verification Code", $body);

$error = $mailer->sendMail();
if ($error === 'Verification code sending failed') {
     $responseObject->error = $error;
     response_sender::sendJson($responseObject);
} else {
     $response->status = "success";
     response_sender::sendJson($response);
}
