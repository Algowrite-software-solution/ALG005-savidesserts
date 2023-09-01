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

//send 6 number of verification code our email and update our db();
//generate 6 number of id
$random_verification_code = substr(uniqid(true), 0, 6);
$db = new database_driver();
$updateQuery = "UPDATE `user` SET `confomation_code`=? WHERE `email`=?";
$db->execute_query($updateQuery, 'ss', array($random_verification_code, $_POST['email']));

// send verification code user email
$sendMail = new MailSender($_POST['email']);
$sendMail->mailInitiate('Verification Code', 'Savi Dessert', "Your Verification Code : '.$random_verification_code.'");
$sendMail->sendMail();

$response->status = "success";
response_sender::sendJson($response);
