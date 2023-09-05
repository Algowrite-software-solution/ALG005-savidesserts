<?php
//include models
require_once("../model/database_driver.php");
require_once("../model/response_sender.php");
require_once("../model/mail/MailSender.php");

//response sending object
$response = new stdClass();
$response->status = "error";

//is checking email
if (!isset($_POST['email'])) {
     $response->error = "invalid request";
     response_sender::sendJson($response);
     die();
}

$email = $_POST['email'];

//send 6 number of verification code our email and update our db();
//generate 6 number of id
$six_digit_random_number = random_int(100000, 999999);

$db = new database_driver();
$updateQuery = "UPDATE `user` SET `confomation_code`=? WHERE `email`=?";
$db->execute_query($updateQuery, 'ss', array($six_digit_random_number, $email));

// send verification code user email
$sendMail = new MailSender($email);
$sendMail->mailInitiate('Verification Code', 'Savi Dessert', "Your Verification Code : $six_digit_random_number ");
$sendMail->sendMail();

$response->status = "success";
response_sender::sendJson($response);
