<?php

//category Adding API
//by madusha pravinda
//version - 1.0.2
//2-10-2023

//include models
require_once("../../backend/model/mail/MailSender.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");

// headers
header("Content-Type: application/json; charset=UTF-8");

//response
$responseObject = new stdClass();
$responseObject->status = 'failed';

// chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

if (!isset($_GET['bug'])) {
     $responseObject->error = 'Invalid Data';
     response_sender::sendJson($responseObject);
}

// input data
$bug = $_GET['bug'];

$mailer = new MailSender("algowritemanagement@gmail.com");
$session = var_dump($_SESSION["alg005_admin"]);
$request = var_dump($_REQUEST);
$body = "<div>" . $bug . " <br><br><br> " . $session   . " <br><br><br> " . $request . "</div>";


$mailer->mailInitiate("Bug Report | Sawee Dessert", "Bug report for sawee dessert", $body);

if ($mailer->sendMail()) {
     $responseObject->status = 'success';
     response_sender::sendJson($responseObject);
} else {
     $responseObject->error = 'Bug report failed';
     response_sender::sendJson($responseObject);
}
