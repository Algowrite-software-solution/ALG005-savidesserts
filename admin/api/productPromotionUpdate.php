<?php
// /include models
require_once("../../backend/model/database_driver.php");
require_once("../../backend/model/response_sender.php");
require_once("../../backend/model/SessionManager.php");
require_once("../../backend/model/RequestHandler.php");
require_once("../../backend/model/data_validator.php");
// headers
header("Content-Type: application/json; charset=UTF-8");

//response object
$responseObject = new stdClass();
$responseObject->status = 'failed';

//chekcing is user logging
$userCheckSession = new SessionManager("alg005_admin");
if (!$userCheckSession->isLoggedIn() || !$userCheckSession->getUserId()) {
     $responseObject->error = 'Please LogIn';
     response_sender::sendJson($responseObject);
}

//request checker
if (!RequestHandler::isPostMethod()) {
     $responseObject->error = 'wrong request method';
     response_sender::sendJson($responseObject);
}

//parameters
if (!isset($_POST['end_date_time'], $_POST['product_id'], $_POST['weight_id'], $_POST['promotion_id'], $_POST['promotion_status_id'])) {
     $responseObject->error = 'Access denied';
     response_sender::sendJson($responseObject);
}

$endDateTime = $_POST['end_date_time'];
$productId = $_POST['product_id'];
$weightId = $_POST['weight_id'];
$promotionId = $_POST['promotion_id'];
$promotionStatusId = $_POST['promotion_status_id'];

//data validation
$validateReadyObject = (object) [
     "int_or_null" => [
          (object) ["datakey" => "product_id", "value" => $productId],
          (object) ["datakey" => "weight_id", "value" => $weightId],
          (object) ["datakey" => "promotion_id", "value" => $promotionId],
          (object) ["datakey" => "promotion_status_id", "value" => $promotionStatusId],
     ],
];

$validator = new data_validator($validateReadyObject);
$errors = $validator->validate();
foreach ($errors as $key => $value) {
     if ($value) {
          $responseObject->error = "Invalid Input for : " . $key;
          response_sender::sendJson($responseObject);
     }
}

$db = new database_driver();
$updateQuery = "UPDATE `promotion` SET `end_date_time`=?,`promotion_status_promotion_status_id`=?,`product_product_id`=?,`weight_id`=? WHERE `promotion_id`=?";
$db->execute_query($updateQuery, 'siiii', array($endDateTime, $promotionStatusId, $productId, $weightId, $promotionId));
$responseObject->status = 'success';
response_sender::sendJson($responseObject);
